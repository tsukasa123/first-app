<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Answer;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, Answer $answer)
    {
        $user = auth()->user();
        $data = $request->all();
        $validator = Validator::make($data, [
            'question_id' => ['required', 'integer'],
            'text' => ['required', 'string', 'max:255']
        ]);

        $validator->validate();
        $answer->answerStore($user->id, $data);

        Session::flash('success', 'Your Answer Posted Successfuly!');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        $user = auth()->user();
        $user_id = $user->id;
        $answer_id = $answer->id;

        $answers = $answer->where('user_id', $user_id)->where('id', $answer_id)->first();

        if(!isset($answers)) {
            return back();
        }

        return view('answers.edit', [
            'user' => $user,
            'answers' => $answers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'text' => ['required', 'string']
        ]);

        $validator->validate();
        $answer->answerUpdate($answer->id, $data);

        Session::flash('success', 'Your Answer Edited Successfuly!');

        return redirect('questions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $user = auth()->user();
        $user_id = $user->id;
        $answer_id = $answer->id;
        $answer->where('user_id', $user_id)->where('id', $answer_id)->delete();

        Session::flash('success', 'Your Answer Deleted Successfuly!');

        return back();
    }
}
