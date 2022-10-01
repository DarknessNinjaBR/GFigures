<?php
session_start();
include("database.php");
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
    <title>Meus pedidos</title>
</head>

<body>
    <?php include("header.php") ?>
    <div class="body">
        <div class="content">
            <div class="list-info">
                <h3 class="title2">Todos os pedidos</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 10%;">Numero do pedido</th>
                            <th scope="col" style="width: 60%;">Produtos</th>
                            <th scope="col" style="width: 17%;">Frete</th>
                            <th scope="col" style="width: 13%;">Preço Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_order = "SELECT * FROM user_order WHERE user_id = $_SESSION[id] ORDER BY id DESC;";
                        $result_order = mysqli_query($connect, $sql_order);
                        while ($order_data = mysqli_fetch_array($result_order)) {

                        ?>
                            <tr>
                                <th scope="row"><?php echo ("#" . $order_data['id']); ?></th>
                                <td style="justify-content: flex-start;">
                                    <?php
                                    $sql_product = "SELECT * FROM product_order WHERE order_id = $order_data[id];";

                                    $result_product = mysqli_query($connect, $sql_product);
                                    while ($product_data = mysqli_fetch_array($result_product)) {

                                        $sql_stats = "SELECT * FROM products WHERE id = $product_data[product_id];";

                                        $result_stats = mysqli_query($connect, $sql_stats);
                                        while ($stats_data = mysqli_fetch_array($result_stats)) {
                                            ?>
                                            <div class="row"><?php echo($stats_data['name']); ?> - R$<?php echo number_format($stats_data['price'],2,",","."); ?> - Qnt. <?php echo($product_data['quantity']); ?></div>
                                            <?php
                                        }
                                    }

                                    ?>
                                </td>
                                <td><?php echo($order_data['frete']); ?></td>
                                <td>R$<?php echo number_format($order_data['total_price'], 2, ",", "."); ?></td>


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