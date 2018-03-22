<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Channel
 *
 * @property int $id
 * @property string $slack_id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Channel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Channel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Channel whereSlackId($value)
 * @mixin \Eloquent
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Channel whereType($value)
 */
class Channel extends Model
{
    protected $fillable = ['name', 'slack_id', 'type'];
    public $timestamps = false;


    public function members(){
        return $this->belongsToMany('App\User');
    }

    public function createFromArray($channel_item){
        $channel = self::whereSlackId($channel_item['id'])->first();
        if($channel == null){
            $channel = new Channel();
        }
        $channel->name = $channel_item['name'];
        $channel->type = $channel_item['type'];
        $channel->slack_id = $channel_item['id'];
        $channel->save();
        $channel->members()->sync($this->listMembersFromArray($channel_item['members']));
        $channel->save();
        $this->createMessagesFromArray($channel->id, $channel_item['messages']);

        return $channel;
    }

    private function listMembersFromArray($members){
        $membersArray = [];
        foreach ($members as $item) {
            $membersArray[] = User::createFromIdSlack($item)->id;
        }
        return $membersArray;
    }

    private function createMessagesFromArray($channel_id, $messages){
        foreach($messages as $message_item){
            (new Message())->createFromArray($channel_id, $message_item);
        }
    }
}
