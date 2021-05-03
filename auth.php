<?php

require "classes.php";

$mysql = new MySQLData();
$mysql->setServerName("localhost");
$mysql->setUsername("root");
$mysql->setPassword("");
$mysql->setDBName("carent");
$mysql->connect();

$conn = $mysql->getConn();

