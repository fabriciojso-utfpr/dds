<?php

namespace Monitorador\Services\Monitor;


use Lisennk\Laravel\SlackWebApi\SlackApi;

abstract class Exchange
{
    private $token;
    private $slack;
    /**
     * @var Exchange
     */
    private $exchange;

    public function __construct($token)
    {
        $this->token = $token;
        $this->slack = new SlackApi($token);
    }

    public function setNext(Exchange $exchange){
        $this->exchange = $exchange;
    }

    public function next(){
        return $this->exchange;
    }
}