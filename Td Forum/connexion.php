<?php
$server="localhost";
$user="root";
$passworddb="";
$db="forum_db";
$con = new PDO("mysql:host=$server;dbname=$db;charset=utf8",$user,$passworddb);
