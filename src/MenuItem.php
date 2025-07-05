<?php

namespace App;

class MenuItem implements Renderable
{
    public function __construct(
        private readonly Code $code,
        private readonly string $name = '',
        private readonly bool $isActive = false,
        private int $sort = 100,
    )
    {
    }

    public function render(): string
    {
        $activeClass = $this->isActive() ? ' menu__item--active' : '';

        return '<a class="menu__item '.$activeClass.'" href="/?page=' . $this->code . '">' . $this->getName() . '</a>';
    }

    private function getName(): string
    {
        return empty($this->name) ? ucfirst($this->code) : $this->name;
    }

    private function isActive(): bool
    {
        return $this->isActive;
    }
}