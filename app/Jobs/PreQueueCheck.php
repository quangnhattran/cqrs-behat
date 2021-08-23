<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

trait PreQueueCheck
{
    private array $matchedKeys = [];

    private function rabbitMQCheck(string $routingKey= null)
    {
        $ex = array_filter(config('rabbitmq_exchanges'), function ($ex) use ($routingKey) {
            return array_key_exists($routingKey, $ex) ||
                array_filter(array_keys($ex), fn ($k) => $this->matchTopicKeys($routingKey, $k));
        });

        if (!empty($ex)) {
            $exchange = array_key_first($ex);
            $data = $ex[$exchange];
            // Declare exchange and its routing keys
            Artisan::call('rabbitmq:exchange-declare', [
                'name' => $exchange,
                '--type' => $data['type']
            ]);
            // Define queues
            if (count($this->matchedKeys)) {
                foreach ($this->matchedKeys as $matchedKey) {
                    $this->defineQueues($data[$matchedKey], $routingKey, $exchange);
                }
            } else {
                $this->defineQueues($data[$routingKey], $routingKey, $exchange);
            }

            Config::set('queue.connections.rabbitmq.options.queue.exchange', $exchange);
            Config::set('queue.connections.rabbitmq.options.queue.exchange_routing_key', $routingKey);

            return $exchange;
        }
    }

    private function matchTopicKeys($routingKey, $k): bool
    {
        if (stripos($k, '.') !== false && $this->check($routingKey, $k)) {
            $this->matchedKeys[] = $k;
            return true;
        }

        return false;
    }

    private function check($src, $str): bool
    {
        $str = explode('.' , $str);
        $src = explode('.', $src);

        $match = true;

        if (!in_array('#', $str) && count($str) !== count($src)) {
            return false;
        }

        foreach ($str as $idx => $word) {
            if ($word !== '*' && $word !== '#' && $word !== $src[$idx]) {
                $match = false;
                break;
            }
        }

        return $match;
    }

    /**
     * @param $data
     * @param string|null $routingKey
     * @param $exchange
     */
    private function defineQueues($data, ?string $routingKey, $exchange): void
    {
        foreach ($data as $queue) {
            Artisan::call('rabbitmq:queue-declare', [
                'name' => $queue,
                //'--type' => $config['type']
            ]);
            Artisan::call('rabbitmq:queue-bind', [
                'queue' => $queue,
                'exchange' => $exchange,
                '--routing-key' => $routingKey
            ]);
        }
    }
}
