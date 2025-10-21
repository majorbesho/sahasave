<?php

/*
|--------------------------------------------------------------------------
| Documentation for this config :
|--------------------------------------------------------------------------
| online  => http://unisharp.github.io/laravel-filemanager/config
| offline => vendor/unisharp/laravel-filemanager/docs/config.md
 */

return [
'status'=>true,
    'language'=> [

        /**
         * Key is local code
         * index 0 carbon local code
         * index 1 php locale code setlocale()
         * index 2 true for TRL
         * index 3  orignal lang
         * https://www.youtube.com/watch?v=I4fQ17had1U&list=PLvNu8E-aj20msH9hAAIQhRqibQLWYLkV4&index=2
         *
         */
        'en'=>['en','en_US',false,'English'],
        'ar'=>['ar','ar_SA',true,'Arabic'],
    ]

];

