<?php

namespace Cblink\Xiaowm;

use Hanson\Foundation\Foundation;

class Printer extends Foundation
{
    protected $providers = [
        Printer\ServiceProvider::class
    ];

    public function __call($name, $arguments)
    {
        return $this->printer->$name(...$arguments);
    }
}
