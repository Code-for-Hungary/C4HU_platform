<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_skills', function (Blueprint $table) {
            $table->biginteger('profile_id')->comment('pointer a profiles táblára');
            $table->biginteger('skill_id')->comment('pointer a skills táblára');
            $table->string('level')->comment('szint: interested|student|junior|senior|mentor')
            $table->timestamps();
            $table->index('profile_id');
            $table->index('skill_id');
        });
        DB::statement("ALTER TABLE `profile_skills` comment 'profile-skills 1:n kapcsoló tábla'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_skills');
    }
}
