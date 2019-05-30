<?php

namespace App\Service;

use InvalidArgumentException;
use App\Exception\InvalidFileMimeTypeException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Uploader implements UploaderInterface
{
    /** @var string */
    private $targetPath;

    /** @var array */
    private $mimeTypes;

    /**
     * Uploader constructor.
     * @param string $targetPath
     * @param array $mimeTypes
     */
    public function __construct(string $targetPath, array $mimeTypes)
    {
        $this->targetPath = $targetPath;
        $this->mimeTypes  = $mimeTypes;
    }

    /**
     * @param UploadedFile[] $files
     */
    public function upload(array $files)
    {
        $this->checkFile($files);
        $this->checkSize($files);
        $this->checkExtension($files);

        foreach ($files as $item) {
            $name = $item->getClientOriginalName();
            $name = sprintf('%s-%s', time(), $name);
            $item->move($this->targetPath, $name);
        }
    }

    /**
     * @param UploadedFile[] $files
     */
    protected function checkFile(array $files)
    {
        array_map(function($item) {
            if (!$item instanceof UploadedFile) {
                throw new InvalidArgumentException(
                    'Invalid input file instance.'
                );
            }
        }, $files);
    }

    /**
     * @param UploadedFile[] $files
     */
    protected function checkSize(array $files)
    {
        array_map(function($item) {
            /** ... */
        }, $files);
    }

    /**
     * @param UploadedFile[] $files
     */
    protected function checkExtension(array $files)
    {
        array_map(function($item) {
            /** @var UploadedFile $item */
            $mime = $item->getMimeType();
            if (!in_array($mime, $this->mimeTypes, true)) {
                throw new InvalidFileMimeTypeException();
            }
        }, $files);
    }
}
