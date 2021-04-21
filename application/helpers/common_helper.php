<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

    function convertToHoursMins($time, $format = '%02d:%02d') {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }
    function convertSecToHours($time, $format = '%02d:%02d') {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 3600);
        $secs = ($time % 3600);
        $minutes = floor($secs / 60);
        return sprintf($format, $hours, $minutes);
    }
?>