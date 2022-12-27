<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $_SESSION["edu-level"] = $_POST["education-level"];
    $_SESSION["py-level"] = $_POST["pyLevel"];
}

?>