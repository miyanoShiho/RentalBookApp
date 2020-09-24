<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class BookDatail extends Page
{

    private $book_id;
    public function __construct($book_id)
    {
        $this->book_id = $book_id;
    }
    /*
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return 'http://localhost:8000/bookdetail/' . $this->book_id;
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $title = '図書詳細画面';
        //$browser->assertPathIs($this->url());
        $browser->assertTitle($title);
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
        ];
    }
}
