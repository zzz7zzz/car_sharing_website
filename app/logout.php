<?php

/* Clean Sessions */
session_start();
session_unset();
session_destroy();

/* Clean Cookies */
include "function.php";
cleanCookie();

header('Location: ../index.php');

?>