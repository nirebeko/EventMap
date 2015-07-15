<?php

namespace App\Http\Controllers;
use Request;
use App\Models\User;
use App\Models\Post;
use Validator;
use Hash;
use Auth;

// Frundesliste
// Freunde hinzufügen(m zu n verknüpfung)
// attach + detach
// htc controller (rechte vergeben)

class UserController extends Controller
{

	public function getIndex()
	{
        $user = Auth::user();
		$users = $user->other_users();
		return view('users.index')->with('users', $users);
	}

	public function getShow()
	{
		$users = User::all();
		echo count($users);
	}

	public function getTimeline()
	{
		$user = Auth::user();
		$posts = $user->posts()->orderBy('updated_at','DESC')->get();
		//$posts = Post::where('user_id', '=', $user_id)->get();
		return view('users.timeline')->with('posts', $posts)->with('user', $user);
	}

	    /**
     * new-Action
     */
    public function getNew()
    {
    	$user = new User();
        return view('users.new')->with('user', $user);
    }

    /**
     * new-Action (Formularauswertung)
     */
    public function postNew()
    {
		$validator = Validator::make(Request::all(), User::$rules);
 
    	if ($validator->passes()) 
    	{
        	// validation has passed, save user in DB
        	$user = new User;
		    $user->firstname = Request::input('firstname');
		    $user->lastname = Request::input('lastname');
		    $user->username = Request::input('username');
		    $user->email = Request::input('email');
		    $user->password = Hash::make(Request::input('password'));
		    $user->save();
		 
		    return redirect('users')->with('message', 'success|Student erfolgreich angelegt!');
    	} 
    	else 
    	{
        	// validation has failed, display error messages   
        	return redirect('users/new')->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
    	}
    }

    public function getFriendlist(){
		$user = Auth::user();
		return view('users.friendlist')->with('user', $user);
    }

    /* Im Controller */
    public function getAddfriend($partner_id){
    	$user = Auth::user();
		$user->friends()->attach($partner_id);
		return redirect('users');
    }

    public function getDelfriend($partner_id){
    	$user = Auth::user();
    	$user->friends()->detach($partner_id);
    	return redirect('users/friendlist');
    }

    /*public function getSearch($search_Word)
    {
        $user = User::find($search_Word);
    }*/
}
