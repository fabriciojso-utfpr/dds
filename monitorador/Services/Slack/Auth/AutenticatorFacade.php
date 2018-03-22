<?php

namespace Monitorador\Slack\Auth;


use Monitorador\Slack\Auth\Entities\Authenticator;

class AutenticatorFacade
{
    private static $autenticator;

    private static function getInstance() : Authenticator{
        if(empty(self::$autenticator)){
            $auth = new Authenticator();

            $auth->setTeam("T9NHX0L9Y");
            $auth->setClientId(env('SLACK_CLIENT_ID'));
            $auth->setRedirectUri(env('SLACK_REDIRECT_URI'));

            $auth->aadScope("users:read.email");
            $auth->aadScope("users:read");
            $auth->aadScope("channels:history");
            $auth->aadScope("channels:read");
            $auth->aadScope("im:history");
            $auth->aadScope("im:read");
            $auth->aadScope("mpim:history");
            $auth->aadScope("mpim:read");
            $auth->aadScope("users.profile:read");
            $auth->aadScope("groups:read");
            $auth->aadScope("groups:history");

            self::$autenticator = $auth;
        }

        return self::$autenticator;
    }

    public static function getURL(){
        return self::getInstance()->getURL();
    }

}