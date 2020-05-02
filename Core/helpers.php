<?php

/**
 * Get the asset utl
 *
 * @param $path
 */
function asset($path) {
    echo(url() . '/' . $path);
}

/**
 * Get the route link
 *
 * @param $path
 */
function route($path) {
    echo(url() . $path);
}

/**
 * Get the base url path
 *
 * @return string
 */
function url() {
    // Get the url base url
    $url = sprintf(
        "%s://%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME']
    );

    // Get the port
    $port = $_SERVER['SERVER_PORT'];

    return $port != 80 && $port != 443 ? $url . ':' . $port : $url;
}