<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $fillable = ['text'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function getQuestion($question_id)
    {
        return $this->with('user')->where('id', $question_id)->first();
    }

    public function questionStore($user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->text = $data['text'];
        $this->save();
    
        return;
    }

    public function questionUpdate($question_id, Array $data)
    {
        $this->id = $question_id;
        $this->text = $data['text'];
        $this->update();

        return;
    }
}
