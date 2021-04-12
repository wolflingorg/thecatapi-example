<?php
require_once './vendor/autoload.php';

$imagesApi = new \src\Apis\ImagesApi(
    new \src\Clients\GuzzleAdapter()
);

print_r($imagesApi->search());