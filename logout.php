<?php
session_start();
session_destroy();
header('Location: http://localhost/Project_be1_php/home.php');
