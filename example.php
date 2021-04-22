<?php
require_once './vendor/autoload.php';

$imagesApi = new \src\Apis\ImagesApi(
    new \src\Decorator\LogDecorator(
        new \src\Decorator\LogDecorator(
            new \src\Clients\GuzzleAdapter()
        )
    )
);

print_r($imagesApi->search());