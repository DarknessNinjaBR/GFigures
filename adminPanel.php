<?php
session_start();
include("database.php");

if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("location: index.php");
} else {
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
    <title>Painel de administrador</title>
</head>

<body>
    <?php include("header.php") ?>
    <div class="body">
        <div class="content">
            <div class="row account_info">
                <div class="mx-auto col-3 card margin_1_percent" style="width: 18rem;">
                    <!-- <img class="card-img-top" src="assets\img\Admin Panel\Admin Product.jpg" alt="Capa produto"> -->
                    <div class="card-body">
                        <h5 class="card-title">Adicionar Produto</h5>
                        <p class="card-text">Clique para Adicionar um produto, ele ficará disponivel na home para compra. É necessário adicionar a marca e a categoria.</p>
                        <a href="formProduct.php" class="btn btn-primary">Adicionar</a>
                    </div>
                </div>
                <div class="mx-auto col-3 card margin_1_percent" style="width: 18rem;">
                    <!-- <img class="card-img-top" src="assets\img\Admin Panel\Admin Category.jpg" alt="Capa categoria"> -->
                    <div class="card-body">
                        <h5 class="card-title">Adicionar Categoria</h5>
                        <p class="card-text">Clique para Adicionar uma marca, adicione a um produto e ela filtrará os produtos na aba de "Colecionaveis".</p>
                        <a href="formCategory.php" class="btn btn-primary">Adicionar</a>
                    </div>
                </div>
                <div class="mx-auto col-3 card margin_1_percent" style="width: 18rem;">
                    <!-- <img class="card-img-top" src="assets\img\Admin Panel\Admin Brand.jpg" alt="Capa marca"> -->
                    <div class="card-body">
                        <h5 class="card-title">Adicionar Marca</h5>
                        <p class="card-text">Clique para Adicionar uma marca, adicione a um produto e ela filtrará os produtos na aba de "Marcas".</p>
                        <a href="formBrand.php" class="btn btn-primary">Adicionar</a>
                    </div>
                </div>
            </div>
            <div class="row account_info">
                <div class="mx-auto col-3 card margin_1_percent" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Lista de Produto</h5>
                        <p class="card-text">Veja a lista de todos os produtos adicionados.</p>
                        <a href="listProduct.php" class="btn btn-primary">Ver</a>
                    </div>
                </div>
                <div class="mx-auto col-3 card margin_1_percent" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Lista de Categoria</h5>
                        <p class="card-text">Veja a lista de todos os categorias adicionados.</p>
                        <a href="listCategory.php" class="btn btn-primary">Ver</a>
                    </div>
                </div>
                <div class="mx-auto col-3 card margin_1_percent" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Lista de Marca</h5>
                        <p class="card-text">Veja a lista de todas os marcas adicionados.</p>
                        <a href="listBrand.php" class="btn btn-primary">Ver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <footer class="footer">
        Todos os direitos reservados © DNBR
    </footer>
</body>

</html>