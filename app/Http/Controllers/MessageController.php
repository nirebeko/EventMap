<?php

namespace App\Http\Controllers;
use Request;
use App\Models\Message;
use App\Models\User;
use Validator;
use Auth;


class MessageController extends Controller
{

	public function getIndex($user_id)
	{
		$user = User::find($user_id);
		$messages = $user->messages();
		return view('messages.index')->with('messages', $messages)->with('user', $user);
	}

	public function postChat($partner_id)
	{
		$validator = validator::make(Request::all(),Message::$rules);
		$user = Auth::user();
		$partner = User::find($partner_id);
		
		if($validator->passes())
		{
			$post = new Message;
			$post->sender_id = $user->id;
			$post->receiver_id = $partner_id;
			$post->content = Request::input('content');
			$post->save();
		}
		$messages = $user->chat($partner_id);
		//return view('messages.chat')->with('messages', $messages)->with('user', $user)->with('partner', $partner);
		return redirect('messages/chat/'.$partner_id);
	}


	public function getChat($partner_id)
	{
		$user = Auth::user();
		$messages = $user->chat($partner_id);
		$partner = User::find($partner_id);
		return view('messages.chat')->with('messages', $messages)->with('user', $user)->with('partner', $partner);
	}

	public function getTestdata()
	{
		for ($i = 0; $i < 5; $i++)
		{
			$post = new Message();
			$post->sender_id = 1;
			$post->receiver_id = 2;
			$post->content = '1 - 2: '.md5(time()*rand());
			$post->save();

			$post = new Message();
			$post->sender_id = 2;
			$post->receiver_id = 1;
			$post->content = '2 - 1: '.md5(time()*rand());
			$post->save();

			$post = new Message();
			$post->sender_id = 1;
			$post->receiver_id = 3;
			$post->content = '1 - 3: '.md5(time()*rand());
			$post->save();

			$post = new Message();
			$post->sender_id = 3;
			$post->receiver_id = 1;
			$post->content = '3 - 1: '.md5(time()*rand());
			$post->save();

		}
		
	}
}
