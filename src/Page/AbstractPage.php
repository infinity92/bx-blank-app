<?php

namespace App\Page;

use App\Matchable;
use App\HasTitle;
use App\Renderable;
use App\Request;

abstract class AbstractPage implements Matchable, Renderable, HasTitle
{
    public function __construct(
        protected readonly Request $request
    )
    {
    }

    public function match(Matchable $entity): bool
    {
        return $this->getId() === $entity->getId();
    }

    abstract public function render(): string;

    public function getTitle(): string
    {
        return ucfirst($this->getId());
    }
}