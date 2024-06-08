<?php
    function formatDateTime($date, $time) {
        $datetime = new DateTime("$date $time");
        return $datetime->format('Y-m-d H:i:s');
    }
?>