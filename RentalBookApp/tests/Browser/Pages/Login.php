<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class Login extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return 'http://localhost:8000/login';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $title = 'ログイン画面';
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

    public function loginPress($browser, $user)
    {
        $browser->type('email', $user["email"])
            ->type('password', $user["pass"])
            ->click('.btn-primary');
    }
}
