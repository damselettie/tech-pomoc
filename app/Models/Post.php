<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasTranslations;

        
    protected $fillable = ['title', 'content']; // lub inne pola
    public $translatable = ['title', 'content'];
}
