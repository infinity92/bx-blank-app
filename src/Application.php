<?php

namespace App;

use App\View\SimplePage;

class Application implements Renderable
{
    private readonly Option $option;
    private readonly Renderable $page;
    private CurrentPage $currentPage;
    private Page\AbstractPage $pageEntity;

    /**
     * @throws \Exception
     */
    public function __construct(
        private readonly Request $request,
    ) {
        session_start();
        $this->option = new Option('app');
        $this->pageEntity = $this->pageFactory()->create(
            new Code(
                $this->request->get('page', $this->option->get('index_page'))
            )
        );
        $this->page = new SimplePage($this->pageEntity);
    }

    /**
     * @throws \Exception
     */
    public function render(): string
    {
        return $this->page->render();
    }

    public function run()
    {

    }

    public function finalize()
    {

    }

    public function pageFactory(): PageFactory
    {
        return new PageFactory(
            [
                new Page\Home($this->request),
                new Page\Event($this->request),
                new Page\Placement($this->request),
                new Page\Crm($this->request),
            ],
            new Page\NotFound($this->request),
        );
    }
}