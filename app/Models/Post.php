<?php

namespace App\Models;

use Michelf\Markdown;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function images()
    {
        return $this->belongsToMany(Image::class);
    }

    public function getBodyAttribute($body)
    {
        $parser = new Markdown;
        $parser->code_span_content_func = function ($code) {
            return "<code>$code</code>";
        };


        return $parser->transform($body);
    }
}
