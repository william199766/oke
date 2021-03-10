
<h4>Ini halaman book</h4>

<?php
$btnSubmit = FILTER_INPUT(INPUT_POST, 'btnSubmitBook');
$bookDao = new BookDaoImpl();
if(isset($btnSubmit))
{
    $isbn = FILTER_INPUT(INPUT_POST, 'isbn');
    $title = FILTER_INPUT(INPUT_POST, 'title');
    $author = FILTER_INPUT(INPUT_POST, 'author');
    $publisher = FILTER_INPUT(INPUT_POST, 'publisher');
    $publishdate = FILTER_INPUT(INPUT_POST, 'publish_date');
    $price = FILTER_INPUT(INPUT_POST, 'price');
    $hasilcat = FILTER_INPUT(INPUT_POST, 'cat');

    $book = new Book();
    $book->setIsbn($isbn);
    $book->setTitle($title);
    $book->setAuthor($author);
    $book->setPublisher($publisher);
    $book->setPublishDate($publishdate);
    $book->setPrice($price);

    $namafile = $_FILES['cover']['name'];
    $tmp = $_FILES['cover']['tmp_name'];
    $ukuran = $_FILES['cover']['size'];
    $ext = pathinfo($namafile, PATHINFO_EXTENSION);

    $app_ext = array('png','jpg','jpeg','gif','svg','bmp');
    $newfile = $isbn.'.'.$ext;
	$link = mysqli_connect('localhost', 'root', '', 'pw2_20202', '3306') or die(mysqli_connect_error());
	//$link = mysqli_connect('localhost', 'root', '', 'pw2_pr_20202', '3306') or die(mysqli_connect_error());
    $query = "select * from genre";
    if ($result = mysqli_query($link, $query)or die(mysqli_error($link))) {
       while ($row = mysqli_fetch_array($result)) {
               echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
            }
    mysqli_close($link);
    if(in_array(strtolower($ext), $app_ext) == TRUE && $ukuran <= 1024*1024*2 ){
        move_uploaded_file($tmp, 'images/'.$newfile);

        $msg = $bookDao->insertBook($book);
    }
    else{
        $msg = 'ext';
    }


}

$cmd = FILTER_INPUT(INPUT_GET, 'command');
if($cmd == 'edit'){

    $id = FILTER_INPUT(INPUT_GET, 'id');

}else if($cmd == 'delete'){
    $id = FILTER_INPUT(INPUT_GET, 'id');
    $msgdel = deleteBook($id);
}
if($_SESSION['approved_user'] == TRUE) {
    ?>

    <fieldset>
        <legend>Insert Book</legend>
        <form method="POST" action="" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>ISBN</td>
                    <td>:</td>
                    <td><input type="text" name="isbn" placeholder="ISBN"/></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Title</td>
                    <td>:</td>
                    <td><input type="text" name="title" placeholder="Title"/></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Author</td>
                    <td>:</td>
                    <td><input type="text" name="author" placeholder="Author"/></td>
                </tr>
                <tr>
                    <td>Publisher</td>
                    <td>:</td>
                    <td><input type="text" name="publisher" placeholder="Publisher"/></td>
                </tr>
                <tr>
                    <td>Publish Date</td>
                    <td>:</td>
                    <td><input type="text" name="publish_date" placeholder="Publish Date"/></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>:</td>
                    <td><input type="text" name="price" placeholder="Price"/></td>
                </tr>
                <tr>
                    <td>Cover</td>
                    <td>:</td>
                    <td><input type="file" name="cover" required/></td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>:</td>
                    <td>
                        <select name="cat">
                            <option value="">-Select Company-</option>
                            <?php
                            $hasilcat = getAllCategory();
                            while ($datacat = $hasilcat->fetch()) {
                                ?>
                                <option value="<?php echo $datacat['id_cat']; ?>">
                                    <?php echo $datacat['name_cat']; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <?php
                if($_SESSION['approved_user'] == TRUE) {
                ?>
                <tr>
                    <td colspan="2"><input type="submit" value="Submit" name="btnSubmitBook"/></td>
                </tr>
                <?php } ?>
            </table>
        </form>
        <?php
        if (isset($msg)) {
            if ($msg == 'sukses') {
                echo '<p style="color:rgba(128,119,127,0);">Data berhasil disimpan.</p>';
            } else if ($msg == 'gagal'){
                echo '<p style="color:red;">Data gagal disimpan.</p>';
            }else if ($msg = 'ext'){
                echo '<p style="color:red;">Data gagal disimpan karena vile cover tidak sesuai typenya.</p>';
            }
        } else {
            $msg = FILTER_INPUT(INPUT_GET, 'msg');
            if ($msg == 'suksesu') {
                echo '<p style="color:green;">Data berhasil diubah.</p>';
            } else if ($msg == 'gagalu') {
                echo '<p style="color:red;">Data gagal diubah.</p>';
            }

        }
        if (isset($msgdel)) {
            if ($msgdel == 'suksesx') {
                echo '<p style="color:green;">Data berhasil dihapus.</p>';
            } else {
                echo '<p style="color:red;">Data gagal dihapus.</p>';
            }
        }
        ?>
    </fieldset>
    <?php
}
?>
<?php
$hasil = $bookDao->getAllBook();
?>

<table class="display" id="book" style="text-align: center">
    <thead>
    <tr>
        <th>No</th>
        <th>ISBN</th>
        <th>Title</th>
        <th>Author</th>
        <th>Publisher</th>
        <th>Publish Date</th>
        <th>Price</th>
        <th>Cover</th>
        <th>Category Name</th>
        <?php if($_SESSION['approved_user'] == TRUE && $_SESSION['userrole'] == 'admin') { ?>
        <th>Action</th>
        <?php } ?>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 1;
    while ($data = $hasil->fetch()) {
        ?>
        <tr>
            <td><?php echo $i?></td>
            <td><img src="images/<?php echo $data['cover']; ?>" width="90px" height="120px"/></td>
            <td><?php echo $data->getIsbn(); ?></td>
            <td><?php echo $data->getTitle(); ?></td>
            <td><?php echo $data->getAuthor(); ?></td>
            <td><?php echo $data->getPublisher(); ?></td>
            <td><?php echo $data->getPublishDate(); ?></td>
            <td><?php echo number_format($data['price'],'0',',','.'); ?></td>
            <td><?php echo $data['name_cat']; ?></td>
            <?php
            if($_SESSION['approved_user'] == TRUE && $_SESSION['userrole'] == 'admin') {
            ?>
            <td><input type="button" onclick="editBook(<?php echo $data->getIsbn(); ?>)" value="Edit">
                <input type="button" onclick="delBook(<?php echo $data->getIsbn(); ?>)" value="Delete">
            </td>
            <?php } ?>
        </tr>
        <?php
        $i++;
    }
    ?>
    </tbody>
</table>
<script type="text/javascript">
    $(document).ready(function() {
        $('#book').DataTable();
    });
</script>