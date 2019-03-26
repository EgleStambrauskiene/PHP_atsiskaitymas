<?php

use Illuminate\Database\Seeder;

class GradesTableSeeder extends Seeder
{
    // Static grades data
    private $grades = [
        // 1 lecture
        [
            'lecture_id' => 1,
            'student_id' => 1,
            'grade' => 2,
        ],
        [
            'lecture_id' => 1,
            'student_id' => 2,
            'grade' => 2,
        ],
        [
            'lecture_id' => 1,
            'student_id' => 3,
            'grade' => 2,
        ],
        [
            'lecture_id' => 1,
            'student_id' => 4,
            'grade' => 2,
        ],
        [
            'lecture_id' => 1,
            'student_id' => 5,
            'grade' => 2,
        ],
        [
            'lecture_id' => 1,
            'student_id' => 9,
            'grade' => 2,
        ],
        [
            'lecture_id' => 1,
            'student_id' => 10,
            'grade' => 2,
        ],
        [
            'lecture_id' => 1,
            'student_id' => 12,
            'grade' => 2,
        ],
        [
            'lecture_id' => 1,
            'student_id' => 13,
            'grade' => 2,
        ],
        // 2 lecture
        [
            'lecture_id' => 2,
            'student_id' => 1,
            'grade' => 3,
        ],
        [
            'lecture_id' => 2,
            'student_id' => 2,
            'grade' => 3,
        ],
        [
            'lecture_id' => 2,
            'student_id' => 3,
            'grade' => 3,
        ],
        [
            'lecture_id' => 2,
            'student_id' => 4,
            'grade' => 3,
        ],
        [
            'lecture_id' => 2,
            'student_id' => 5,
            'grade' => 3,
        ],
        [
            'lecture_id' => 2,
            'student_id' => 9,
            'grade' => 3,
        ],
        [
            'lecture_id' => 2,
            'student_id' => 10,
            'grade' => 3,
        ],
        [
            'lecture_id' => 2,
            'student_id' => 12,
            'grade' => 3,
        ],
        [
            'lecture_id' => 2,
            'student_id' => 13,
            'grade' => 3,
        ],
        // 3 lecture
        [
            'lecture_id' => 3,
            'student_id' => 1,
            'grade' => 4,
        ],
        [
            'lecture_id' => 3,
            'student_id' => 2,
            'grade' => 4,
        ],
        [
            'lecture_id' => 3,
            'student_id' => 3,
            'grade' => 4,
        ],
        [
            'lecture_id' => 3,
            'student_id' => 4,
            'grade' => 4,
        ],
        [
            'lecture_id' => 3,
            'student_id' => 5,
            'grade' => 4,
        ],
        [
            'lecture_id' => 3,
            'student_id' => 9,
            'grade' => 4,
        ],
        [
            'lecture_id' => 3,
            'student_id' => 10,
            'grade' => 4,
        ],
        [
            'lecture_id' => 3,
            'student_id' => 12,
            'grade' => 4,
        ],
        [
            'lecture_id' => 3,
            'student_id' => 13,
            'grade' => 4,
        ],
        // 4 lecture
        [
            'lecture_id' => 4,
            'student_id' => 1,
            'grade' => 5,
        ],
        [
            'lecture_id' => 4,
            'student_id' => 2,
            'grade' => 5,
        ],
        [
            'lecture_id' => 4,
            'student_id' => 3,
            'grade' => 5,
        ],
        [
            'lecture_id' => 4,
            'student_id' => 4,
            'grade' => 5,
        ],
        [
            'lecture_id' => 4,
            'student_id' => 5,
            'grade' => 5,
        ],
        [
            'lecture_id' => 4,
            'student_id' => 9,
            'grade' => 5,
        ],
        [
            'lecture_id' => 4,
            'student_id' => 10,
            'grade' => 5,
        ],
        [
            'lecture_id' => 4,
            'student_id' => 12,
            'grade' => 5,
        ],
        [
            'lecture_id' => 4,
            'student_id' => 13,
            'grade' => 5,
        ],
        // 5 lecture
        [
            'lecture_id' => 5,
            'student_id' => 1,
            'grade' => 6,
        ],
        [
            'lecture_id' => 5,
            'student_id' => 2,
            'grade' => 6,
        ],
        [
            'lecture_id' => 5,
            'student_id' => 3,
            'grade' => 6,
        ],
        [
            'lecture_id' => 5,
            'student_id' => 4,
            'grade' => 6,
        ],
        [
            'lecture_id' => 5,
            'student_id' => 5,
            'grade' => 6,
        ],
        [
            'lecture_id' => 5,
            'student_id' => 9,
            'grade' => 6,
        ],
        [
            'lecture_id' => 5,
            'student_id' => 10,
            'grade' => 6,
        ],
        [
            'lecture_id' => 5,
            'student_id' => 12,
            'grade' => 6,
        ],
        [
            'lecture_id' => 5,
            'student_id' => 13,
            'grade' => 6,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = collect($this->grades);
        $grades->each(function ($item) {
        DB::table('grades')->insert($item);
        });
    }
}
