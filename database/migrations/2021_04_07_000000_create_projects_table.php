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
            $table->string('name')->comment('projekt rövid megnevezése');
            $table->text('description')->comment('projekt leírása');
            $table->string('organisation')->comment('projekt gazda szervezet');
            $table->string('website')->comment('szervezet web site-ja');
            $table->string('avatar')->comment('projekt vagy szervezet avatar url');
            $table->date('deadline')->nullable()->comment('határidő');
            $table->string('status')->comment('plan|task|inprogress|suspended|closed|canceled');
            $table->biginteger('user_id')->comment('project gazda user');
            $table->timestamps();
        });
		\DB::statement("ALTER TABLE `projects` comment 'projektek'");
                
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
