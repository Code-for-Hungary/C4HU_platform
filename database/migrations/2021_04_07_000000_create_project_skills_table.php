<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_skills', function (Blueprint $table) {
            $table->biginteger('project_id')->comment('pointer a projects táblára');
            $table->biginteger('skill_id')->comment('pointer a skills táblára');
            $table->timestamps();
            $table->index('project_id');
            $table->index('skill_id');
        });
        DB::statement("ALTER TABLE `project_skills` comment 'project - skills 1:n kapcsoló tábla'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_skills');
    }
}
