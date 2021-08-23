<?php

return [
    'logs_exchange' => [
        'info' => ['all_logs'],
        'error' => ['all_logs'],
        'critical' => ['all_logs', 'critical_logs'],
        'type' => \Interop\Amqp\AmqpTopic::TYPE_DIRECT,
    ],
    'posts_exchange' => [
        'notifier' => ['post_created'],
        'type' => 'direct',
    ],
    'logs_topic_exchange' => [
        '*.critical' => ['critical_all_logs'],// kernel.critical kernel|critical
        'kernel.*' => ['kernel_logs'],
        'type' => \Interop\Amqp\AmqpTopic::TYPE_TOPIC,
    ],
];
