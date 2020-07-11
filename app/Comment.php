<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public function author() 
    {
        $this->belongsTo(User::class);
    }

    public function article()
    {
        $this->belongsTo(Article::class);
    }
}
