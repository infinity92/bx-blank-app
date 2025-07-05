<?php

namespace App\Page;

class Crm extends AbstractPage
{
    public function getTitle(): string
    {
        return 'CRM';
    }

    public function render(): string
    {
        return '
            <a href="#" onclick="console.log(\'click\'); BX24.reloadWindow();">Refresh</a>
            <div>Hello</div>
            <script>
                // BX24.reloadWindow();
            </script>
        ';
    }

    public function getId(): string
    {
        return 'crm';
    }
}