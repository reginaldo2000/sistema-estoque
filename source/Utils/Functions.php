<?php


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
    exit;
}

function session_set(string $key, $value): void
{
    $session = new \Source\Utils\Session();
    $session->set($key, $value);
}

function session_get(string $key)
{
    $session = new \Source\Utils\Session();
    return $session->get($key);
}

function session_remove(string $key): void
{
    $session = new \Source\Utils\Session();
    $session->remove($key);
}

function setMessage(string $message, string $type): void
{
    $session = new \Source\Utils\Session();
    $session->set("msg_dialog", $message);
    $session->set("type_dialog", $type);
}

function showMessage(): void
{
    $session = new \Source\Utils\Session();
    if ($session->has("msg_dialog")) {
        echo '<div class="alert ' . $session->get("type_dialog") . ' alert-dismissible fade show" role="alert">
            ' . $session->get("msg_dialog") . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';

        $session->remove("msg_dialog");
    }
}

function formataMoeda(float $valor): string
{
    return number_format($valor, 2, ",", ".");
}

function formataDecimal(float $valor, int $decimal = 1): string
{
    return number_format($valor, $decimal, ",", ".");
}

function formataParaFloat(string $valor): float
{
    return str_replace(",", ".", str_replace(".", "", $valor));
}


function filterParams(array $params): array
{
    // $arrayKeys = array_keys($params);
    // foreach($arrayKeys as $key) {
    //     $params[$key] = filter_va
    // }
    return [];
}
