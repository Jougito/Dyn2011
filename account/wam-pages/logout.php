<?php

// F�jl ellen�rz�se
if(!isset($mysql_connect)){ exit(); }

// S�tik t�rl�se
setcookie("wam_id", "logout", time()-18000);
setcookie("wam_worktime", "logout", time()-18000);

// �tir�ny�t�s
header_location("index");

?>