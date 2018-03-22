<?php

namespace Tests\Unit;

use Monitorador\Slack\Auth\AutenticatorFacade;
use Monitorador\Slack\Auth\AutenticatorFactory;
use Tests\TestCase;

class Autenticador extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGeraLinkDeAutenticacao()
    {
        $authenticator = AutenticatorFacade::getURL();
        $this->assertTrue(true);
    }
}
