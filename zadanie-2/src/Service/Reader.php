<?php

namespace App\Service;

use App\Model\File;
use Symfony\Component\Finder\Finder;

class Reader implements ReaderInterface
{
    /** @var string */
    private $targetPath;

    /** @var Finder */
    private $finder;

    /**
     * Reader constructor.
     * @param string $targetPath
     * @param Finder $finder
     */
    public function __construct(string $targetPath, Finder $finder)
    {
        $this->finder     = $finder;
        $this->targetPath = $targetPath;
    }

    /**
     * @return File[]
     */
    public function readFiles(): array
    {
        $files = [];

        $finder = new Finder();
        $finder->files()->in($this->targetPath);

        foreach ($finder as $item) {
            $files[] = new File(
                $item->getFilename(),
                $item->getSize()
            );
        }
        return $files;
    }
}
