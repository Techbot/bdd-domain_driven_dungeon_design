<?php


$newProductName = $argv[1];

$product = new PLayer();
$product->setName($newProductName);

$entityManager->persist($product);
$entityManager->flush();

echo "Created Product with ID " . $product->getId() . "\n";