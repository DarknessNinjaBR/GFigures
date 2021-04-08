<header class="top" class="container">
        <div>
            <a href="index.php">
                <h1>GFigures</h1>
            </a>
        </div>
        <div>
            <form action="result.php" method="GET" class="menu">
                <input class="form-control form-control-lg" type="text" name="search" placeholder="O que você procura?">
                <button id="search" class="btn btn-primary">Enviar</button>
            </form>
        </div>
        <div>
            <?php
            if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
            ?>
                <div class="btn-group" role="group" aria-label="Exemplo básico">
                    <a href="account.php" class="btn btn-secondary">Conta: <?php echo ($_SESSION['first_name']); ?></a>
                    <a href="logout.php" class="btn btn-secondary">Deslogar</a>
                </div>
            <?php
            } else {
            ?>
                <div class="btn-group" role="group" aria-label="Exemplo básico">
                    <a href="formLogin.php" class="btn btn-secondary">Login</a>
                    <a href="formRegister.php" class="btn btn-secondary">Registro</a>
                </div>
            <?php } ?>
            <a href="cart.php" class="btn btn-primary"> Carrinho <span class="badge badge-light"><?php error_reporting(0); if($_SESSION["cart"] != null) {echo(count($_SESSION["cart"])); }else{echo("0");}?></span>
            </a>
        </div>
    </header>
    </div>
    <div class="menu">
        <div class="menu_button">
            <a href="index.php" class="btn btn-dark">Home</a>
        </div>
        <div class="menu_button">
            <a href="result.php?filter_sale=true" class="btn btn-dark">Promoção</a>
        </div>
        <div class="menu_button">
            <a href="result.php?filter_launch=true" class="btn btn-dark">Lançamento</a>
        </div>
        <div class="menu_button dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Marcas
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php
                $sql_brand = "SELECT * FROM brands;";

                $result_brand = mysqli_query($connect, $sql_brand);

                while ($brand_data = mysqli_fetch_array($result_brand)) {
                ?>
                    <a class="dropdown-item" href="result.php?filter_brand=<?php echo ($brand_data['id']) ?>"><?php echo ($brand_data['name']) ?></a>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="menu_button dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Colecionaveis
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php
                $sql_category = "SELECT * FROM categories;";

                $result_category = mysqli_query($connect, $sql_category);

                while ($category_data = mysqli_fetch_array($result_category)) {
                ?>
                    <a class="dropdown-item" href="result.php?filter_category=<?php echo ($category_data['id']) ?>"><?php echo ($category_data['name']) ?></a>
                <?php
                }
                ?>
            </div>
        </div>
        <?php
        if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
            if ($_SESSION['admin'] > 0) {
        ?>
                <div class="menu_button">
                    <a href="adminPanel.php" class="btn btn-dark">Painel administrador</a>
                </div>
        <?php
            }
        }
        ?>

    </div>