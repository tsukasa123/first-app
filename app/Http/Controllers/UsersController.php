<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;
use App\Question;
use App\Follower;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $user_id = auth()->user()->id;
        $users = $user->where('id', '<>', $user_id)->paginate(15);

        // OOP
        // $all_users = $user->getAllUsers(auth()->user()->id);

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Question $question, Follower $follower)
    {
        $user_id = auth()->user()->id;

        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($user->id);
        $is_followed = $login_user->isFollowed($user->id);
        $questions = $question->where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(50);
        $question_count = $question->where('user_id', $user_id)->count();
        $follow_count = $follower->where('following_id', $user_id)->count();
        $follower_count = $follower->where('followed_id', $user_id)->count();

        return view('users.show', [
            'user' => $user,
            'is_following' => $is_following,
            'is_followed' => $is_followed,
            'questions' => $questions,
            'question_count' => $question_count,
            'follow_count' => $follow_count,
            'follower_count' => $follower_count
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'screen_name' => ['required', 'string', 'max:50', Rule::unique('users')->ignore($user->id)],
            'name' => ['required', 'string', 'max:255'],
            'profile_image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'profile_text' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)]
        ]);
        $validator->validate();
        $user->updateProfile($data);

        return redirect('users/'.$user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // Follow Function
    public function follow(User $user)
    {
        $follower = auth()->user();
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following) {
            $follower->follow($user->id);
            return back();
        }
    }

    // Unfollow Function
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            $follower->unfollow($user->id);
            return back();
        }
        
    }
}
