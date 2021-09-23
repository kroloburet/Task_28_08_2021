<?php

namespace Core;

class Helper
{
    /**
     * Measure the time of execution in closure
     *
     * @param callable $call Closure
     * @return array
     */
    static function timer(callable $call): array
    {
        $result = [];
        $start = microtime(true);
        $result['data'] = $call();
        $result['time'] = round(microtime(true) - $start, 4);
        return $result;
    }
}