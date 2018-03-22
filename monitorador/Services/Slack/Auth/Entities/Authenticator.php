<?php

namespace Monitorador\Slack\Auth\Entities;


class Authenticator
{

    private $client_id;
    private $team;
    private $redirect_uri;
    private $scopes = [];
    const URL = "https://slack.com/oauth/authorize";


    public function getURL(){
        $url = self::URL;
        $params[] = "client_id={$this->getClientId()}";
        $params[] = "team={$this->getTeam()}";
        $params[] = "redirect_uri=".env('SLACK_REDIRECT_URI');
        $params[] = "scope={$this->getScopesInString()}";
        $params = implode("&", $params);

        return "{$url}?$params";
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param mixed $client_id
     */
    public function setClientId($client_id): void
    {
        $this->client_id = $client_id;
    }

    /**
     * @return mixed
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param mixed $team
     */
    public function setTeam($team): void
    {
        $this->team = $team;
    }

    /**
     * @return mixed
     */
    public function getRedirectUri()
    {
        return $this->redirect_uri;
    }

    /**
     * @param mixed $redirect_uri
     */
    public function setRedirectUri($redirect_uri): void
    {
        $this->redirect_uri = $redirect_uri;
    }

    /**
     * @return array
     */
    public function listScopes(): array
    {
        return $this->scopes;
    }

    public function getScopesInString() : string
    {
        return implode(",", $this->listScopes());
    }

    /**
     * @param string $scopes
     */
    public function aadScope(string $scope): void
    {
        $this->scopes[] = $scope;
    }


}