<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Avatars table
        Schema::create('avatars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('svg_markup'); // Store avatar SVG vector data directly
            $table->timestamps();
        });

        // 2. Parents table
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('phone')->nullable();
            $table->string('subscription_status')->default('free'); // free, premium
            $table->string('parent_pin', 4)->default('1234');
            $table->timestamps();
        });

        // 3. Children table
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('parents')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // Link to login user if child has direct login credentials
            $table->string('name');
            $table->foreignId('avatar_id')->nullable()->constrained('avatars')->onDelete('set null');
            $table->integer('streak')->default(0);
            $table->integer('xp')->default(0);
            $table->integer('stars')->default(0);
            $table->integer('coins')->default(0);
            $table->integer('level')->default(1);
            $table->integer('age')->default(5);
            $table->timestamp('last_active_at')->nullable();
            $table->string('current_outfit')->default('default'); // default, crown, glasses, superhero
            $table->timestamps();
        });

        // 4. Courses table
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('category'); // ABC, Hindi, Numbers, Shapes, Colors, Animals, Science, Stories, Rhymes, Drawing, Math, GK
            $table->string('icon'); // Lucide icon name or emoji representation
            $table->string('bg_color'); // Hex code or custom css variable
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 5. Lessons table
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->string('title');
            $table->string('content_type')->default('text'); // text, story, rhyme, game
            $table->longText('body_content')->nullable();
            $table->string('image_url')->nullable();
            $table->string('audio_url')->nullable();
            $table->integer('sorting_order')->default(0);
            $table->timestamps();
        });

        // 6. Quizzes table
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('cascade');
            $table->foreignId('lesson_id')->nullable()->constrained('lessons')->onDelete('cascade');
            $table->string('title');
            $table->integer('xp_reward')->default(20);
            $table->timestamps();
        });

        // 7. Questions table
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade');
            $table->string('question_text');
            $table->string('question_image')->nullable(); // Image asset path if visual quiz
            $table->string('option_a');
            $table->string('option_b');
            $table->string('option_c')->nullable();
            $table->string('option_d')->nullable();
            $table->char('correct_option', 1)->default('A'); // A, B, C, D
            $table->string('hint')->nullable();
            $table->timestamps();
        });

        // 8. Rewards table
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('type')->default('outfit'); // outfit, accessory, theme
            $table->string('identifier'); // default, crown, glasses, superhero
            $table->integer('coins_cost')->default(100);
            $table->string('image_path')->nullable();
            $table->timestamps();
        });

        // 9. Badges table
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('icon_path');
            $table->string('requirement_type'); // stars, xp, courses_completed, games_played
            $table->integer('requirement_value')->default(10);
            $table->timestamps();
        });

        // 10. Certificates table
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->date('issue_date');
            $table->string('certificate_code')->unique();
            $table->timestamps();
        });

        // 11. Progress table
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
            $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('cascade');
            $table->foreignId('lesson_id')->nullable()->constrained('lessons')->onDelete('cascade');
            $table->foreignId('quiz_id')->nullable()->constrained('quizzes')->onDelete('cascade');
            $table->boolean('completed')->default(false);
            $table->integer('score')->nullable(); // score in quiz, if any
            $table->timestamps();
        });

        // 12. Activities table
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
            $table->string('activity_type'); // game, quiz, lesson
            $table->string('activity_name'); // e.g. Count Apples Game, Alphabet Quiz
            $table->string('details')->nullable();
            $table->integer('xp_earned')->default(0);
            $table->integer('stars_earned')->default(0);
            $table->integer('coins_earned')->default(0);
            $table->timestamps();
        });

        // 13. Screen Times table
        Schema::create('screen_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
            $table->date('date');
            $table->integer('duration_seconds')->default(0);
            $table->timestamps();
        });

        // 14. Notifications table
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        // 15. Pivot: child_badge
        Schema::create('child_badge', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
            $table->foreignId('badge_id')->constrained('badges')->onDelete('cascade');
            $table->timestamp('unlocked_at')->useCurrent();
        });

        // 16. Pivot: child_reward
        Schema::create('child_reward', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
            $table->foreignId('reward_id')->constrained('rewards')->onDelete('cascade');
            $table->boolean('is_active')->default(false); // Unlocked reward is currently equipped
            $table->timestamp('unlocked_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_reward');
        Schema::dropIfExists('child_badge');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('screen_times');
        Schema::dropIfExists('activities');
        Schema::dropIfExists('progress');
        Schema::dropIfExists('certificates');
        Schema::dropIfExists('badges');
        Schema::dropIfExists('rewards');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('quizzes');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('children');
        Schema::dropIfExists('parents');
        Schema::dropIfExists('avatars');
    }
};
