<?php

namespace Monitorador\Services\Slack;


use Lisennk\Laravel\SlackWebApi\SlackApi;

class Slack
{

    public static function init($token){
        return new SlackApi($token);
    }
}