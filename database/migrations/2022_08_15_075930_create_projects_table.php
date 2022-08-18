<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->string('category');
            $table->string('status');
            $table->json('time_to_do');
            $table->json('skill');
            $table->text("information")->nullable();
            $table->string('level')->nullable();
            $table->string('version')->nullable();
            $table->string('budget')->nullable();
            $table->boolean('is_privacy')->default(false);
            $table->json('attachments');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
