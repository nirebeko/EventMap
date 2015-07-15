<?php

namespace App\Models;



use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    public function friends()
	{
		return $this->belongsToMany('App\Models\User', 'friend_user', 'user_id', 'friend_id');
	}

	public function posts()
	{
	    return $this->hasMany('App\Models\Post');
	}

	public function messagesSent()
	{
	    return $this->hasMany('App\Models\Message', 'sender_id');
	}

	public function messagesReceived()
	{
	    return $this->hasMany('App\Models\Message', 'receiver_id');
	}

	public function messages()
	{
	    return Message::where('sender_id', '=', $this->id)
	    			->orWhere('receiver_id', '=', $this->id)
	    			->orderBy('updated_at', 'DESC')
	    			->get();
	}

	public function other_users()
	{
	    return User::where('id', '!=',$this->id)
	    			->get();
	}

	/*public function search_user($searchWord)
	{
		return User::where('id', '=', $searchWord)
					->orWhere('name', '=', $searchWord)
					->get();
	}*/

	public function chat($partner_id = 0)
	{
		 return Message::where('receiver_id', '=', $partner_id)
	    			->where('sender_id', '=', $this->id)
	    			->orWhere('sender_id', '=', $partner_id)
	    			->where('receiver_id', '=', $this->id)
	    			->orderBy('updated_at', 'DESC')
	    			->get();
	}

	
	public static $rules = array(
	    'firstname'=>'required|alpha|min:2',
	    'lastname'=>'required|alpha|min:2',
	    'email'=>'required|email|unique:users',
	    'password'=>'required|alpha_num|between:6,12|confirmed',
	    'password_confirmation'=>'required|alpha_num|between:6,12',
    );

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
}