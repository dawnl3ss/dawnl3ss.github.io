<?php


# - Template used to wrap the main content so we can compute its boot time
# -- to use in ndex.php

$boot_time = \testing\BootTimeTest::_wrap(function (){
    # - Core init
    \Aether\Aether::_init();
});

print_r("<br><br>" . $boot_time . " ms");