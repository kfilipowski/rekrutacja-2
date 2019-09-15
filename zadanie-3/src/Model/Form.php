<?php

namespace App\Model;

class Form
{
    const SEX_MEN   = 1;
    const SEX_WOMEN = 2;

    const BG_COLOR_BLUE   = 'blue';
    const BG_COLOR_GREEN  = 'green';
    const BG_COLOR_WHITE  = 'white';
    const BG_COLOR_YELLOW = 'yellow';

    /** @var null|string */
    private $name;

    /** @var int|null */
    private $sex;

    /** @var int|null */
    private $age;

    /** @var null|string */
    private $color;

    /** @var bool|null */
    private $canSwim;

    /** @var string */
    private $bgColor;

    /**
     * Form constructor.
     * @param null|string $name
     * @param int|null $sex
     * @param int|null $age
     * @param null|string $color
     * @param bool|null $canSwim
     */
    public function __construct(?string $name, ?int $sex, ?int $age, ?string $color, ?bool $canSwim)
    {
        $this->name    = $name;
        $this->sex     = $sex;
        $this->age     = $age;
        $this->color   = $color;
        $this->canSwim = $canSwim;

        $this->resolveColor();
    }

    /**
     * @return array
     */
    public function getColors(): array
    {
        return [
            self::BG_COLOR_BLUE,
            self::BG_COLOR_GREEN,
            self::BG_COLOR_WHITE,
            self::BG_COLOR_YELLOW,
        ];
    }

    /**
     * @return null|string
     */
    public function getBgColor(): ?string
    {
        return $this->bgColor;
    }

    /**
     * @return bool
     */
    public function isBeginStep(): bool
    {
        return !$this->hasSex();
    }

    /**
     * @return bool
     */
    public function isAgeStep(): bool
    {
        return $this->hasSex() && $this->isMen() && !$this->hasAge();
    }

    /**
     * @return bool
     */
    public function isColorStep(): bool
    {
        return $this->hasSex() && !$this->isMen() && (!$this->hasAge() && !$this->hasColor());
    }

    /**
     * @return bool
     */
    public function isSwimStep(): bool
    {
        return $this->hasSex() && ($this->hasAge() || $this->hasColor());
    }

    /**
     * @return bool
     */
    private function isMen(): bool
    {
        return self::SEX_MEN === $this->sex;
    }

    /**
     * @return bool
     */
    private function hasSex(): bool
    {
        return null !== $this->sex;
    }

    /**
     * @return bool
     */
    private function hasColor(): bool
    {
        return null !== $this->color;
    }

    /**
     * @return bool
     */
    private function hasAge(): bool
    {
        return null !== $this->age;
    }

    /**
     * @return void
     */
    private function resolveColor()
    {
        if ($this->hasSex() && !$this->isMen() && $this->canSwim) {
            $this->bgColor = self::BG_COLOR_WHITE;
        }
        else if ($this->hasSex() && !$this->isMen() && false === $this->canSwim) {
            $this->bgColor = self::BG_COLOR_YELLOW;
        }
        else if ($this->hasSex() && $this->isMen() && $this->canSwim) {
            $this->bgColor = self::BG_COLOR_GREEN;
        }
        else if ($this->hasSex() && $this->isMen() && false === $this->canSwim) {
            $this->bgColor = self::BG_COLOR_BLUE;
        }
    }
}
