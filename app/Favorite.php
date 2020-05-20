<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public $timestamps = false;

    public function isFavorite($user_id, $question_id)
    {
        return (boolean) $this->where('user_id', $user_id)->where('question_id', $question_id)->first();
    }

    public function storeFavorite($user_id, $question_id)
    {
        $this->user_id = $user_id;
        $this->question_id = $question_id;
        $this->save();

        return;
    }

    public function destroyFavorite($favorite_id)
    {
        return $this->where('id', $favorite_id)->delete();
    }
}