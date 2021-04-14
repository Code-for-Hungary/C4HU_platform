<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skills', function (Blueprint $table) {
			$table->id();
            $table->string('name')->comment('tulajdonsás megnevezése');
            $table->biginteger('parent')->comment('fa szerkezet, pointer a felsőbb szintre');
            $table->integer('order')->comment('rendezés (parenten belül)');
            $table->timestamps();
        });
		\DB::statement("ALTER TABLE `skills` comment 'képességeek, fa szerkezet'");
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skills');
    }
}
