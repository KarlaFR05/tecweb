<?php
    use TECWEB\AppWeb\Update\EditProduct;
    require_once __DIR__ . '/../vendor/autoload.php';

    $product = new EditProduct('marketzone');
    $product->update(json_decode(json_encode($_POST)));
    echo $product->getData();
?>