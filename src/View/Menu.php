<?php

namespace App\View;

use App\Code;
use App\CurrentPage;
use App\MenuItem;
use App\Option;
use App\Page\AbstractPage;
use App\Renderable;

class Menu implements Renderable
{
    private array $pageFiles = [];

    /**
     * @throws \Exception
     */
    public function __construct(
        private readonly AbstractPage $page,
    )
    {
        $option = new Option('menu');
        $menuItems = $option->get('items', []);

        foreach ($menuItems as $code => $item) {
                $pageCode = new Code($code);
                $this->pageFiles[] = new MenuItem(
                    $pageCode,
                    $item['label'] ?? '',
                    isActive: $this->page->match($pageCode),
                    sort: $item['sort'] ?? 100,
                );

        }
    }

    public function render(): string
    {
        $render = '<div class="menu">';
        foreach ($this->pageFiles as $item) {
            $render .= $item->render();
        }
        $render .= '</div>';

        return $render;
    }
}