<?php

$products = require __DIR__ . '/routes/products.php';
$categories = require __DIR__ . '/routes/categories.php';
$suppliers = require __DIR__ . '/routes/suppliers.php';
$stock = require __DIR__ . '/routes/stock.php';
return [
    ...$products,
    ...$categories,
    ...$suppliers,
    ...$stock,
];
