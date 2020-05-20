<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Answer extends Model
{
    use SoftDeletes;

    protected $fillable = ['text'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAnswers($question_id)
    {
        return $this->with('user')->where('question_id', $question_id)->get();
    }

    public function answerStore($user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->question_id = $data['question_id'];
        $this->text = $data['text'];
        $this->save();

        return;
    }
}
