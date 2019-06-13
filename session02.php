<?php
session_start();

echo $_SESSION["name"];
echo"<br>";
echo $_SESSION["age"];
echo session_id();

?>