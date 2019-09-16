<?php

namespace App\Service;

interface ValidatorInterface
{
    /**
     * @param array $data
     * @return bool
     */
    public function check(array $data): bool;

    /**
     * @return array
     */
    public function getErrors(): array;
}
