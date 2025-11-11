<?php

    namespace TECWEB\MYAPI;

    require_once __DIR__ . '/myapi/Products.php';

    $productos = new Products('marketzone');
    $productos->add($_POST);
    echo $productos->getData();
?>