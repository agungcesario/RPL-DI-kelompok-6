<?php

session_start();
session_destroy();
//mengembalikan ke halaman home
header("Location: home.php");