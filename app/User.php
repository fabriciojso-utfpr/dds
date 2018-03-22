<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Lisennk\Laravel\SlackWebApi\SlackApi;

/**
 * App\Model\User
 *
 * @property int $id
 * @property string $slack_id
 * @property string $slack_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereSlackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereSlackToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $name
 * @property string $email
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereName($value)
 */
class User extends Model
{
    protected $fillable = ['id', 'slack_id', 'slack_token'];

    public static function createFromIdSlack($user_id)
    {
        $token = User::all()->first()->slack_token;
        $slack = new SlackApi($token);
        $userSlack = $slack->execute('users.info', ['user'=>$user_id])['user'];

        $user = User::whereSlackId($userSlack['id'])->first();
        if($user == null){
            $user = new User();
        }
        $user->name = $userSlack['profile']['real_name'];
        $user->slack_id = $userSlack['id'];
        $user->email = $userSlack['profile']['email'];
        $user->save();

        return $user;
    }

    public function channel(){
        return $this->belongsToMany('App\Channel');
    }
}
