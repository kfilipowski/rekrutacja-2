<?php

namespace App\Service;

use App\Model\Form;

class FormValidator implements ValidatorInterface
{
    /** @var array */
    private $errors = [];

    /**
     * @param array $data
     * @return bool
     */
    public function check(array $data): bool
    {
        $this->checkSex($data);
        $this->checkAge($data);
        $this->checkName($data);
        $this->checkColor($data);

        return !count($this->errors);
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $data
     */
    private function checkSex(array $data)
    {
        $allowed = [
            Form::SEX_MEN,
            Form::SEX_WOMEN
        ];

        if (isset($data['sex']) && !in_array($data['sex'], $allowed)) {
            $this->errors['sex'] = 'Sex is invalid. ';
        }
    }

    /**
     * @param array $data
     */
    private function checkAge(array $data)
    {
        if (isset($data['age']) && ($data['age'] < 1 || $data['age'] > 100)) {
            $this->errors['age'] = 'Age is invalid.';
        }
    }

    /**
     * @param array $data
     */
    private function checkName(array $data)
    {
        if (isset($data['name']) && strlen(trim($data['name'])) < 3) {
            $this->errors['name'] = 'Name is invalid.';
        }
    }

    /**
     * @param array $data
     */
    private function checkColor(array $data)
    {
        $allowed = [
            Form::BG_COLOR_BLUE,
            Form::BG_COLOR_GREEN,
            Form::BG_COLOR_WHITE,
            Form::BG_COLOR_YELLOW
        ];

        if (isset($data['color']) && !in_array($data['color'], $allowed)) {
            $this->errors['color'] = 'Color is invalid. ';
        }
    }
}
