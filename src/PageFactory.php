<?php

namespace App;

use App\Page\AbstractPage;

class PageFactory
{
    public function __construct(
        private readonly array $pageCollection,
        private readonly AbstractPage $notFoundPage,
    )
    {
    }

    public function create(Code $code): AbstractPage
    {
        /** @var AbstractPage $page */
        foreach ($this->pageCollection as $page) {
            if ($page->match($code)) {
                return $page;
            }
        }

        return $this->notFoundPage;
    }
}