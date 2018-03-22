<?php

namespace App\Http\Controllers;

use App\Channel as ChannelModel;

use App\User;
use Illuminate\Http\Request;
use Monitorador\Services\Monitor\Monitor;
use Monitorador\Services\Slack\Slack;
use Monitorador\Services\Channel\Channel;

class MonitorController extends Controller
{
    public function index(){

        $users = User::query()->where('slack_token', '!=', '')->get();
        $results = [];

        $users->each(function(User $user){
            $channel_service = new Channel($user->slack_token);
            foreach($channel_service->getAll() as $channel_item){
                $channel = new ChannelModel();

                if($channel_item['type'] == "direct"){
                    $member = $channel_item['members'];
                    $channel_item['members'] = array();
                    $channel_item['members'][] = $member;
                    $channel_item['members'][] = $user->slack_id;
                }

                $channel->createFromArray($channel_item);
            }
        });
    }
}
