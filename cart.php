<?php
session_start();
include("database.php");

if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("location: formLogin.php?carrinho=logarpls");
    return;
}
error_reporting(0);
if (!empty($_POST["quantity"])) {
    $qnt = $_POST["quantity"];
} else {
    $qnt = 1;
}


if (isset($_GET["add"])) {
    if (isset($_SESSION["cart"])) {
        $item_array_id = array_column($_SESSION["cart"], "product_id");
        if (!in_array($_GET["id"], $item_array_id)) {
            $count = count($_SESSION["cart"]);
            $sql = "SELECT * FROM products WHERE id = $_GET[id];";

            $result1 = mysqli_query($connect, $sql);
            while ($product_data = mysqli_fetch_array($result1)) {
                $item_array = array(

                    'product_id' => $_POST["id"],
                    'name' => $product_data['name'],
                    'price' => $product_data['price'],
                    'item_quantity' => $_POST["quantity"],

                );
                array_push($_SESSION['cart'], $item_array);
            }
            echo '<script>window.location="Cart.php"</script>';
        } else {
            echo '<script>alert("Product is already Added to Cart")</script>';
            echo '<script>window.location="Cart.php"</script>';
        }
    } else {
        $item_array = array(
            'product_id' => $_GET["id"],
            'item_quantity' => $_GET["quantity"],
        );
        $_SESSION["cart"][0] = $item_array;
    }
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["cart"] as $keys => $value) {
            if ($value["product_id"] == $_GET["id"]) {
                unset($_SESSION["cart"][$keys]);
                echo '<script>alert("Product has been Removed...!")</script>';
                echo '<script>window.location="Cart.php"</script>';
            }
        }
    }
}
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="icon" href="assets/img/Icon/icon.png">
    <title>Carrinho de compras</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Titillium+Web');

        * {
            font-family: 'Titillium Web', sans-serif;
        }

        .product {
            border: 1px solid #eaeaec;
            margin: -1px 19px 3px -1px;
            padding: 10px;
            text-align: center;
            background-color: #efefef;
        }

        table,
        th,
        tr {
            text-align: center;
        }

        .title2 {
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }

        h2 {
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }

        table th {
            background-color: #efefef;
        }
    </style>
</head>

<body>
    <?php include("header.php") ?>
    <div class="body">
        <div class="content">
            <div class="cart_info">
                <form method="post" action="receiveCart.php" style="width: 95%;">
                <?php
                if (!empty($_SESSION["cart"])) {
                ?>
                    <div></div>
                    <h3 class="title2">Detalhes do Carrinho</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Produto</th>
                                <th width="10%">Quantidade</th>
                                <th width="13%">Preço</th>
                                <th width="10%">Preço total</th>
                                <th width="17%">Remover</th>
                            </tr>
                            <input type="text" hidden name="id_user" value="<?php echo $_SESSION["id"]; ?>">
                            <?php

                            if ($_GET["frete"]) {
                                if ($_GET["frete"] == "sedex") {
                                    $frete_price = $_SESSION['sedex'];
                                    $prazo = $_SESSION['prazo_sedex'];
                            ?>
                                    <input type="text" hidden name="frete" value="<?php echo ($prazo . ": R$" . $frete_price); ?>">
                                <?php

                                } else if ($_GET["frete"] == "pac") {
                                    $frete_price = $_SESSION['pac'];
                                    $prazo = $_SESSION['prazo_pac'];
                                ?>
                                    <input type="text" hidden name="frete" value="<?php echo ($prazo . ": R$" . $frete_price); ?>">
                                <?php
                                } else {
                                    $frete_price = 0;
                                }
                            }

                            $total = 0;

                            foreach ($_SESSION["cart"] as $key => $value) {
                                ?>
                                <tr>
                                    <td><?php echo $value["name"]; ?></td>
                                    <td><?php echo $value["item_quantity"]; ?></td>
                                    <td>R$<?php echo number_format($value["price"], 2, ",", "."); ?></td>
                                    <td>
                                        R$<?php $qnt_price = $value["item_quantity"] * $value["price"];
                                            echo number_format($qnt_price, 2, ",", "."); ?></td>
                                    <td><a href="Cart.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span class="text-danger">Remove Item</span></a></td>
                                    <input type="text" hidden name="id_product[]" value="<?php echo $value["product_id"]; ?>">
                                    <input type="text" hidden name="quantity_product[]" value="<?php echo $value["item_quantity"]; ?>">


                                </tr>
                            <?php
                                $total = $total + $qnt_price;
                            }
                            $total = $total + str_replace(",", ".", $frete_price);

                            ?>
                            <input type="text" hidden name="total_price" value="<?php echo $total; ?>">
                            <tr>
                                <!-- <td colspan="3" align="right">Frete</td>
                                <th align="right">R$<?php echo $_SESSION['frete'] ?></th>
                                <td></td>
                            </tr>-->
                            <tr>
                                <td>
                                    <?php
                                    echo ($prazo);
                                    ?>
                                </td>
                                <td></td>
                                <td></td>
                                <td> <?php
                                        echo ("R$" . str_replace(".", ",", $frete_price));
                                        ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right">Total</td>
                                <th align="right">R$<?php echo number_format($total, 2, ",", "."); ?></th>
                                <td></td>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col" style="display: flex; justify-content: right;">
                                <div class="dropdown text-left">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ESCOLHER FRETE
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="cart.php?frete=sedex">SEDEX</a>
                                        <a class="dropdown-item" href="cart.php?frete=pac">PAC</a>
                                    </div>
                                </div>
                                <?php
                                ?>
                            </div>
                            <?php
                            if ($_GET["frete"] == "sedex" || $_GET["frete"] == "pac") {

                            ?>

                                <div class="col" style="display: flex; justify-content: flex-end;"><button type="input" class="btn btn-lg btn-success">Comprar <span class="carousel-control-next-icon" aria-hidden="true" style="height: 13px;"></span></button></div>


                            <?php

                            } else {
                            ?>

                                <div class="col" style="display: flex; justify-content: flex-end;"><button type="button" disabled class="btn btn-lg btn-danger">Selecione um frete<span class="carousel-control-next-icon" aria-hidden="true" style="height: 13px;"></span></button></div>


                        <?php
                            }
                        } else {
                            echo ("<h2><a href='index.php'>Selecione produtos para adicionar ao carrinho!</a></h2>");
                        }

                        ?>
                        </div>



                    </div>
                </form>
            </div>
        </div>
        <footer class="footer">
            Todos os direitos reservados © DNBR
        </footer>
</body>

</html>