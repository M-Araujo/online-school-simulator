<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;


class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', '=', 'student')->get();
        $courses = Course::all();

        if($users->count() === 0 || $courses->count() === 0){
            $this->command->warn('no users where found. Skipping enrollment seeding.');
            return;
        }
        foreach($users as $user){
            $enrolledCourses = $courses->random(rand(1,3));


            foreach($enrolledCourses as $course){
                Enrollment::create([
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                    'enroled_at' => Carbon::now()->subDays(rand(1,60)),
                    'completed' => rand(0,1)
                ]);
            }
        }
    }
}
