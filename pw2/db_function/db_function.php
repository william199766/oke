<?php

function createllySqlConnection() {
    $link = mysqli_connect('localhost', 'root', '', 'pw2_20202', '3306') or die(mysqli_connect_error());
    mysqli_autocommit($link, FALSE);
    return $link;
}

///GENRE
function getAllgenre() {
    $link = createllySqlConnection();
    $query = "select * from genre";
    $result = mysqli_query($link, $query)or die(mysqli_error($link));
    mysqli_close($link);
    return $result;
}

function addGenre($name) {
    $link = createllySqlConnection();
    $query = 'INSERT INTO genre (name) VALUES(?)';
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt) or die(mysqli_errno($link));
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}

function deleteGenre($genreid) {
    $link = createllySqlConnection();
    $query = 'DELETE FROM genre WHERE id = ?';
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $genreid);
        mysqli_stmt_execute($stmt) or die(mysqli_errno($link));
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}

function login($user, $password) {
    $link = createllySqlConnection();
    $query = 'SELECT Name , Username FROM user WHERE Username = ? AND Password = ? LIMIT 1';
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "ss", $user, $password);
        mysqli_stmt_execute($stmt) or die(mysqli_errno($link));
        mysqli_stmt_bind_result($stmt, $returnName, $returnUsername);
        mysqli_stmt_fetch($stmt);
        $querResult = array('Name' => $returnName, 'Username' => $returnUsername);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
    return $querResult;
}

function UpdateGenre($name, $id) {
    $link = createllySqlConnection();
    $query = 'UPDATE genre SET name = ? WHERE id = ?';
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "si", $name, $id);
        mysqli_stmt_execute($stmt) or die(mysqli_errno($link));
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
    header('location:index.php?navito=Genre');
}

function idGenre($idYangDicari) {
    $link = createllySqlConnection();
    $query = 'SELECT * FROM genre WHERE id = ?';
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $idYangDicari);
        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
        mysqli_stmt_bind_result($stmt, $returnId, $returnName);
        mysqli_stmt_fetch($stmt);
        $qResult = array('id' => $returnId, 'name' => $returnName);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
    return $qResult;
}

///BOOK
function getallbook() {
    $link = createllySqlConnection();
    $query = "select * from book";
    $result = mysqli_query($link, $query)or die(mysqli_error($link));
    mysqli_close($link);
    return $result;
}

function addbook($isbn, $title, $author, $description, $publisher, $publish_date, $genre_id) {
    $link = createllySqlConnection();
    $query = 'INSERT INTO book (isbn,title,author,description,publisher,publish_date,genre_id) VALUES(?,?,?,?,?,?,?)';
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "isssssi", $isbn, $title, $author, $description, $publisher, $publish_date, $genre_id);
        mysqli_stmt_execute($stmt) or die(mysqli_errno($link));
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}

function addbookwithcover($isbn, $title, $author, $description, $publisher, $publish_date, $cover, $genre_id) {
    $link = createllySqlConnection();
    $query = 'INSERT INTO book (isbn,title,author,description,publisher,publish_date,cover,genre_id) VALUES(?,?,?,?,?,?,?,?)';
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "issssssi", $isbn, $title, $author, $description, $publisher, $publish_date, $cover, $genre_id);
        mysqli_stmt_execute($stmt) or die(mysqli_errno($link));
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}

function deleteBook($isbn) {
    $link = createllySqlConnection();
    $query = 'DELETE FROM book WHERE isbn = ?';
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $isbn);
        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}

function idbook($idYangDicari) {
    $link = createllySqlConnection();
    $query = 'SELECT * FROM book WHERE isbn = ?';
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $idYangDicari);
        mysqli_stmt_execute($stmt) or die(mysqli_errno($link));
        mysqli_stmt_bind_result($stmt, $returnisbn, $returntitle, $returnauthor, $returndescm, $returnpublisher, $returnpublisdate, $returncover, $returngenre);
        mysqli_stmt_fetch($stmt);
        $qqResult = array('isbn' => $returnisbn, 'title' => $returntitle, 'author' => $returnauthor, 'description' => $returndescm, 'publisher' => $returnpublisher, 'publish_date' => $returnpublisdate, 'cover' => $returncover, 'genre_id' => $returngenre);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
    return $qqResult;
}

function edbook($title, $author, $description, $publisher, $publish_date, $genre_id, $isbn) {
    $link = mysqli_connect('localhost', 'root', '', 'pwl20181', '3306') or die(mysqli_connect_error());
    $query = 'UPDATE book SET  title = ?, author = ?,description = ? ,publisher = ?,publish_date = ? , genre_id = ? WHERE isbn = ?  ';
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "sssssis", $title, $author, $description, $publisher, $publish_date, $genre_id, $isbn);
        mysqli_stmt_execute($stmt) or die(mysqli_errno($link));
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);

    header('location:index.php?navito=Book');
}

function edCover($title, $author, $description, $publisher, $publish_date, $targetFile, $genre_id, $isbn) {
    $link = mysqli_connect('localhost', 'root', '', 'pwl20181', '3306') or die(mysqli_connect_error());
    $query = 'UPDATE book SET  title = ?, author = ?,description = ? ,publisher = ?,publish_date = ? , cover = ? , genre_id = ? WHERE isbn = ?  ';
    if ($stmt = mysqli_prepare($link, $query)or die(mysqli_error($link))) {
        mysqli_stmt_bind_param($stmt, "ssssssis", $title, $author, $description, $publisher, $publish_date, $targetFile, $genre_id, $isbn);
        mysqli_stmt_execute($stmt) or die(mysqli_errno($link));
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);

    header('location:index.php?navito=Book');
}
