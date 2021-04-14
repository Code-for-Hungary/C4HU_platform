<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContributorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributors', function (Blueprint $table) {
            $table->biginteger('project_id')->unsigned()->comment('projects táblába mutató pointer');
            $table->biginteger('user_id')->unsigned()->comment('users táblába mutató pointer');
            $table->text('description')->nullable()->comment('projekt leírása');
            $table->string('status')->nullable()->comment('applicant|active|inactive|exited|owner');
            $table->string('evaluation')->nullable()->comment('szöveges értékelés');
            $table->integer('grade')->nullable()->comment('érdemjegy 1-5');
            $table->date('start')->nullable()->comment('közremüködés kezdete');
            $table->date('end')->nullable()->comment('közremüködés vége');
            $table->timestamps();
            $table->index('project_id');
            $table->index('user_id');
        });
		\DB::statement("ALTER TABLE `contributors` comment 'projektben közremüködő önkéntesek + a projekt gazda'");
                
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contributors');
    }
}
