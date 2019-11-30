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
            $code = str_replace("\n", '<br>', $code);
            $code = str_replace('\t', '&nbsp;&nbsp;', $code);
            $code = preg_replace("#^<br>|<br>$#", '', $code);
            return $code;
        };


        return $parser->transform($body);
    }
}
