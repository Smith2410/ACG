<?php

function redirect($url) {
    // BASE_URL lo leemos del config
    $base = defined('BASE_URL') ? BASE_URL : '/';

    header("Location: " . $base . $url);
    exit();
}
