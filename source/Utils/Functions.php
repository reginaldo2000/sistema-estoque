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

function setMessage(string $message, string $type): void
{
    $_SESSION["msg_dialog"] = $message;
    $_SESSION["type_dialog"] = $type;
}

function showMessage(): void
{
    if (isset($_SESSION["msg_dialog"])) {
        echo '<div class="alert ' . $_SESSION["type_dialog"] . ' alert-dismissible fade show" role="alert">
            ' . $_SESSION["msg_dialog"] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';

        unset($_SESSION["msg_dialog"]);
    }
}

function formataMoeda(float $valor): string
{
    return number_format($valor, 2, ",", ".");
}

function formataParaFloat(string $valor): float {
    return str_replace(",", ".", str_replace(".", "", $valor));
}
 

function filterParams(array $params): array {
    // $arrayKeys = array_keys($params);
    // foreach($arrayKeys as $key) {
    //     $params[$key] = filter_va
    // }
    return [];
}