<?php

class Manager
{
	protected function dbConnect()
	{
		$db = new PDO('mysql:host=;dbname=projet4;charset=utf8', 'root', '');
		return $db;
	}
}