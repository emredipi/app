<?php
include "Request.php";

$request = new Request([
	'fullname' => [
		"rules" => "required"
	],
	'email' => [
		"rules" => "required"
	],
	'house_id' => [
		"rules" => "required"
	],
	'password' => [
		"rules" => "required",
		'use_old_input' => false
	]
], "POST");
header('Location: /register.php');
