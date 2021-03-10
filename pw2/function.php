<?php

function makemenu()
{
    $mnu = array("Index" => "home", "CategoryDaoImpl" => "cat", "Book" => "buku");
    if($_SESSION['approved_user'] == TRUE) {
        $mnu = array("Index" => "home", "CategoryDaoImpl" => "cat", "Book" => "buku", "Logout" => 'logout');
    }
    foreach ($mnu as $value => $key)
    {
        echo '<a href="index.php?menu='.$key.'">'.$value.'</a> | ';
    }
}



?>

