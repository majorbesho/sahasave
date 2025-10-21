<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class Post extends Model implements TranslatableContract

{
    use Translatable;
    use HasFactory;

    // 'id', 'user_id', 'photo', 'url', 'video', 'cat_id', 'created_at', 'updated_at'


    public $translatedAttributes = [
         'title', 'content', 'smallContent'
        ];
        protected $fillable = [

            'id', 'post_id', 'locale','video','url', 'created_at', 'updated_at', 'deleted_at'
        ];

        protected $table='posts';

}
