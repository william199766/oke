<?php
//kode untuk menghapus data
$deleteCommand = filter_input(INPUT_GET, 'command');
if (isset($deleteCommand) && $deleteCommand == 'delete') {
    $idYangDihapus = filter_input(INPUT_GET, 'sid');
    deleteGenre($idYangDihapus);
}
// kode untuk menambah data
$submitted = filter_input(INPUT_POST, 'btnSubmit');
if (isset($submitted)) {
    $name = filter_input(INPUT_POST, 'txtName');
    addGenre($name);
}
?>

<form method="POST">
    <fieldset>
        <legend>Input New Genre</legend>
        <label form=="txtNameId">Name</label>
        <input type="text" id="txtNameId" name="txtName" autofocus="" placeholder="Name"/>
        <input type="submit" name="btnSubmit" value="Save"/>
    </fieldset>
</form>

<?php
$result = getAllgenre();
echo'<table border = "1" id = "initabel" class = "display">';
echo'<thead>';
echo'<tr>';
echo'<th>ID</th>';
echo'<th>Name</th>';
echo'<th>Action</th>';
echo'</tr>';
echo'</thead>';
echo'<tbody>';
while ($row = mysqli_fetch_array($result)) {
    echo'<tr>';
    echo'<td>' . $row['id'] . '</td>';
    echo'<td>' . $row['name'] . '</td>';
    echo'<td><button onClick="deleteGenre(' . $row['id'] . ')">Delete</button><button onClick="editGenre(' . $row['id'] . ')">Edit</button></td>';
    echo'</tr>';
}

echo'</tbody>';
echo'</table>';
?>