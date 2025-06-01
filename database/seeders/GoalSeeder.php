<?php

namespace Database\Seeders;

use App\Models\Goal;
use App\Models\Task;
use Illuminate\Console\Command;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing goals and tasks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 🧹 Step 2: Truncate both tables
        Task::truncate();
        Goal::truncate();

        // 🔒 Step 3: Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); 
        $goals = [
            [
                'title' => 'Build Portfolio Website',
                'description' => 'A personal portfolio to showcase my work and resume online.',
                'status' => 'active',
                'deadline' => '2025-05-31',
                'tasks' => [
                    ['title' => 'Set up project structure', 'status' => 'in_progress', 'due_date' => '2025-04-15'],
                    ['title' => 'Create homepage layout', 'status' => 'in_progress', 'due_date' => '2025-04-20'],
                    ['title' => 'Add about section', 'status' => 'in_progress', 'due_date' => '2025-04-25'],
                    ['title' => 'Implement contact form', 'status' => 'in_progress', 'due_date' => '2025-04-30'],
                ],
            ],
            [
                'title' => 'Fitness Challenge - 30 Days',
                'description' => 'Complete a home workout every day for 30 days.',
                'status' => 'active',
                'deadline' => '2025-04-30',
                'tasks' => [
                    ['title' => 'Day 1 Workout', 'status' => 'completed', 'due_date' => '2025-04-01'],
                    ['title' => 'Day 2 Workout', 'status' => 'completed', 'due_date' => '2025-04-02'],
                    ['title' => 'Day 3 Workout', 'status' => 'completed', 'due_date' => '2025-04-03'],
                    ['title' => 'Day 4 Workout', 'status' => 'in_progress', 'due_date' => '2025-04-04'],
                    ['title' => 'Day 5 Workout', 'status' => 'in_progress', 'due_date' => '2025-04-05'],
                ],
            ],
            [
                'title' => 'Read 3 Books in a Month',
                'description' => 'Improve my knowledge and focus by reading productivity books.',
                'status' => 'active',
                'deadline' => '2025-04-30',
                'tasks' => [
                    ['title' => 'Finish "Atomic Habits"', 'status' => 'completed', 'due_date' => '2025-04-10'],
                    ['title' => 'Start "The 7 Habits of Highly Effective People"', 'status' => 'in_progress', 'due_date' => '2025-04-20'],
                    ['title' => 'Read "Deep Work"', 'status' => 'in_progress', 'due_date' => '2025-04-30'],
                ],
            ],
            [
                'title' => 'Launch Side Project on GitHub',
                'description' => 'Release a side project publicly to build portfolio credibility.',
                'status' => 'active',
                'deadline' => '2025-05-15',
                'tasks' => [
                    ['title' => 'Plan features', 'status' => 'completed', 'due_date' => '2025-04-05'],
                    ['title' => 'Develop core functionality', 'status' => 'in_progress', 'due_date' => '2025-04-15'],
                    ['title' => 'Test and fix bugs', 'status' => 'in_progress', 'due_date' => '2025-04-25'],
                    ['title' => 'Create documentation', 'status' => 'in_progress', 'due_date' => '2025-04-30'],
                ],
            ],
            [
                'title' => 'Learn a New Programming Language',
                'description' => 'Complete an online course on Python to enhance my skills.',
                'status' => 'active',
                'deadline' => '2025-06-01',
                'tasks' => [
                    ['title' => 'Enroll in Python course', 'status' => 'completed', 'due_date' => '2025-05-01'],
                    ['title' => 'Complete Week 1 lessons', 'status' => 'in_progress', 'due_date' => '2025-05-10'],
                    ['title' => 'Complete Week 2 lessons', 'status' => 'in_progress', 'due_date' => '2025-05-20'],
                    ['title' => 'Build a small project', 'status' => 'in_progress', 'due_date' => '2025-05-30'],
                ],
            ],
            [
                'title' => 'Master React Framework',
                'description' => 'Become proficient in React.js for modern web development.',
                'status' => 'active',
                'deadline' => '2025-06-15',
                'tasks' => [
                    ['title' => 'Complete React fundamentals course', 'status' => 'in_progress', 'due_date' => '2025-05-01'],
                    ['title' => 'Build a todo app with React', 'status' => 'in_progress', 'due_date' => '2025-05-15'],
                    ['title' => 'Learn React hooks', 'status' => 'in_progress', 'due_date' => '2025-05-30'],
                    ['title' => 'Create a complex project', 'status' => 'in_progress', 'due_date' => '2025-06-15'],
                ],
            ],
            [
                'title' => 'Start Morning Meditation Routine',
                'description' => 'Establish a daily 10-minute meditation practice.',
                'status' => 'active',
                'deadline' => '2025-07-01',
                'tasks' => [
                    ['title' => 'Download meditation app', 'status' => 'completed', 'due_date' => '2025-06-01'],
                    ['title' => 'Meditate for 5 minutes daily', 'status' => 'in_progress', 'due_date' => '2025-06-15'],
                    ['title' => 'Increase to 10 minutes daily', 'status' => 'in_progress', 'due_date' => '2025-06-30'],
                    ['title' => 'Track progress for 30 days', 'status' => 'in_progress', 'due_date' => '2025-07-01'],
                ],
            ],
            [
                'title' => 'Learn Database Design',
                'description' => 'Master SQL and database design principles.',
                'status' => 'active',
                'deadline' => '2025-07-15',
                'tasks' => [
                    ['title' => 'Complete SQL basics course', 'status' => 'in_progress', 'due_date' => '2025-06-15'],
                    ['title' => 'Practice with sample databases', 'status' => 'in_progress', 'due_date' => '2025-06-30'],
                    ['title' => 'Design a personal project database', 'status' => 'in_progress', 'due_date' => '2025-07-10'],
                    ['title' => 'Implement database optimization', 'status' => 'in_progress', 'due_date' => '2025-07-15'],
                ],
            ],
            [
                'title' => 'Complete a Marathon Training',
                'description' => 'Train for and complete a full marathon race.',
                'status' => 'active',
                'deadline' => '2025-10-01',
                'tasks' => [
                    ['title' => 'Create training schedule', 'status' => 'completed', 'due_date' => '2025-06-01'],
                    ['title' => 'Run 5K three times per week', 'status' => 'in_progress', 'due_date' => '2025-07-01'],
                    ['title' => 'Complete 10K runs weekly', 'status' => 'in_progress', 'due_date' => '2025-08-01'],
                    ['title' => 'Register for marathon', 'status' => 'in_progress', 'due_date' => '2025-09-01'],
                ],
            ],
            [
                'title' => 'Build a Personal Finance Tracker',
                'description' => 'Create a web application to track personal expenses.',
                'status' => 'active',
                'deadline' => '2025-08-01',
                'tasks' => [
                    ['title' => 'Design user interface mockups', 'status' => 'in_progress', 'due_date' => '2025-07-01'],
                    ['title' => 'Set up backend API', 'status' => 'in_progress', 'due_date' => '2025-07-15'],
                    ['title' => 'Implement expense tracking', 'status' => 'in_progress', 'due_date' => '2025-07-30'],
                    ['title' => 'Add reporting features', 'status' => 'in_progress', 'due_date' => '2025-08-01'],
                ],
            ],
            [
                'title' => 'Learn Spanish Conversational Level',
                'description' => 'Achieve conversational fluency in Spanish.',
                'status' => 'active',
                'deadline' => '2025-12-31',
                'tasks' => [
                    ['title' => 'Complete beginner course', 'status' => 'in_progress', 'due_date' => '2025-08-01'],
                    ['title' => 'Practice with native speakers', 'status' => 'in_progress', 'due_date' => '2025-10-01'],
                    ['title' => 'Watch Spanish movies', 'status' => 'in_progress', 'due_date' => '2025-11-01'],
                    ['title' => 'Take proficiency test', 'status' => 'in_progress', 'due_date' => '2025-12-31'],
                ],
            ],
            [
                'title' => 'Organize Digital Photo Collection',
                'description' => 'Sort and organize 10 years of digital photos.',
                'status' => 'active',
                'deadline' => '2025-09-01',
                'tasks' => [
                    ['title' => 'Backup all photos to cloud', 'status' => 'completed', 'due_date' => '2025-07-15'],
                    ['title' => 'Delete duplicate photos', 'status' => 'in_progress', 'due_date' => '2025-08-01'],
                    ['title' => 'Create folders by year/event', 'status' => 'in_progress', 'due_date' => '2025-08-15'],
                    ['title' => 'Tag important photos', 'status' => 'in_progress', 'due_date' => '2025-09-01'],
                ],
            ],
            [
                'title' => 'Start a Podcast',
                'description' => 'Launch a weekly podcast on technology topics.',
                'status' => 'active',
                'deadline' => '2025-09-15',
                'tasks' => [
                    ['title' => 'Plan podcast format and topics', 'status' => 'completed', 'due_date' => '2025-08-01'],
                    ['title' => 'Purchase recording equipment', 'status' => 'in_progress', 'due_date' => '2025-08-15'],
                    ['title' => 'Record pilot episode', 'status' => 'in_progress', 'due_date' => '2025-09-01'],
                    ['title' => 'Publish on podcast platforms', 'status' => 'in_progress', 'due_date' => '2025-09-15'],
                ],
            ],
            [
                'title' => 'Learn Machine Learning Basics',
                'description' => 'Understand fundamental concepts of machine learning.',
                'status' => 'active',
                'deadline' => '2025-11-01',
                'tasks' => [
                    ['title' => 'Complete ML course on Coursera', 'status' => 'in_progress', 'due_date' => '2025-09-01'],
                    ['title' => 'Implement linear regression', 'status' => 'in_progress', 'due_date' => '2025-09-15'],
                    ['title' => 'Build a classification model', 'status' => 'in_progress', 'due_date' => '2025-10-15'],
                    ['title' => 'Create ML portfolio project', 'status' => 'in_progress', 'due_date' => '2025-11-01'],
                ],
            ],
            [
                'title' => 'Declutter and Minimize Possessions',
                'description' => 'Reduce belongings by 50% using minimalism principles.',
                'status' => 'active',
                'deadline' => '2025-10-01',
                'tasks' => [
                    ['title' => 'Sort through clothing', 'status' => 'in_progress', 'due_date' => '2025-08-15'],
                    ['title' => 'Organize books and media', 'status' => 'in_progress', 'due_date' => '2025-09-01'],
                    ['title' => 'Clear out storage areas', 'status' => 'in_progress', 'due_date' => '2025-09-15'],
                    ['title' => 'Donate or sell unused items', 'status' => 'in_progress', 'due_date' => '2025-10-01'],
                ],
            ],
            [
                'title' => 'Master Touch Typing',
                'description' => 'Achieve 80+ WPM typing speed with 95% accuracy.',
                'status' => 'active',
                'deadline' => '2025-08-31',
                'tasks' => [
                    ['title' => 'Practice 30 minutes daily', 'status' => 'in_progress', 'due_date' => '2025-08-01'],
                    ['title' => 'Reach 60 WPM milestone', 'status' => 'in_progress', 'due_date' => '2025-08-15'],
                    ['title' => 'Improve accuracy to 95%', 'status' => 'in_progress', 'due_date' => '2025-08-25'],
                    ['title' => 'Take final typing test', 'status' => 'in_progress', 'due_date' => '2025-08-31'],
                ],
            ],
            [
                'title' => 'Build a Weather App',
                'description' => 'Create a mobile-responsive weather application.',
                'status' => 'active',
                'deadline' => '2025-09-30',
                'tasks' => [
                    ['title' => 'Research weather APIs', 'status' => 'completed', 'due_date' => '2025-08-15'],
                    ['title' => 'Design app interface', 'status' => 'in_progress', 'due_date' => '2025-09-01'],
                    ['title' => 'Implement API integration', 'status' => 'in_progress', 'due_date' => '2025-09-15'],
                    ['title' => 'Add location features', 'status' => 'in_progress', 'due_date' => '2025-09-30'],
                ],
            ],
            [
                'title' => 'Learn Digital Photography',
                'description' => 'Master DSLR camera settings and composition techniques.',
                'status' => 'active',
                'deadline' => '2025-11-15',
                'tasks' => [
                    ['title' => 'Study camera manual modes', 'status' => 'in_progress', 'due_date' => '2025-09-15'],
                    ['title' => 'Practice composition rules', 'status' => 'in_progress', 'due_date' => '2025-10-01'],
                    ['title' => 'Take 100 photos weekly', 'status' => 'in_progress', 'due_date' => '2025-10-31'],
                    ['title' => 'Create photo portfolio', 'status' => 'in_progress', 'due_date' => '2025-11-15'],
                ],
            ],
            [
                'title' => 'Start Vegetable Garden',
                'description' => 'Grow organic vegetables in backyard garden.',
                'status' => 'active',
                'deadline' => '2025-10-31',
                'tasks' => [
                    ['title' => 'Plan garden layout', 'status' => 'completed', 'due_date' => '2025-08-01'],
                    ['title' => 'Prepare soil and beds', 'status' => 'in_progress', 'due_date' => '2025-08-15'],
                    ['title' => 'Plant seeds and seedlings', 'status' => 'in_progress', 'due_date' => '2025-09-01'],
                    ['title' => 'Harvest first vegetables', 'status' => 'in_progress', 'due_date' => '2025-10-31'],
                ],
            ],
            [
                'title' => 'Learn Video Editing',
                'description' => 'Master video editing software for content creation.',
                'status' => 'active',
                'deadline' => '2025-12-01',
                'tasks' => [
                    ['title' => 'Choose editing software', 'status' => 'completed', 'due_date' => '2025-09-01'],
                    ['title' => 'Complete beginner tutorials', 'status' => 'in_progress', 'due_date' => '2025-10-01'],
                    ['title' => 'Edit first project video', 'status' => 'in_progress', 'due_date' => '2025-11-01'],
                    ['title' => 'Create advanced effects', 'status' => 'in_progress', 'due_date' => '2025-12-01'],
                ],
            ],
            [
                'title' => 'Complete a Coding Bootcamp',
                'description' => 'Finish intensive full-stack development program.',
                'status' => 'active',
                'deadline' => '2025-03-01',
                'tasks' => [
                    ['title' => 'Apply to bootcamp programs', 'status' => 'completed', 'due_date' => '2025-10-01'],
                    ['title' => 'Complete pre-work assignments', 'status' => 'in_progress', 'due_date' => '2025-11-15'],
                    ['title' => 'Attend bootcamp sessions', 'status' => 'in_progress', 'due_date' => '2025-02-15'],
                    ['title' => 'Build capstone project', 'status' => 'in_progress', 'due_date' => '2025-03-01'],
                ],
            ],
            [
                'title' => 'Learn Music Production',
                'description' => 'Create and produce original music tracks.',
                'status' => 'active',
                'deadline' => '2025-01-01',
                'tasks' => [
                    ['title' => 'Set up home studio', 'status' => 'in_progress', 'due_date' => '2025-10-15'],
                    ['title' => 'Learn DAW software', 'status' => 'in_progress', 'due_date' => '2025-11-15'],
                    ['title' => 'Record first track', 'status' => 'in_progress', 'due_date' => '2025-12-15'],
                    ['title' => 'Publish music online', 'status' => 'in_progress', 'due_date' => '2025-01-01'],
                ],
            ],
            [
                'title' => 'Build E-commerce Website',
                'description' => 'Create an online store with payment processing.',
                'status' => 'active',
                'deadline' => '2025-02-01',
                'tasks' => [
                    ['title' => 'Choose e-commerce platform', 'status' => 'completed', 'due_date' => '2025-11-01'],
                    ['title' => 'Design product catalog', 'status' => 'in_progress', 'due_date' => '2025-12-01'],
                    ['title' => 'Integrate payment gateway', 'status' => 'in_progress', 'due_date' => '2025-12-31'],
                    ['title' => 'Launch online store', 'status' => 'in_progress', 'due_date' => '2025-02-01'],
                ],
            ],
            [
                'title' => 'Learn Chess Strategy',
                'description' => 'Improve chess rating to intermediate level.',
                'status' => 'active',
                'deadline' => '2025-06-01',
                'tasks' => [
                    ['title' => 'Study chess openings', 'status' => 'in_progress', 'due_date' => '2025-12-01'],
                    ['title' => 'Practice tactics daily', 'status' => 'in_progress', 'due_date' => '2025-02-01'],
                    ['title' => 'Play rated games online', 'status' => 'in_progress', 'due_date' => '2025-04-01'],
                    ['title' => 'Join local chess club', 'status' => 'in_progress', 'due_date' => '2025-06-01'],
                ],
            ],
            [
                'title' => 'Write a Short Story Collection',
                'description' => 'Complete 12 short stories for publication.',
                'status' => 'active',
                'deadline' => '2025-08-01',
                'tasks' => [
                    ['title' => 'Outline story concepts', 'status' => 'in_progress', 'due_date' => '2025-12-15'],
                    ['title' => 'Write first 6 stories', 'status' => 'in_progress', 'due_date' => '2025-03-01'],
                    ['title' => 'Complete remaining stories', 'status' => 'in_progress', 'due_date' => '2025-06-01'],
                    ['title' => 'Edit and publish collection', 'status' => 'in_progress', 'due_date' => '2025-08-01'],
                ],
            ],
            [
                'title' => 'Master Public API Development',
                'description' => 'Build and deploy a RESTful API service.',
                'status' => 'active',
                'deadline' => '2025-04-01',
                'tasks' => [
                    ['title' => 'Learn API design principles', 'status' => 'in_progress', 'due_date' => '2025-01-01'],
                    ['title' => 'Build API with authentication', 'status' => 'in_progress', 'due_date' => '2025-02-15'],
                    ['title' => 'Add rate limiting and caching', 'status' => 'in_progress', 'due_date' => '2025-03-15'],
                    ['title' => 'Deploy to production server', 'status' => 'in_progress', 'due_date' => '2025-04-01'],
                ],
            ],
            [
                'title' => 'Learn Woodworking Basics',
                'description' => 'Build furniture pieces using traditional techniques.',
                'status' => 'active',
                'deadline' => '2025-07-01',
                'tasks' => [
                    ['title' => 'Set up workshop space', 'status' => 'in_progress', 'due_date' => '2025-02-01'],
                    ['title' => 'Learn basic joinery techniques', 'status' => 'in_progress', 'due_date' => '2025-04-01'],
                    ['title' => 'Build first simple project', 'status' => 'in_progress', 'due_date' => '2025-05-01'],
                    ['title' => 'Create furniture piece', 'status' => 'in_progress', 'due_date' => '2025-07-01'],
                ],
            ],
            [
                'title' => 'Start Online Business',
                'description' => 'Launch profitable online service business.',
                'status' => 'active',
                'deadline' => '2025-09-01',
                'tasks' => [
                    ['title' => 'Research market opportunities', 'status' => 'in_progress', 'due_date' => '2025-03-01'],
                    ['title' => 'Develop business plan', 'status' => 'in_progress', 'due_date' => '2025-05-01'],
                    ['title' => 'Create service offerings', 'status' => 'in_progress', 'due_date' => '2025-07-01'],
                    ['title' => 'Launch and market business', 'status' => 'in_progress', 'due_date' => '2025-09-01'],
                ],
            ],
            [
                'title' => 'Learn Calligraphy Art',
                'description' => 'Master hand lettering and calligraphy styles.',
                'status' => 'active',
                'deadline' => '2025-05-01',
                'tasks' => [
                    ['title' => 'Purchase calligraphy supplies', 'status' => 'completed', 'due_date' => '2025-01-15'],
                    ['title' => 'Practice basic strokes daily', 'status' => 'in_progress', 'due_date' => '2025-03-01'],
                    ['title' => 'Learn different alphabet styles', 'status' => 'in_progress', 'due_date' => '2025-04-01'],
                    ['title' => 'Create artistic pieces', 'status' => 'in_progress', 'due_date' => '2025-05-01'],
                ],
            ],
            [
                'title' => 'Build Home Automation System',
                'description' => 'Create smart home setup with IoT devices.',
                'status' => 'active',
                'deadline' => '2025-10-01',
                'tasks' => [
                    ['title' => 'Plan automation requirements', 'status' => 'in_progress', 'due_date' => '2025-04-01'],
                    ['title' => 'Install smart devices', 'status' => 'in_progress', 'due_date' => '2025-06-01'],
                    ['title' => 'Program automation rules', 'status' => 'in_progress', 'due_date' => '2025-08-01'],
                    ['title' => 'Test and optimize system', 'status' => 'in_progress', 'due_date' => '2025-10-01'],
                ],
            ],
            [
                'title' => 'Learn Advanced Excel Skills',
                'description' => 'Master VBA programming and advanced formulas.',
                'status' => 'active',
                'deadline' => '2025-03-15',
                'tasks' => [
                    ['title' => 'Complete advanced Excel course', 'status' => 'in_progress', 'due_date' => '2025-01-15'],
                    ['title' => 'Learn VBA programming basics', 'status' => 'in_progress', 'due_date' => '2025-02-15'],
                    ['title' => 'Build automated spreadsheet', 'status' => 'in_progress', 'due_date' => '2025-03-01'],
                    ['title' => 'Create Excel dashboard', 'status' => 'in_progress', 'due_date' => '2025-03-15'],
                ],
            ],
            [
                'title' => 'Complete Triathlon Training',
                'description' => 'Train for and finish sprint triathlon race.',
                'status' => 'active',
                'deadline' => '2025-08-15',
                'tasks' => [
                    ['title' => 'Join swimming classes', 'status' => 'in_progress', 'due_date' => '2025-03-01'],
                    ['title' => 'Build cycling endurance', 'status' => 'in_progress', 'due_date' => '2025-05-01'],
                    ['title' => 'Practice transition training', 'status' => 'in_progress', 'due_date' => '2025-07-01'],
                    ['title' => 'Complete triathlon event', 'status' => 'in_progress', 'due_date' => '2025-08-15'],
                ],
            ],
            [
                'title' => 'Learn 3D Modeling',
                'description' => 'Create 3D models using Blender software.',
                'status' => 'active',
                'deadline' => '2025-06-30',
                'tasks' => [
                    ['title' => 'Install and learn Blender basics', 'status' => 'in_progress', 'due_date' => '2025-03-01'],
                    ['title' => 'Model simple objects', 'status' => 'in_progress', 'due_date' => '2025-04-15'],
                    ['title' => 'Learn texturing and materials', 'status' => 'in_progress', 'due_date' => '2025-05-30'],
                    ['title' => 'Create complex 3D scene', 'status' => 'in_progress', 'due_date' => '2025-06-30'],
                ],
            ],
            [
                'title' => 'Write Technical Blog Posts',
                'description' => 'Publish 24 technical articles on programming.',
                'status' => 'active',
                'deadline' => '2025-12-31',
                'tasks' => [
                    ['title' => 'Plan article topics', 'status' => 'completed', 'due_date' => '2025-01-15'],
                    ['title' => 'Write 12 articles (Q1-Q2)', 'status' => 'in_progress', 'due_date' => '2025-06-30'],
                    ['title' => 'Write 12 articles (Q3-Q4)', 'status' => 'in_progress', 'due_date' => '2025-12-15'],
                    ['title' => 'Promote articles on social media', 'status' => 'in_progress', 'due_date' => '2025-12-31'],
                ],
            ],
            [
                'title' => 'Master Cryptocurrency Trading',
                'description' => 'Learn technical analysis and trading strategies.',
                'status' => 'active',
                'deadline' => '2025-09-30',
                'tasks' => [
                    ['title' => 'Study blockchain technology', 'status' => 'in_progress', 'due_date' => '2025-04-01'],
                    ['title' => 'Learn technical analysis', 'status' => 'in_progress', 'due_date' => '2025-06-01'],
                    ['title' => 'Practice with demo trading', 'status' => 'in_progress', 'due_date' => '2025-08-01'],
                    ['title' => 'Start real trading portfolio', 'status' => 'in_progress', 'due_date' => '2025-09-30'],
                ],
            ],
            [
                'title' => 'Build Gaming PC',
                'description' => 'Assemble high-performance gaming computer from components.',
                'status' => 'active',
                'deadline' => '2025-05-15',
                'tasks' => [
                    ['title' => 'Research components and compatibility', 'status' => 'in_progress', 'due_date' => '2025-03-15'],
                    ['title' => 'Purchase all PC parts', 'status' => 'in_progress', 'due_date' => '2025-04-15'],
                    ['title' => 'Assemble computer system', 'status' => 'in_progress', 'due_date' => '2025-05-01'],
                    ['title' => 'Install OS and benchmark', 'status' => 'in_progress', 'due_date' => '2025-05-15'],
                ],
            ],
            [
                'title' => 'Learn Graphic Design',
                'description' => 'Master Adobe Creative Suite for design projects.',
                'status' => 'active',
                'deadline' => '2025-08-01',
                'tasks' => [
                    ['title' => 'Complete Photoshop fundamentals', 'status' => 'in_progress', 'due_date' => '2025-04-01'],
                    ['title' => 'Learn Illustrator for vector art', 'status' => 'in_progress', 'due_date' => '2025-05-15'],
                    ['title' => 'Master InDesign layouts', 'status' => 'in_progress', 'due_date' => '2025-07-01'],
                    ['title' => 'Create design portfolio', 'status' => 'in_progress', 'due_date' => '2025-08-01'],
                ],
            ],
            [
                'title' => 'Start Urban Beekeeping',
                'description' => 'Maintain bee hives and harvest honey.',
                'status' => 'active',
                'deadline' => '2025-10-31',
                'tasks' => [
                    ['title' => 'Complete beekeeping course', 'status' => 'in_progress', 'due_date' => '2025-04-01'],
                    ['title' => 'Set up bee hives', 'status' => 'in_progress', 'due_date' => '2025-05-15'],
                    ['title' => 'Monitor hive health monthly', 'status' => 'in_progress', 'due_date' => '2025-09-30'],
                    ['title' => 'Harvest first honey crop', 'status' => 'in_progress', 'due_date' => '2025-10-31'],
                ],
            ],
            [
                'title' => 'Learn Data Science',
                'description' => 'Master Python for data analysis and visualization.',
                'status' => 'active',
                'deadline' => '2025-11-30',
                'tasks' => [
                    ['title' => 'Complete pandas and numpy courses', 'status' => 'in_progress', 'due_date' => '2025-05-01'],
                    ['title' => 'Learn data visualization libraries', 'status' => 'in_progress', 'due_date' => '2025-07-01'],
                    ['title' => 'Build data analysis project', 'status' => 'in_progress', 'due_date' => '2025-09-30'],
                    ['title' => 'Create data science portfolio', 'status' => 'in_progress', 'due_date' => '2025-11-30'],
                ],
            ],
            [
                'title' => 'Master Home Brewing',
                'description' => 'Brew craft beer and perfect recipes.',
                'status' => 'active',
                'deadline' => '2025-12-15',
                'tasks' => [
                    ['title' => 'Purchase brewing equipment', 'status' => 'completed', 'due_date' => '2025-04-01'],
                    ['title' => 'Brew first batch of beer', 'status' => 'in_progress', 'due_date' => '2025-06-01'],
                    ['title' => 'Experiment with different styles', 'status' => 'in_progress', 'due_date' => '2025-10-01'],
                    ['title' => 'Perfect signature recipe', 'status' => 'in_progress', 'due_date' => '2025-12-15'],
                ],
            ],
            [
                'title' => 'Build Tiny House',
                'description' => 'Construct minimalist living space.',
                'status' => 'active',
                'deadline' => '2025-06-01',
                'tasks' => [
                    ['title' => 'Design house plans', 'status' => 'in_progress', 'due_date' => '2025-08-01'],
                    ['title' => 'Obtain permits and materials', 'status' => 'in_progress', 'due_date' => '2025-12-01'],
                    ['title' => 'Build frame and structure', 'status' => 'in_progress', 'due_date' => '2025-03-01'],
                    ['title' => 'Complete interior and utilities', 'status' => 'in_progress', 'due_date' => '2025-06-01'],
                ],
            ],
            [
                'title' => 'Learn Drone Photography',
                'description' => 'Master aerial photography and videography.',
                'status' => 'active',
                'deadline' => '2025-07-31',
                'tasks' => [
                    ['title' => 'Get drone pilot license', 'status' => 'in_progress', 'due_date' => '2025-04-15'],
                    ['title' => 'Purchase professional drone', 'status' => 'in_progress', 'due_date' => '2025-05-01'],
                    ['title' => 'Practice flight maneuvers', 'status' => 'in_progress', 'due_date' => '2025-06-30'],
                    ['title' => 'Create aerial photo portfolio', 'status' => 'in_progress', 'due_date' => '2025-07-31'],
                ],
            ],
            [
                'title' => 'Master Speed Reading',
                'description' => 'Increase reading speed to 1000+ WPM.',
                'status' => 'active',
                'deadline' => '2025-06-15',
                'tasks' => [
                    ['title' => 'Learn speed reading techniques', 'status' => 'in_progress', 'due_date' => '2025-04-01'],
                    ['title' => 'Practice daily for 30 minutes', 'status' => 'in_progress', 'due_date' => '2025-05-15'],
                    ['title' => 'Achieve 500 WPM milestone', 'status' => 'in_progress', 'due_date' => '2025-05-30'],
                    ['title' => 'Reach 1000+ WPM goal', 'status' => 'in_progress', 'due_date' => '2025-06-15'],
                ],
            ],
            [
                'title' => 'Build Smart Mirror',
                'description' => 'Create IoT mirror with display and sensors.',
                'status' => 'active',
                'deadline' => '2025-09-15',
                'tasks' => [
                    ['title' => 'Design mirror interface', 'status' => 'in_progress', 'due_date' => '2025-05-01'],
                    ['title' => 'Assemble hardware components', 'status' => 'in_progress', 'due_date' => '2025-07-01'],
                    ['title' => 'Program mirror software', 'status' => 'in_progress', 'due_date' => '2025-08-15'],
                    ['title' => 'Install and calibrate system', 'status' => 'in_progress', 'due_date' => '2025-09-15'],
                ],
            ],
            [
                'title' => 'Learn Rock Climbing',
                'description' => 'Progress from beginner to intermediate climber.',
                'status' => 'active',
                'deadline' => '2025-12-01',
                'tasks' => [
                    ['title' => 'Take climbing safety course', 'status' => 'in_progress', 'due_date' => '2025-05-01'],
                    ['title' => 'Practice at indoor gym', 'status' => 'in_progress', 'due_date' => '2025-08-01'],
                    ['title' => 'Learn outdoor climbing', 'status' => 'in_progress', 'due_date' => '2025-10-01'],
                    ['title' => 'Complete multi-pitch route', 'status' => 'in_progress', 'due_date' => '2025-12-01'],
                ],
            ],
            [
                'title' => 'Master Sourdough Baking',
                'description' => 'Perfect artisan bread making techniques.',
                'status' => 'active',
                'deadline' => '2025-08-30',
                'tasks' => [
                    ['title' => 'Create sourdough starter', 'status' => 'completed', 'due_date' => '2025-04-01'],
                    ['title' => 'Learn basic bread techniques', 'status' => 'in_progress', 'due_date' => '2025-06-01'],
                    ['title' => 'Experiment with different flours', 'status' => 'in_progress', 'due_date' => '2025-07-30'],
                    ['title' => 'Perfect signature loaf recipe', 'status' => 'in_progress', 'due_date' => '2025-08-30'],
                ],
            ],
            [
                'title' => 'Build React Native App',
                'description' => 'Develop cross-platform mobile application.',
                'status' => 'active',
                'deadline' => '2025-10-15',
                'tasks' => [
                    ['title' => 'Learn React Native framework', 'status' => 'in_progress', 'due_date' => '2025-06-01'],
                    ['title' => 'Design app user interface', 'status' => 'in_progress', 'due_date' => '2025-07-15'],
                    ['title' => 'Implement core features', 'status' => 'in_progress', 'due_date' => '2025-09-15'],
                    ['title' => 'Deploy to app stores', 'status' => 'in_progress', 'due_date' => '2025-10-15'],
                ],
            ],
            [
                'title' => 'Learn Blacksmithing',
                'description' => 'Master traditional metalworking techniques.',
                'status' => 'active',
                'deadline' => '2025-03-01',
                'tasks' => [
                    ['title' => 'Take beginner blacksmith course', 'status' => 'in_progress', 'due_date' => '2025-08-01'],
                    ['title' => 'Set up home forge', 'status' => 'in_progress', 'due_date' => '2025-11-01'],
                    ['title' => 'Create basic tools and items', 'status' => 'in_progress', 'due_date' => '2025-01-01'],
                    ['title' => 'Forge decorative artwork', 'status' => 'in_progress', 'due_date' => '2025-03-01'],
                ],
            ],
            [
                'title' => 'Master Digital Marketing',
                'description' => 'Learn SEO, social media, and content marketing.',
                'status' => 'active',
                'deadline' => '2025-11-15',
                'tasks' => [
                    ['title' => 'Complete Google Analytics course', 'status' => 'in_progress', 'due_date' => '2025-06-15'],
                    ['title' => 'Learn SEO best practices', 'status' => 'in_progress', 'due_date' => '2025-08-15'],
                    ['title' => 'Create content marketing strategy', 'status' => 'in_progress', 'due_date' => '2025-10-15'],
                    ['title' => 'Launch digital marketing campaign', 'status' => 'in_progress', 'due_date' => '2025-11-15'],
                ],
            ],
            [
                'title' => 'Build Arduino Robot',
                'description' => 'Create autonomous robot with sensors.',
                'status' => 'active',
                'deadline' => '2025-12-31',
                'tasks' => [
                    ['title' => 'Learn Arduino programming', 'status' => 'in_progress', 'due_date' => '2025-07-01'],
                    ['title' => 'Design robot chassis', 'status' => 'in_progress', 'due_date' => '2025-09-01'],
                    ['title' => 'Add sensors and motors', 'status' => 'in_progress', 'due_date' => '2025-11-01'],
                    ['title' => 'Program autonomous behavior', 'status' => 'in_progress', 'due_date' => '2025-12-31'],
                ],
            ],
            [
                'title' => 'Learn Pottery Making',
                'description' => 'Master wheel throwing and glazing techniques.',
                'status' => 'active',
                'deadline' => '2025-01-31',
                'tasks' => [
                    ['title' => 'Take pottery wheel classes', 'status' => 'in_progress', 'due_date' => '2025-08-01'],
                    ['title' => 'Learn hand building techniques', 'status' => 'in_progress', 'due_date' => '2025-10-01'],
                    ['title' => 'Practice glazing methods', 'status' => 'in_progress', 'due_date' => '2025-12-01'],
                    ['title' => 'Create pottery collection', 'status' => 'in_progress', 'due_date' => '2025-01-31'],
                ],
            ],
            [
                'title' => 'Master Stock Market Analysis',
                'description' => 'Learn fundamental and technical analysis.',
                'status' => 'active',
                'deadline' => '2025-02-28',
                'tasks' => [
                    ['title' => 'Study financial statements', 'status' => 'in_progress', 'due_date' => '2025-09-01'],
                    ['title' => 'Learn chart pattern analysis', 'status' => 'in_progress', 'due_date' => '2025-11-01'],
                    ['title' => 'Practice with paper trading', 'status' => 'in_progress', 'due_date' => '2025-01-01'],
                    ['title' => 'Build investment portfolio', 'status' => 'in_progress', 'due_date' => '2025-02-28'],
                ],
            ],
            [
                'title' => 'Build Hydroponics Garden',
                'description' => 'Grow vegetables without soil using nutrients.',
                'status' => 'active',
                'deadline' => '2025-11-30',
                'tasks' => [
                    ['title' => 'Research hydroponic systems', 'status' => 'completed', 'due_date' => '2025-07-01'],
                    ['title' => 'Build growing system', 'status' => 'in_progress', 'due_date' => '2025-08-15'],
                    ['title' => 'Plant first crops', 'status' => 'in_progress', 'due_date' => '2025-09-15'],
                    ['title' => 'Harvest mature vegetables', 'status' => 'in_progress', 'due_date' => '2025-11-30'],
                ],
            ],
            [
                'title' => 'Learn Solar Panel Installation',
                'description' => 'Install residential solar energy system.',
                'status' => 'active',
                'deadline' => '2025-04-15',
                'tasks' => [
                    ['title' => 'Get solar installer certification', 'status' => 'in_progress', 'due_date' => '2025-12-01'],
                    ['title' => 'Design home solar system', 'status' => 'in_progress', 'due_date' => '2025-01-15'],
                    ['title' => 'Install panels and inverters', 'status' => 'in_progress', 'due_date' => '2025-03-15'],
                    ['title' => 'Connect to electrical grid', 'status' => 'in_progress', 'due_date' => '2025-04-15'],
                ],
            ],
            [
                'title' => 'Master Mindfulness Meditation',
                'description' => 'Achieve advanced meditation and mindfulness.',
                'status' => 'active',
                'deadline' => '2025-03-31',
                'tasks' => [
                    ['title' => 'Complete 8-week MBSR course', 'status' => 'in_progress', 'due_date' => '2025-10-01'],
                    ['title' => 'Establish daily 30-min practice', 'status' => 'in_progress', 'due_date' => '2025-12-31'],
                    ['title' => 'Attend meditation retreat', 'status' => 'in_progress', 'due_date' => '2025-02-28'],
                    ['title' => 'Teach meditation to others', 'status' => 'in_progress', 'due_date' => '2025-03-31'],
                ],
            ],
            [
                'title' => 'Build Tesla Coil',
                'description' => 'Construct high-voltage electrical device.',
                'status' => 'active',
                'deadline' => '2025-05-01',
                'tasks' => [
                    ['title' => 'Study electrical engineering theory', 'status' => 'in_progress', 'due_date' => '2025-12-01'],
                    ['title' => 'Source high-voltage components', 'status' => 'in_progress', 'due_date' => '2025-02-01'],
                    ['title' => 'Assemble coil apparatus', 'status' => 'in_progress', 'due_date' => '2025-04-01'],
                    ['title' => 'Test and demonstrate safely', 'status' => 'in_progress', 'due_date' => '2025-05-01'],
                ],
            ],
            [
                'title' => 'Learn Mandarin Chinese',
                'description' => 'Achieve HSK Level 4 proficiency.',
                'status' => 'active',
                'deadline' => '2025-12-31',
                'tasks' => [
                    ['title' => 'Complete HSK 1 vocabulary', 'status' => 'in_progress', 'due_date' => '2025-12-01'],
                    ['title' => 'Study HSK 2-3 grammar', 'status' => 'in_progress', 'due_date' => '2025-06-01'],
                    ['title' => 'Practice speaking with natives', 'status' => 'in_progress', 'due_date' => '2025-10-01'],
                    ['title' => 'Take HSK 4 examination', 'status' => 'in_progress', 'due_date' => '2025-12-31'],
                ],
            ],
            [
                'title' => 'Build Retro Arcade Cabinet',
                'description' => 'Create classic arcade gaming machine.',
                'status' => 'active',
                'deadline' => '2025-02-14',
                'tasks' => [
                    ['title' => 'Design cabinet dimensions', 'status' => 'in_progress', 'due_date' => '2025-11-01'],
                    ['title' => 'Build wooden cabinet frame', 'status' => 'in_progress', 'due_date' => '2025-12-31'],
                    ['title' => 'Install screen and controls', 'status' => 'in_progress', 'due_date' => '2025-01-31'],
                    ['title' => 'Load games and test system', 'status' => 'in_progress', 'due_date' => '2025-02-14'],
                ],
            ],
            [
                'title' => 'Master Time Lapse Photography',
                'description' => 'Create stunning time-lapse video sequences.',
                'status' => 'active',
                'deadline' => '2025-01-15',
                'tasks' => [
                    ['title' => 'Learn intervalometer techniques', 'status' => 'in_progress', 'due_date' => '2025-10-15'],
                    ['title' => 'Practice with various subjects', 'status' => 'in_progress', 'due_date' => '2025-11-30'],
                    ['title' => 'Master post-processing workflow', 'status' => 'in_progress', 'due_date' => '2025-12-31'],
                    ['title' => 'Create time-lapse film', 'status' => 'in_progress', 'due_date' => '2025-01-15'],
                ],
            ],
            [
                'title' => 'Learn Glass Blowing',
                'description' => 'Master traditional glass shaping techniques.',
                'status' => 'active',
                'deadline' => '2025-06-30',
                'tasks' => [
                    ['title' => 'Take glass blowing workshop', 'status' => 'in_progress', 'due_date' => '2025-01-01'],
                    ['title' => 'Learn furnace and tool safety', 'status' => 'in_progress', 'due_date' => '2025-02-15'],
                    ['title' => 'Practice basic forms', 'status' => 'in_progress', 'due_date' => '2025-04-30'],
                    ['title' => 'Create artistic glass pieces', 'status' => 'in_progress', 'due_date' => '2025-06-30'],
                ],
            ],
            [
                'title' => 'Build Wind Turbine',
                'description' => 'Construct small-scale wind power generator.',
                'status' => 'active',
                'deadline' => '2025-08-01',
                'tasks' => [
                    ['title' => 'Design turbine specifications', 'status' => 'in_progress', 'due_date' => '2025-03-01'],
                    ['title' => 'Build rotor and generator', 'status' => 'in_progress', 'due_date' => '2025-05-01'],
                    ['title' => 'Construct tower and mount', 'status' => 'in_progress', 'due_date' => '2025-07-01'],
                    ['title' => 'Test power generation', 'status' => 'in_progress', 'due_date' => '2025-08-01'],
                ],
            ],
            [
                'title' => 'Master Fermentation Arts',
                'description' => 'Learn to ferment various foods and beverages.',
                'status' => 'active',
                'deadline' => '2025-04-30',
                'tasks' => [
                    ['title' => 'Start kimchi and sauerkraut', 'status' => 'in_progress', 'due_date' => '2025-01-15'],
                    ['title' => 'Learn kombucha brewing', 'status' => 'in_progress', 'due_date' => '2025-02-28'],
                    ['title' => 'Try cheese making', 'status' => 'in_progress', 'due_date' => '2025-03-31'],
                    ['title' => 'Experiment with tempeh', 'status' => 'in_progress', 'due_date' => '2025-04-30'],
                ],
            ],
            [
                'title' => 'Learn Wilderness Survival',
                'description' => 'Master outdoor survival and bushcraft skills.',
                'status' => 'active',
                'deadline' => '2025-09-15',
                'tasks' => [
                    ['title' => 'Take wilderness first aid course', 'status' => 'in_progress', 'due_date' => '2025-03-15'],
                    ['title' => 'Learn fire and shelter building', 'status' => 'in_progress', 'due_date' => '2025-05-31'],
                    ['title' => 'Practice water purification', 'status' => 'in_progress', 'due_date' => '2025-07-31'],
                    ['title' => 'Complete solo camping trip', 'status' => 'in_progress', 'due_date' => '2025-09-15'],
                ],
            ],
            [
                'title' => 'Build Electric Skateboard',
                'description' => 'Create motorized personal transportation.',
                'status' => 'active',
                'deadline' => '2025-03-15',
                'tasks' => [
                    ['title' => 'Design motor and battery system', 'status' => 'in_progress', 'due_date' => '2025-01-01'],
                    ['title' => 'Modify skateboard deck', 'status' => 'in_progress', 'due_date' => '2025-01-31'],
                    ['title' => 'Install electronics and wiring', 'status' => 'in_progress', 'due_date' => '2025-02-28'],
                    ['title' => 'Test and tune performance', 'status' => 'in_progress', 'due_date' => '2025-03-15'],
                ],
            ],
            [
                'title' => 'Master Cold Process Soap Making',
                'description' => 'Create natural handmade soaps and cosmetics.',
                'status' => 'active',
                'deadline' => '2025-05-31',
                'tasks' => [
                    ['title' => 'Learn soap chemistry basics', 'status' => 'in_progress', 'due_date' => '2025-02-01'],
                    ['title' => 'Make first basic soap batch', 'status' => 'in_progress', 'due_date' => '2025-03-15'],
                    ['title' => 'Experiment with natural additives', 'status' => 'in_progress', 'due_date' => '2025-04-30'],
                    ['title' => 'Create signature soap recipes', 'status' => 'in_progress', 'due_date' => '2025-05-31'],
                ],
            ],
            [
                'title' => 'Learn Astrophotography',
                'description' => 'Capture detailed images of celestial objects.',
                'status' => 'active',
                'deadline' => '2025-10-01',
                'tasks' => [
                    ['title' => 'Purchase telescope and mount', 'status' => 'in_progress', 'due_date' => '2025-04-01'],
                    ['title' => 'Learn star tracking techniques', 'status' => 'in_progress', 'due_date' => '2025-06-01'],
                    ['title' => 'Master image stacking software', 'status' => 'in_progress', 'due_date' => '2025-08-01'],
                    ['title' => 'Photograph deep sky objects', 'status' => 'in_progress', 'due_date' => '2025-10-01'],
                ],
            ],
            [
                'title' => 'Build Quadcopter Drone',
                'description' => 'Assemble custom racing drone from components.',
                'status' => 'active',
                'deadline' => '2025-07-15',
                'tasks' => [
                    ['title' => 'Choose frame and components', 'status' => 'in_progress', 'due_date' => '2025-04-15'],
                    ['title' => 'Solder electronics and ESCs', 'status' => 'in_progress', 'due_date' => '2025-05-31'],
                    ['title' => 'Configure flight controller', 'status' => 'in_progress', 'due_date' => '2025-06-30'],
                    ['title' => 'Test flight and tune PID', 'status' => 'in_progress', 'due_date' => '2025-07-15'],
                ],
            ],
            [
                'title' => 'Master Mushroom Cultivation',
                'description' => 'Grow gourmet mushrooms at home.',
                'status' => 'active',
                'deadline' => '2025-06-15',
                'tasks' => [
                    ['title' => 'Set up sterile growing environment', 'status' => 'in_progress', 'due_date' => '2025-03-01'],
                    ['title' => 'Learn spore inoculation', 'status' => 'in_progress', 'due_date' => '2025-04-01'],
                    ['title' => 'Grow oyster mushrooms', 'status' => 'in_progress', 'due_date' => '2025-05-01'],
                    ['title' => 'Experiment with shiitake variety', 'status' => 'in_progress', 'due_date' => '2025-06-15'],
                ],
            ],
            [
                'title' => 'Learn Leather Working',
                'description' => 'Craft wallets, belts, and leather goods.',
                'status' => 'active',
                'deadline' => '2025-08-31',
                'tasks' => [
                    ['title' => 'Purchase leather tools', 'status' => 'in_progress', 'due_date' => '2025-04-01'],
                    ['title' => 'Learn cutting and stitching', 'status' => 'in_progress', 'due_date' => '2025-05-31'],
                    ['title' => 'Make first wallet project', 'status' => 'in_progress', 'due_date' => '2025-07-15'],
                    ['title' => 'Create complex leather goods', 'status' => 'in_progress', 'due_date' => '2025-08-31'],
                ],
            ],
            [
                'title' => 'Build Greenhouse Structure',
                'description' => 'Construct year-round growing facility.',
                'status' => 'active',
                'deadline' => '2025-11-01',
                'tasks' => [
                    ['title' => 'Design greenhouse layout', 'status' => 'in_progress', 'due_date' => '2025-06-01'],
                    ['title' => 'Pour foundation and frame', 'status' => 'in_progress', 'due_date' => '2025-08-01'],
                    ['title' => 'Install glazing and ventilation', 'status' => 'in_progress', 'due_date' => '2025-10-01'],
                    ['title' => 'Add heating and irrigation', 'status' => 'in_progress', 'due_date' => '2025-11-01'],
                ],
            ],
        ];

        foreach ($goals as $goalData) {
            $goal = Goal::create([
                'title' => $goalData['title'],
                'description' => $goalData['description'],
                'status' => $goalData['status'],
                'deadline' => $goalData['deadline'],
            ]);

            foreach ($goalData['tasks'] as $task) {
                $goal->tasks()->create($task);
            }
        }
    }
}
