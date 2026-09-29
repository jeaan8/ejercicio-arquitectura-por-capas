<?php
$archivoLocal = __DIR__ . '/config.local.php';
if (is_file($archivoLocal)) {
    return require $archivoLocal;
}

return require __DIR__ . '/config.local.example.php';
