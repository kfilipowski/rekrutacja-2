<?php

namespace App\Model;

class File
{
    /** @var string */
    private $name;

    /** @var int */
    private $size;

    /**
     * File constructor.
     * @param string $name
     * @param int $size
     */
    public function __construct(string $name, int $size)
    {
        $this->name = $name;
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function size(): int
    {
        return $this->size / 1024;
    }
}
