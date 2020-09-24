<?php

    session_start();

    $SESSION = array();

    session_destroy();

    header("location: ../iniciarsesion.php");

    exit;
?>