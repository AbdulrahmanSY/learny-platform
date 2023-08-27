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
//
        Schema::table('teachers', function (Blueprint $table) {
            $table->foreignId('teacher_status_id')->references('id')->on('teacher_statuses')->onDelete('no action');
            $table->foreignId('user_id')->unique()->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('teacher_infos',function (Blueprint $table){
            $table->foreignId('teacher_id')->unique()->references('id')->on('teachers')->onDelete('cascade');
        });

        Schema::table('teacher_languages', function (Blueprint $table) {
            $table->foreignId('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreignId('language_id')->references('id')->on('languages')->onDelete('no action');
            $table->foreignId('language_level_id')->references('id')->on('levels')->onDelete('no action');
        });

        Schema::table('card_ids', function (Blueprint $table) {
            $table->foreignId('teacher_id')->unique()->references('id')->on('teachers')->onDelete('cascade');
        });

        Schema::table('doners', function (Blueprint $table) {
            $table->foreignId('doner_type_id')->references('id')->on('doner_types')->onDelete('cascade');
            $table->foreignId('country_id')->references('id')->on('countries')->onDelete('cascade');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->foreignId('language_id')->references('id')->on('languages')->onDelete('cascade');
        });

        Schema::table('users',function (Blueprint $table){
            $table->foreignId('nationality_id')->references('id')->on('nationalities');
        });

        Schema::table('certificates',function (Blueprint $table){
            $table->foreignId('doner_id')->references('id')->on('doners');
            $table->foreignId('teacher_language_id')->references('id')->on('teacher_languages')->onDelete('cascade');
            $table->foreignId('certificate_type_id')->references('id')->on('certificate_types')->onDelete('cascade');
        });

        Schema::table('working_days',function (Blueprint $table){
            $table->foreignId('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreignId('day_id')->references('id')->on('days');
        });

        Schema::table('working_times',function (Blueprint $table){
            $table->foreignId('working_day_id')->references('id')->on('working_days')->onDelete('cascade');
        });

        Schema::table('appointments',function(Blueprint $table){
            $table->foreignId("status_id")->references('id')->on("appointment_statuses");
            $table->foreignId("user_id")->references('id')->on("users");
            $table->foreignId("teacher_id")->references('id')->on("teachers")->onDelete('cascade');
            $table->foreignId('language_id')->references('language_id')->on('teacher_languages')->onDelete('cascade');
            $table->foreignId("level_id")->references('id')->on("levels");
            $table->foreignId("goal_id")->references('id')->on("goals");
            $table->foreignId("period_id")->references('id')->on("periods");
        });

        Schema::table('files',function(Blueprint $table){
            $table->foreignId("appointment_id")->references('id')->on("appointments")->onDelete('cascade');
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->foreignId("category_id")->references('id')->on("categories");
            $table->foreignId("teacher_id")->references('id')->on("teachers");
            $table->foreignId('content_levels_id')->references('id')->on('content_levels')->onDelete('cascade');

        });

        Schema::table('answers', function (Blueprint $table) {
            $table->foreignId("question_id")->references('id')->on("questions")->onDelete('cascade');;
        });

        Schema::table('user_questions', function (Blueprint $table) {
            $table->foreignId("question_id")->references('id')->on("questions");
            $table->foreignId("answer_id")->references('id')->on("answers");
            $table->foreignId("user_id")->references('id')->on("users");
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId("language_id")->references('id')->on("languages");
            $table->foreignId("teacher_id")->references('id')->on("teachers");
            $table->foreignId('content_levels_id')->references('id')->on('content_levels')->onDelete('restrict');
            $table->foreignId('type_id')->references('id')->on('type_posts')->onDelete('restrict');

        });

        Schema::table('user_posts', function (Blueprint $table) {
            $table->foreignId("user_id")->references('id')->on("users");
            $table->foreignId("post_id")->references('id')->on("posts");
        });

        Schema::table('files_posts', function (Blueprint $table) {
            $table->foreignId("post_id")->references('id')->on("posts")->onDelete('cascade');
        });

        Schema::table('paragraphs', function (Blueprint $table) {
            $table->foreignId("teacher_id")->references('id')->on("teachers");
            $table->foreignId("paragraph_category_id")->references('id')->on("paragraph_categories");
            $table->foreignId("language_id")->references('id')->on("languages");
            $table->foreignId('content_levels_id')->references('id')->on('content_levels')->onDelete('cascade');

        });

        Schema::table('user_paragraphs', function (Blueprint $table) {
            $table->foreignId("user_id")->references('id')->on("users");
            $table->foreignId("paragraph_id")->references('id')->on("paragraphs");
        });

        Schema::table('sessions',function (Blueprint $table){
            $table->foreignId('appointment_id')->unique()->references('id')->on('appointments')->onDelete('cascade');
        });
        Schema::create('follow', function (Blueprint $table) {
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });

        Schema::table('teacher_wallets', function (Blueprint $table) {

            $table->foreignId('teacher_id')->references('id')->on('teachers')->onDelete('cascade');

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
