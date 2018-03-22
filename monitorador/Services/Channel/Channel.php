<?php

namespace Monitorador\Services\Channel;

use Carbon\Carbon;
use Monitorador\Services\Slack\Slack;

class Channel
{
    const type = [
        'channel'=>[
            'list'=>'channels.list',
            'history'=>'channels.history',
            'result'=>[
                'list'=>'channels',
                'history'=>'messages'
            ]
        ],
        'direct'=>[
            'list'=>'im.list',
            'history'=>'im.history',
            'result'=>[
                'list'=>'ims',
                'history'=>'messages'
            ]
        ],
        'group'=>[
            'list'=>'mpim.list',
            'history'=>'mpim.history',
            'result'=>[
                'list'=>'groups',
                'history'=>'messages'
            ]
        ]
    ];

    private $slack;
    private $type;

    public function __construct($token)
    {
        $this->slack = Slack::init($token);
    }

    public function getAll(){
        $channels = collect();
        foreach(['channel', 'direct', 'group'] as $type) {
            $channels = $channels->concat($this->getMessagesWithChannel($type));
        }
        return $channels->toArray();
    }

    public function getMessagesWithChannel($type)
    {
        $this->type = $type;
        $itens = collect();

        foreach($this->listChannels() as $channel){
            $item = $this->getFilterChannel($channel);
            if($item == null){
                continue;
            }
            foreach($this->listMessages($channel) as $item_mensage){
                $message = $this->getFilterMessage($item_mensage);
                $item['messages']->push($message);
            }
            $item['messages'] = $item['messages']->toArray();
            $itens->push($item);
        }

        return $itens->toArray();
    }

    private function getFilterChannel($channel){
        $item['id']   = $channel['id'];
        if(isset($channel['name'])){
            $item['name'] = $channel['name'];
        }else{
            $item['name'] = null;
        }

        $item['type'] = $this->type;
        $item['messages'] = collect();
        if(isset($channel['members'])){
            $item['members'] = $channel['members'];
        }else{
            if($channel['user'] == "USLACKBOT"){
                return null;
            }
            $item['members'] = $channel['user'];
        }

        return $item;
    }

    private function getFilterMessage($mensage){
        $item['user_id'] = $mensage['user'];
        $item['text'] = $mensage['text'];
        $item['datetime'] = Carbon::createFromTimestamp($mensage['ts'], new \DateTimeZone('America/Sao_Paulo'));
        $item['hash'] = md5($item['user_id'].$item['text'].$item['datetime']->toAtomString());
        if(!isset($mensage['subtype'])){
            $item['type'] = 'message';
        }else{
            $item['type'] = $mensage['subtype'];
        }

        return $item;
    }

    private function listChannels(){
        return $this->slack->execute(self::type[$this->type]['list'])[self::type[$this->type]['result']['list']];
    }

    private function listMessages($channel){
        $messages = collect();

        $config = [
            'channel'=>$channel['id'],
            'count'=>1000,
            'unreads'=>1
        ];

        do {
            $history = $this->slack->execute(self::type[$this->type]['history'], $config);
            $messages = $messages->concat($history[self::type[$this->type]['result']['history']]);
            $config['latest'] = $messages->last()['ts'];
        }while($history['has_more']);

        return $messages->toArray();
    }


}