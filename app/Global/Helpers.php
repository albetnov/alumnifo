<?php

if (!function_exists('wireModel')) {
    function wireModel($value)
    {
        $getDebounce = config('app.debounce_delay');
        if ($getDebounce === "0") {
            return "wire:model='{$value}'";
        }
        $getMs = preg_match('[\dms$]', $getDebounce);
        $getS = preg_match('[\ds$]', $getDebounce);
        if ($getMs || $getS) {
            $duration = $getMs ? "ms" : "s";
            preg_match_all('[\d]', $getDebounce, $time);
            $time = implode("", array_shift($time));

            return "wire:model.debounce.{$time}{$duration}='{$value}'";
        } else {
            throw new \Exception("Debounce harus di definiskan dalam bentuk ms atau s atau 0. Contoh: 700ms, 5s, 0");
        }
    }
}
