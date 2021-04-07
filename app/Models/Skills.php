<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory;
    
	protected function getNode($node) {
		$result = new \stdClass();
		$result->id = $node->id;
		$result->text = $node->name;
		$table = \DB::table('skills');    
		$childs = $table->orderBy('order')->where('parent','=',$node->id)->get();
		if (count($childs) > 0) {
			$result->children = [];
			foreach ($childs as $child) {
				$result->children[] = $this->getNode($child);			
			}
		}
		return $result;
	}    
    
    public function getJsonStr() {
    	$result = [];
		$table = \DB::table('skills');    
		$roots = $table->orderBy('order')->where('parent','=',0)->get();
		if (count($roots) > 0) {
			foreach ($roots as $root) {
				$result[] = $this->getNode($root);		
			}
		}
		return JSON_encode($result,JSON_PRETTY_PRINT);
    }
}
