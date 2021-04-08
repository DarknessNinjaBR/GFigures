<?php
session_start();
include ("database.php");
if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("location: index.php");
}else{
    if ($_SESSION['admin'] < 1) {
        header("location: index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="icon" href="assets/img/Icon/icon.png">
    <title>GFigures lista de categorias</title>
</head>
<body>
    <?php include ("header.php") ?>
    <div class="body">
        <div class="container">
            <div class="list-info">
            <a href="formCategory.php" class="btn btn-primary btn-lg">Adicionar mais categorias.</a><br><br>
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome da Marca</th>
                        <th scope="col">Editar/Apagar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM categories ORDER BY id ASC;";

                            $result = mysqli_query($connect, $sql);

                            while ($brand_data = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                        <th scope="row"><?php echo($brand_data['id']); ?></th>
                        <td><?php echo($brand_data['name']); ?></td>
                        <td><a href="formUpdateCategory.php?id=<?php echo($brand_data['id']); ?>"><img src="assets\img\Edit Delete\Edit.png" width="20"></a> | <a href="deleteCategory.php?id=<?php echo($brand_data['id']); ?>"><img src="assets\img\Edit Delete\Trash Can.png" width="20"></a></td>
                        </tr>
                        <tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <footer class="footer">
        Todos os direitos reservados © DNBR
</footer>
</body>

</html>