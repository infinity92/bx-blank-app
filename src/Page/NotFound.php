<?php

namespace App\Page;

use App\Matchable;

class NotFound extends AbstractPage
{
    public function render(): string
    {
        return '<div class="not-found">
                <h1>404</h1>
                <p>Страница не найдена</p>
                <a href="/">Вернуться на главную</a>
            </div>';
    }

    public function getId(): string
    {
        return '404';
    }
}