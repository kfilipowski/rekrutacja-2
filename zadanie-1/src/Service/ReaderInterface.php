<?php

namespace App\Service;

use App\Model\File;

interface ReaderInterface
{
    /**
     * @return File[]
     */
    public function readFiles(): array;
}
