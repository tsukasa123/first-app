<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Question;
use App\Answer;
use App\Follower;
use Session;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        $user = auth()->user();
        // $user_id = auth()->user()->id;

        $questions = $question->orderBy('created_at', 'DESC')->paginate(10);

        // $questions = $question->where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(50);

        return view('questions.index', [
            'user' => $user,
            'questions' => $questions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        return view('questions.create', [
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Question $question)
    {
        $user = auth()->user();
        $data = $request->all();
        $validator = Validator::make($data, [
            'text' => ['required', 'string',]
        ]);

        $validator->validate();
        $question->questionStore($user->id, $data);

        Session::flash('success', 'Your Question Posted Successfuly!');

        return redirect('questions');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question, Answer $answer)
    {
        $user = auth()->user();
        $question = $question->getQuestion($question->id);
        $answers = $answer->getAnswers($question->id);
        
        return view('questions.show', [
            'user' => $user,
            'question' => $question,
            'answers' => $answers
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $user = auth()->user();
        $user_id = $user->id;
        $question_id = $question->id;

        $questions = $question->where('user_id', $user_id)->where('id', $question_id)->first();

        if (!isset($questions)) {
            return redirect('questions');
        }

        return view('questions.edit', [
            'user' => $user,
            'questions' => $questions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'text' => ['required', 'string']
        ]);

        $validator->validate();
        $question->questionUpdate($question->id, $data);

        Session::flash('success', 'Your Question Edited Successfuly!');

        return redirect('questions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $user = auth()->user();
        $user_id = $user->id;
        $question_id = $question->id;
        $question->where('user_id', $user_id)->where('id', $question_id)->delete();

        Session::flash('success', 'Your Question Deleted Successfuly!');

        return redirect('questions');
        // return back();
    }

    public function search(Question $question)
    {
        // $user = auth()->user();
        // $user_id = $user->id;
        // $question_id = $question->id;

        // $questions = $question->where('user_id', $user_id)->where('id', $question_id)->first();

        $questions = $question->where('text', 'like', '%'.request('query').'%')->get();

        return view('questions.results', [
            'questions' => $questions,
            'query' => request('query')
        ]);
    }

    public function trend(Question $question)
    {
        $user = auth()->user();
        $questions = Question::withCount('favorites')->orderBy('favorites_count', 'desc')->paginate(10);

        return view('questions.trend', [
            'user' => $user,
            'questions' => $questions
        ]);
    }
}
