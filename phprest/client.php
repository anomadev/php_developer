<?php

$ch = curl_init();

curl_setop($ch, CURLOPT_URL, $argv[1]);
curl_setop($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

switch ($httpCode) {
    case 200:
        echo "Respuesta correcta";
        break;
    case 400:
        echo "Pedido incorrecto";
        break;
    case 404:
        echo "Recurso no encontrado";
        break;
    case 500:
        echo "Fallo interno del servidor";
        break;
}