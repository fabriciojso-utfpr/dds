<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Menssage
 *
 * @property int $id
 * @property string $slack_id
 * @property string $text
 * @property int $user_id
 * @property string $date
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereSlackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereUserId($value)
 * @mixin \Eloquent
 */
class Message extends Model
{
    protected $fillable = ['id', 'hash', 'text', 'user_id', 'date'];
    public $timestamps = false;

    public function channel(){
        return $this->belongsTo('App\Channel');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function createFromArray($channel_id, $message_item)
    {
        $message = $this->where(['hash'=>$message_item['hash']])->first();
        if($message == null){
            $message = new Message();
            $message->text = $message_item['text'];
            $message->date = $message_item['datetime'];
            $message->hash = $message_item['hash'];
            $message->type = $message_item['type'];
            $message->channel()->associate(Channel::whereId($channel_id)->first());
            $message->user()->associate(User::createFromIdSlack($message_item['user_id']));
            $message->save();
        }
        return $message;
    }
}
