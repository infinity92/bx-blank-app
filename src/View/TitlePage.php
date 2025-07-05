<?php

namespace App\View;

use App\HasTitle;
use App\Renderable;

class TitlePage implements Renderable
{
    public function __construct(
        private readonly HasTitle $title
    )
    {
    }

    public function render(): string
    {
        return "<h1>{$this->title->getTitle()}</h1>";
    }
}