<?php

namespace App\View;

use App\Page\AbstractPage;
use App\Renderable;

class SimplePage implements Renderable
{
    private Renderable $menu;
    private TitlePage $title;

    /**
     * @throws \Exception
     */
    public function __construct(
        private readonly AbstractPage $page,
    )
    {
        $this->menu = new Menu($this->page);
        $this->title = new TitlePage($this->page);
    }

    /**
     * @throws \Exception
     */
    public function render(): string
    {
        $header = '<html lang="en">
                        <head>
                            <script src="https://api.bitrix24.com/api/v1/"></script>
                            <link rel="stylesheet" type="text/css" href="./css/style.css?v='.time().'">
                            <title>Local App</title>
                        </head>
                    <body>
';

        $bottom = '</body>
                    </html>';

        return $header.$this->title->render().$this->menu->render().$this->page->render().$bottom;
    }
}