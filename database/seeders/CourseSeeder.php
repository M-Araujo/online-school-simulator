<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;

use Database\Factories\CourseFactory;


class CourseSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $courses = [
            [
                'title' => 'Full-Stack Web Development with Laravel & Vue.js',
                'description' => 'Learn to build complete web applications using Laravel for backend and Vue.js for frontend.',
            ],
            [
                'title' => 'Introduction to Data Science with Python',
                'description' => 'Explore data analysis, visualization, and machine learning using Python libraries like Pandas and scikit-learn.',
            ],
            [
                'title' => 'UX/UI Design Principles for Modern Web Apps',
                'description' => 'Master the fundamentals of user experience and interface design for responsive websites and mobile apps.',
            ],
            [
                'title' => 'DevOps Essentials with Docker and Kubernetes',
                'description' => 'Understand continuous integration, containerization, and orchestration with real-world DevOps tools.',
            ],
            [
                'title' => 'React Native: Build Mobile Apps for iOS and Android',
                'description' => 'Develop cross-platform mobile applications with JavaScript using the React Native framework.',
            ],
            [
                'title' => 'Cybersecurity for Beginners',
                'description' => 'Learn the basic concepts of online security, ethical hacking, and how to protect systems and networks.',
            ],
            [
                'title' => 'SEO & Digital Marketing Fundamentals',
                'description' => 'Understand search engine optimization, content marketing, and how to grow online visibility.',
            ],
            [
                'title' => 'Cloud Computing with AWS',
                'description' => 'Get hands-on experience deploying cloud-based applications and services using AWS.',
            ],
            [
                'title' => 'Agile Project Management & Scrum',
                'description' => 'Learn how to lead software projects using Agile methodology and the Scrum framework.',
            ],
            [
                'title' => 'Database Design & SQL for Developers',
                'description' => 'Design efficient relational databases and perform complex queries using SQL.',
            ],
        ];

        foreach ($courses as $course) {
            $startDate = now()->addDays(rand(1, 30));
            $endDate = (clone $startDate)->addWeeks(rand(4, 12));
            Course::create([
                'teacher_id' => User::where('role', 'teacher')->inRandomOrder()->first()->id,
                'title' => $course['title'],
                'description' =>  $course['description'],
                'duration_hours' => rand(5, 100),
                'content' => $course['description'] . "\n\n" . fake()->paragraph(3),
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d'),
                'schedule' => json_encode([
                    'days' => ['Monday', 'Wednesday', 'Friday'],
                    'time' => '10:00 AM - 12:00 PM',
                ]),
                'intro_video_url' => 'https://www.w3schools.com/html/mov_bbb.mp4',
                'is_published' => true
            ]);
        }
    }
}
