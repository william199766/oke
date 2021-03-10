
<h4>Ini halaman category</h4>

<?php
$catDao = new CategoryDaoImpl();
$btnSubmit = FILTER_INPUT(INPUT_POST, 'btnSubmitCat');
if($btnSubmit)
{
    $name = FILTER_INPUT(INPUT_POST, 'catname');
    $cat = new CategoryDaoImpl();
    $cat->setNameCat($name);


    $msg = $catDao->insertCategory($cat);
}

$commandBtn = FILTER_INPUT(INPUT_GET, 'command');
if($commandBtn == 'delete'){
    $id = FILTER_INPUT(INPUT_GET, 'id');
    $msgdel = $catDao->deleteCategory($cat);
}
else if($commandBtn == 'edit'){
    $id = FILTER_INPUT(INPUT_GET, 'id');
    $msg = $catDao->updateCategory($cat);
}
if($_SESSION['approved_user'] == TRUE && $_SESSION['userrole'] == 'admin') {
    ?>

    <fieldset>
        <legend>Insert Category</legend>
        <form method="POST" action="">
            <table>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td><input type="text" name="catname" required placeholder="Name Category"/></td>
                </tr>
                <tr>
                    <td colspan="3"><input type="submit" value="Submit" name="btnSubmitCat"/></td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($msg)) {
            if ($msg == 'sukses') {
                echo '<p style="color:green;">Data berhasil disimpan.</p>';
            } else {
                echo '<p style="color:red;">Data gagal disimpan.</p>';
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
$hasil = $catDao->getAllCategory();
?>

<table class="display" id="category" style="text-align: center">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <?php
        if($_SESSION['approved_user'] == TRUE && $_SESSION['userrole'] == 'admin')
        {
        ?>
        <th>Action</th>
        <?php
        }
        ?>
    </tr>
    </thead>
    <tbody>
    <?php
    while ($data = $hasil->fetch()) {
        ?>
        <tr>
            <td><?php echo $data->getIdCat(); ?></td>
            <td><?php echo $data->getNameCat(); ?></td>
            <?php
            if($_SESSION['approved_user'] == TRUE && $_SESSION['userrole'] == 'admin') {
                ?>
                <td>
                    <button type="submit" onclick="editCat(<?php echo $data->getIdCat(); ?>)">Edit</button>
                    <button type="submit" onclick="deleteCat(<?php echo $data->getIdCat(); ?>) ">Delete</button>
                </td>
                <?php
            }
            ?>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {
        $('#category').DataTable();
    });
</script>