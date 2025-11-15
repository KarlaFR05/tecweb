<?php
    use TECWEB\AppWeb\Create\AddProduct; 
    require_once __DIR__ . '/../vendor/autoload.php';

    $product = new AddProduct('marketzone');
    $product->add(json_decode(json_encode($_POST)));
    echo $product->getData();
?>