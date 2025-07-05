<?php

namespace App\View;

use App\Renderable;

class ErrorAlert implements Renderable
{
    public function __construct(
        private readonly string $message,
    )
    {
    }

    public function render(): string
    {
        return '<div class="alert alert-error">
            <strong>Ошибка:</strong> ' . htmlspecialchars($this->message, ENT_QUOTES, 'UTF-8') . '
        </div>';
    }
}