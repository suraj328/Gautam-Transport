<?php

    session_start();
    session_unset();
    session_destroy();
    header("location:Gautam-Transport-login.php");

?>