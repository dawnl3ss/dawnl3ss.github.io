<?php

namespace testing;

class BootTimeTest {

    /**
     * Wrapped function to compute callable's boot time (ms)
     *
     * @param callable $_main
     * @return float
     */
    public static function _wrap(callable $_main) : float {
        $boot_start = hrtime(true);
        call_user_func($_main);
        return round((hrtime(true) - $boot_start) / 1e6, 5);
    }
}