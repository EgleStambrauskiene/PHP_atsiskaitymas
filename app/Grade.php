<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Grade extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lecture_id',
        'student_id',
        'grade',
    ];

    public $timestamps = false;

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function setGradeAttribute($grade)
    {
        $this->attributes['grade'] = Str::title($grade);
    }
}
