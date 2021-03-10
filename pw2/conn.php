<?php
function get_koneksi(){
    try{
        $db = "mysql:host=localhost;dbname=pw2_20202";
		//$db = "mysql:host=localhost;dbname=pw2_pr_20202";
$db_handler = new PDO($db,"root", "");
$db_handler -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
echo $e ->getMessage();
die();
}
return $db_handler;
}

function close_koneksi(PDO $link){
$link = NULL;
}
?>
