<?php

function real_wtps_count(array $list){
    $count = 0;

    foreach($list as $platform => $wts){
        $count += count($wts);
    }
    return $count;
}