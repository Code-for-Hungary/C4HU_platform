<?php
namespace App\Http\Controllers;
function view($name, $params = []) {
	return $name.'/'.implode(',',$params);
}
function redirect($s) {
	return $s;
}
?>