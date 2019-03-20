<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Student extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'phone',
    ];

    public $timestamps = false;

    public function grade()
    {
        return $this->hasMany(Grade::class);
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = Str::title($name);
    }

    public function setLastnameAttribute($lastname)
    {
        $this->attributes['lastname'] = Str::title($lastname);
    }
}
