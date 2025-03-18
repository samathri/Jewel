<?php

session_start();

session_destroy();

header ("Location: /Serandi/Serandi 2/login.php");
exit;