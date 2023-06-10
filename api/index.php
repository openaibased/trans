<?php
include 'inc.php';
header('Content-Type: application/json');

$form = file_get_contents('php://input');
$jo = json_decode($form);
if (!$jo) {
    exit;
}

if (empty($jo->action) || empty($jo->method) || empty($jo->token)) {
    exit;
}

if (strtolower($jo->method) === 'get') {
    echo _get($jo->token, $jo->action);
} else {
    !empty(empty($jo->data)) or die();
    $data = base64_decode($jo->data);
    echo _post($jo->token, $jo->action, $data);
}