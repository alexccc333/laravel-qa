<?php

namespace App;

use \App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getUrlAttribute()
    {
        return route("questions.show", $this->id);
    }

    public function getCreatedDataAttribute()
    {
        return $this->created_ad->diffForHumans();
    }

    public function getStatusAttribute()
    {
        if ($this->answer > 0) {
            if ($this->best_answered_id) {
                return "answered-accepted";
            }
            return 'answered';
        }
        return "unanswered";

    }
}
