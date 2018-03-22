<?php
namespace Monitorador\Slack\Auth;


use App\User;
use Lisennk\Laravel\SlackWebApi\Exceptions\SlackApiException;
use Monitorador\Services\Slack\Slack;

class Code
{

    private $code;
    const URL = "https://slack.com/api/oauth.access";
    private $url;
    private $user;

    public function __construct($code)
    {
        $this->code = $code;
        $this->user = new User();
    }

    private function generateToken(){
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET', self::URL, [
            'query' => [
                'client_id'=>env('SLACK_CLIENT_ID'),
                'client_secret'=>env('SLACK_CLIENT_SECRET'),
                'code'=>$this->code,
                'redirect_uri'=>env('SLACK_REDIRECT_URI')
            ]
        ]);

        return json_decode($result->getBody());
    }


    public function getUser(){
        $token = $this->generateToken();

        $slack = Slack::init($token->access_token);
        try {
            $user_data = $slack->execute('users.info', ['user' => $token->user_id])['user'];
        }catch (SlackApiException $exception){
            dd($exception->getMessage());
        }

        $this->user->slack_id = $user_data['id'];
        $this->user->slack_token = $token->access_token;
        $this->user->name = $user_data['real_name'];
        $this->user->email = $user_data['profile']['email'];

        User::whereSlackId($this->user->slack_id)->delete();

        return $this->user;
    }

}