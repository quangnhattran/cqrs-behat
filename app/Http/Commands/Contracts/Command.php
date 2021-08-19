<?php

namespace App\Http\Commands\Contracts;

interface Command
{
    /**
     * @param object $dto
     * @return void
     */
    public function run(object $dto): void;
}
