<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Lecture extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
    ];

    public $timestamps = false;


    public function grade()
    {
        return $this->hasMany(Grade::class);
    }

    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = Str::title($title);
    }

    public function setDescriptionAttribute($description)
    {
        $this->attributes['description'] = Str::title($description);
    }
}
