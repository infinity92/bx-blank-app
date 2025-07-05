<?php

namespace App\View;

use App\Renderable;

class SuccessAlert implements Renderable
{
    public function __construct(
        private readonly string $message,
    )
    {
    }

    public function render(): string
    {
        return '<div class="alert alert-success">
            <strong>Успех!</strong> .' . htmlspecialchars($this->message, ENT_QUOTES, 'UTF-8') . '
        </div>';
    }
}