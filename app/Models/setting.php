<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class setting extends Model implements TranslatableContract
{
    use Translatable;

    use HasFactory;
    public $translatedAttributes = [
    'WHATWEDO','OURMISSION',
    'WHYCHOOSEUS','ProductsandServices',
    'no1','text1',
    'no2','text2',
    'no3','text3',
    'no4','text4',
    'text5',
    'address','city',
    'text5','title','content',
    'smallContent',
    ];


    protected $fillable = [
        // $table->string('locale')->index();
        'id',
        'logo',
        'favicon',
        'facebookUrl',
        'locale',
        'twiettr',
        'linkedin',
        'insta',
        'youtube',
        'google',
        'email',
        'tele',
    ];

    protected $table='settings';

    public static function checksetting (){
        $setting = self::all();
    }
}
