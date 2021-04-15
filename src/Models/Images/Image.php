<?php

namespace src\Models\Images;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

class Image extends FlexibleDataTransferObject
{
    public string $id;

    public string $url;

    public int $width;

    public int $height;
}