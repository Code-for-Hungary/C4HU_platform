<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	\App\Models\Skills::truncate();
        \App\Models\Skills::create(["id" => 1, "name" => "Szervező", "parent" => 0]);
        \App\Models\Skills::create(["id" => 2, "name" => "Kommunikátor", "parent" => 0]);
        	\App\Models\Skills::create(["id" => 21, "name" => "Belső kommunikáció", "parent" => 2]);
        	\App\Models\Skills::create(["id" => 22, "name" => "Külső kommunikáció", "parent" => 2]);
        	\App\Models\Skills::create(["id" => 23, "name" => "Szóvivő", "parent" => 2]);
        	\App\Models\Skills::create(["id" => 24, "name" => "Fordítás", "parent" => 2]);
	        	\App\Models\Skills::create(["id" => 241, "name" => "Angol", "parent" => 24]);
	        	\App\Models\Skills::create(["id" => 242, "name" => "Német", "parent" => 24]);
	        	\App\Models\Skills::create(["id" => 243, "name" => "Francia", "parent" => 24]);
        \App\Models\Skills::create(["id" => 3, "name" => "Jogász", "parent" => 0]);
        \App\Models\Skills::create(["id" => 4, "name" => "Adminisztrátor", "parent" => 0]);
        \App\Models\Skills::create(["id" => 5, "name" => "Informatikus", "parent" => 0]);
	        \App\Models\Skills::create(["id" => 51, "name" => "informatikai szervező", "parent" => 5]);
	        \App\Models\Skills::create(["id" => 52, "name" => "CMS rendszergazda", "parent" => 5]);
		        \App\Models\Skills::create(["id" => 521, "name" => "Joomla", "parent" => 52]);
		        \App\Models\Skills::create(["id" => 522, "name" => "Drupal", "parent" => 52]);
		        \App\Models\Skills::create(["id" => 523, "name" => "Wordpress", "parent" => 52]);
		        \App\Models\Skills::create(["id" => 524, "name" => "egyéb CMS", "parent" => 52]);
	        \App\Models\Skills::create(["id" => 53, "name" => "szerver rendszergazda", "parent" => 5]);
	        \App\Models\Skills::create(["id" => 54, "name" => "backend programozó", "parent" => 5]);
		        \App\Models\Skills::create(["id" => 541, "name" => "PHP", "parent" => 54]);
		        \App\Models\Skills::create(["id" => 542, "name" => "Laravel", "parent" => 54]);
		        \App\Models\Skills::create(["id" => 543, "name" => "Java", "parent" => 54]);
		        \App\Models\Skills::create(["id" => 544, "name" => "Python", "parent" => 54]);
		        \App\Models\Skills::create(["id" => 545, "name" => "Rubby", "parent" => 54]);
		        \App\Models\Skills::create(["id" => 546, "name" => "GO", "parent" => 54]);
		        \App\Models\Skills::create(["id" => 547, "name" => "nodejs", "parent" => 54]);
		        \App\Models\Skills::create(["id" => 548, "name" => "egyéb backend", "parent" => 54]);
	        \App\Models\Skills::create(["id" => 55, "name" => "frontend programozó", "parent" => 5]);
		        \App\Models\Skills::create(["id" => 551, "name" => "Javascript", "parent" => 55]);
		        \App\Models\Skills::create(["id" => 552, "name" => "Vue", "parent" => 55]);
		        \App\Models\Skills::create(["id" => 553, "name" => "React", "parent" => 55]);
		        \App\Models\Skills::create(["id" => 554, "name" => "Jquery", "parent" => 55]);
		        \App\Models\Skills::create(["id" => 555, "name" => "Egyéb frontend", "parent" => 55]);
	        \App\Models\Skills::create(["id" => 56, "name" => "dizájner", "parent" => 5]);
	        \App\Models\Skills::create(["id" => 57, "name" => "UI/UX", "parent" => 5]);
	        \App\Models\Skills::create(["id" => 58, "name" => "mobil app fejlesztő", "parent" => 5]);
	        \App\Models\Skills::create(["id" => 59, "name" => "sql", "parent" => 5]);
	        \App\Models\Skills::create(["id" => 60, "name" => "egyéb informatika", "parent" => 5]);
        \App\Models\Skills::create(["id" => 6, "name" => "Közgazdász", "parent" => 0]);
        \App\Models\Skills::create(["id" => 7, "name" => "Egyéb", "parent" => 0]);
        
    }
}
