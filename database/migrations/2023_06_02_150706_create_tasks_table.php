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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('priority')->default('1');
            $table->text('description')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('final_date')->nullable();
            $table->timestamp('started_at')->nullable()->default(null);
            $table->timestamp('finished_at')->nullable()->default(null);
            $table->unsignedInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->unsignedInteger('status_id')->default(1);
            $table->foreign('status_id')->references('id')->on('status');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
