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
            $table->string('name')->nullable()->comment('projekt rövid megnevezése');
            $table->text('description')->nullable()->comment('projekt leírása');
            $table->string('organisation')->nullable()->comment('projekt gazda szervezet');
            $table->string('website')->nullable()->comment('szervezet web site-ja');
            $table->string('avatar')->nullable()->comment('projekt vagy szervezet avatar url');
            $table->date('deadline')->nullable()->comment('határidő');
            $table->string('status')->nullable()->comment('plan|task|inprogress|suspended|closed|canceled');
            $table->biginteger('user_id')->unsigned()->comment('project gazda user');
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
