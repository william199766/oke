<?php
//kode untuk menghapus data
$deleteCommand = filter_input(INPUT_GET, 'command');
if (isset($deleteCommand) && $deleteCommand == 'delete') {
    $idYangDihapus = filter_input(INPUT_GET, 'sid');
    deleteBook($idYangDihapus);
}
// kode untuk menambah data
$submitted = filter_input(INPUT_POST, 'btnSubmit');
if (isset($submitted)) {
    $isbn = filter_input(INPUT_POST, 'txtIsbn');
    $title = filter_input(INPUT_POST, 'txtTitle');
    $author = filter_input(INPUT_POST, 'txtAuthor');
    $description = filter_input(INPUT_POST, 'txtDescription');
    $publisher = filter_input(INPUT_POST, 'txtPublisher');
    $publish_date = filter_input(INPUT_POST, 'txtPublish_Date');
    $cover = filter_input(INPUT_POST, "fileCover");
    $genre_id = filter_input(INPUT_POST, 'comboGenre');
    //  echo $_FILES['fileCover']['name'];
    // echo $_FILES['fileCover']['type'];
    // echo $_FILES['fileCover']['size'];
    // echo $_FILES['fileCover']['tmp_name'];
    if (isset($_FILES['fileCover']['name'])) {
        $targetDirectory = 'upload/';
        $fileExtention = pathinfo($_FILES['fileCover']['name'], PATHINFO_EXTENSION);
        $targetFile = $targetDirectory . $isbn . '.' . $fileExtention;
        move_uploaded_file($_FILES['fileCover']['tmp_name'], $targetFile);

        addbookwithcover($isbn, $title, $author, $description, $publisher, $publish_date, $targetFile, $genre_id);
    } else {
        addbook($isbn, $title, $author, $description, $publisher, $publish_date, $genre_id);
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend>Input New Buku</legend>
        <label form=="txtNameId1">ISBN</label>
        <input type="text" id="txtNameId1" name="txtIsbn" autofocus="" placeholder="ISBN"/></br>
        <label form=="txtNameId2">Title</label>
        <input type="text" id="txtNameId2" name="txtTitle" autofocus="" placeholder="Title"/></br>
        <label form=="txtNameId3">Author</label>
        <input type="text" id="txtNameId3" name="txtAuthor" autofocus="" placeholder="Author"/></br>
        <label form=="txtNameId4">Description</label>
        <input type="text" id="txtNameId4" name="txtDescription" autofocus="" placeholder="Description"/></br>
        <label form=="txtNameId5">Publisher</label>
        <input type="text" id="txtNameId5" name="txtPublisher" autofocus="" placeholder="Publisher"/></br>
        <label form=="txtNameId6">Publish Date</label>
        <input type="Date" id="txtNameId6" name="txtPublish_Date" autofocus="" placeholder="Publish Date"/></br>
        <label form=="Filecover7">Cover</label>
        <input type="file" id="filecover" name="fileCover" class="form-input" accept="image/jpg,image/jpeg,image/png" ><br>
        <label form=="txtNameId7">Genre</label>
        <select name="comboGenre" id ="comboGenreId"></br>
            <?php
            $link = mysqli_connect('localhost', 'root', '', 'pwl20181', '3306') or die(mysqli_connect_error());
            $query = "select * from genre";
            if ($result = mysqli_query($link, $query)or die(mysqli_error($link))) {
                while ($row = mysqli_fetch_array($result)) {
                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
            }
            mysqli_close($link);
            ?>
        </select>
        <input type="submit" name="btnSubmit" value="Save"/>

    </fieldset>
</form>

<?php
$result = getallbook();


echo'<table border = "1" id = "initabel" class = "display">';
echo'<thead>';

echo'<tr>';
echo'<th>ISBN</th>';
echo'<th>Title</th>';
echo'<th>Author</th>';
echo'<th>Description</th>';
echo'<th>Publisher</th>';
echo'<th>Publish Date</th>';
echo'<th>Cover</th>';
echo'<th>Genre</th>';
echo'<th>Action</th>';
echo'</tr>';

echo'</thead>';
echo'<tbody>';
while ($row = mysqli_fetch_array($result)) {
    echo'<tr>';
    if (isset($row['cover'])) {

        echo'<td><img src="' . $row['cover'] . '" alt="cover" class="thumbnail" "</br>' . $row['isbn'] . '</td>';
    } else {
        echo'<td>' . $row['isbn'] . '</td>';
    }
    echo'<td>' . $row['title'] . '</td>';
    echo'<td>' . $row['author'] . '</td>';
    echo'<td>' . $row['description'] . '</td>';
    echo'<td>' . $row['publisher'] . '</td>';
    echo'<td>' . $row['publish_date'] . '</td>';
    echo'<td>' . $row['cover'] . '</td>';
    echo'<td>' . $row['genre_id'] . '</td>';
    echo'<td><button onClick="deleteBook(' . $row['isbn'] . ')">Delete</button><button onClick="editBook(' . $row['isbn'] . ')">Edit</button></td>';
    echo'</tr>';
}

echo'</tbody>';
echo'</table>';
?>