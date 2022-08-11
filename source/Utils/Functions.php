<?php

session_name(SESSION_NAME);
session_start();

/**
 * @param string $subUrl
 * @return string
 */
function url(string $urlPath): string
{
    return MAIN_URL . $urlPath;
}

/**
 * @param string $urlPath
 * @return string
 */
function asset(string $urlPath): string
{
    return MAIN_URL . "/assets" . $urlPath;
}

/**
 * @param string $urlRedirect
 * @return void
 */
function redirect(string $urlRedirect): void
{
    if (strpos($urlRedirect, "http://")) {
        header("location: {$urlRedirect}");
        exit;
    }
    $link = MAIN_URL . $urlRedirect;
    header("location: {$link}");
}

/**
 * @return object
 */
function session(): object
{
    return (object) $_SESSION;
}

function session_set(string $key, $value): void
{
    $_SESSION[$key] = $value;
}
