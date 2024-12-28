<?php
require_once '../../config/database.php';
spl_autoload_register(function ($className) {
    require_once "../../app/models/$className.php";
});

$productModel = new Product();
if (isset($_POST['btn-delete'])) {
    $productModel->delete($_POST['btn-delete']);
}
if (isset($_POST['btn-restore'])) {
    $productModel->restore($_POST['btn-restore']);
}
if (isset($_POST['btn-empty'])) {
    $productModel->deleteAll($_POST['id-delete']);
}

$products = $productModel->allBin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <form action="bin.php" method="post" onsubmit="return confirm('Thực hiện không?')">
            <h1>
                Manage Products <a href="index.php" class="btn btn-outline-primary">Products</a>
                <button type="submit" class="btn btn-outline-danger" name="btn-empty">Empty</button>
            </h1>
            <table class="table">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="" id="" class="form-check-input" onclick="checkAll(this)"></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($products as $product) :
                    ?>
                        <tr>
                            <td><input type="checkbox" name="id-delete[]" class="form-check-input check-id" value="<?php echo $product['id'] ?>"></td>
                            <td><?php echo $product['id'] ?></td>
                            <td><?php echo $product['name'] ?></td>
                            <td><?php echo $product['price'] ?></td>
                            <td><img src="../../public/images/<?php echo $product['image'] ?>" width="50"></td>
                            <td>
                                <button type="submit" class="btn btn-outline-success" name="btn-restore" value="<?php echo $product['id'] ?>">Restore</button>
                                
                                <button type="submit" class="btn btn-outline-danger" name="btn-delete" value="<?php echo $product['id'] ?>">Delete</button>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>

                </tbody>
            </table>
        </form>
    </div>

    <!-- <form action="bin.php" method="post" onsubmit="return confirm('Restore không?')" id="form-restore">
    </form>

    <form action="bin.php" method="post" onsubmit="return confirm('Xóa không?')" id="form-delete">
    </form> -->

    <script>
        function checkAll(thisCheck) {
            const checkId = document.querySelectorAll('.check-id');

            if (thisCheck.checked == true) {
                checkId.forEach(element => {
                    element.setAttribute('checked', 'checked');
                });
            } else {
                checkId.forEach(element => {
                    element.removeAttribute('checked');
                });
            }
        }
    </script>
</body>

</html>