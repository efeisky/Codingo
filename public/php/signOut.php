<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    echo "selam";
    Session_destroy();
    header("Location: homepage.html");
}

?>