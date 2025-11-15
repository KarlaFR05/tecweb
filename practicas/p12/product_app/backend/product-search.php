<?php
    use TECWEB\AppWeb\Read\SearchProduct;
    require_once __DIR__ . '/../vendor/autoload.php';

    $product = new SearchProduct('marketzone');
    $product->search($_GET['search']);
    echo $product->getData();
?>