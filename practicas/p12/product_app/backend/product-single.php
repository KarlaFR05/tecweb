<?php
    use TECWEB\AppWeb\Read\GetProduct;
    require_once __DIR__ . '/../vendor/autoload.php';

    $product = new GetProduct('marketzone');
    $product->single($_POST['id']);
    echo $product->getData();
?>