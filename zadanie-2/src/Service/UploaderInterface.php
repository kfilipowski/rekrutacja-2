<?php

namespace App\Service;

interface UploaderInterface
{
    /**
     * @param array $files
     */
    public function upload(array $files);
}
