<?php
$server = "localhost";
$user = "root";
$passworddb = "";
$db = "marathon";
$athleteParPage = 25;
$con = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $passworddb);
