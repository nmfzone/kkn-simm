<?php

namespace App\Services\Implementations;

class BaseService
{
    /**
     * Check minimum parameters.
     *
     * @param  integer  $args
     * @param  integer  $min
     * @return void
     */
    protected function checkParameters($numArgs, $min)
    {
        if ($numArgs < $min) {
            throw new Exception('Required more parameters.');
        }
    }
}
