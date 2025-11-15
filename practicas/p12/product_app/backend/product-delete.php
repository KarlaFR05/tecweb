<?php
    use TECWEB\AppWeb\Delete\DeleteProduct;
    require_once __DIR__ . '/../vendor/autoload.php';

    $product = new DeleteProduct('marketzone');
    $product->remove($_POST['id']);
    echo $product->getData();
?>