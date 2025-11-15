<?php
    use TECWEB\AppWeb\Read\ListProducts;
    require_once __DIR__ . '/../vendor/autoload.php';

    $products = new ListProducts('marketzone');
    $products->getAll();
    echo $products->getData();
?>