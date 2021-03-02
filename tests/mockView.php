<?php
namespace App\Http\Controllers;
global $viewParams; 
function view($name, $params = []) {
    global $viewParams;
    $viewParams = $params;
	return $name;
}
function redirect($s) {
	return $s;
}
?>