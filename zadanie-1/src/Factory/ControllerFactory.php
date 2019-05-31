<?php

namespace App\Factory;

use App\Service\Reader;
use App\Service\Uploader;
use App\Controller\UploadController;
use Symfony\Component\Finder\Finder;

class ControllerFactory
{
    /**
     * @param array $config
     * @return UploadController
     */
    public static function create(array $config): UploadController
    {
        if (!isset($config['upload_dir'])) {
            throw new \InvalidArgumentException(
                'Uploaded directory is not defined.'
            );
        }
        if (!isset($config['mime_types'])) {
            throw new \InvalidArgumentException(
                'Uploaded directory is not defined.'
            );
        }
        return new UploadController(
            new Uploader(
                $config['upload_dir'],
                $config['mime_types']
            ),
            new Reader(
                $config['upload_dir'],
                new Finder()
            ),
            SmartyFactory::create()
        );
    }
}
