<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); }

// MySQL kapcsolat bezárása
mysqli_close($mysql_connect);

ob_end_flush();

?>