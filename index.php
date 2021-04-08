<?php
session_start();
include ("database.php");
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
    <title>GFigures</title>
</head>

<body>
    <?php include ("header.php") ?>
    <div class="body">
        <div class="content">
            <div class="account_info">
                <div class="row">
                    <?php

                    $sql = "SELECT * FROM products ORDER BY id DESC;";

                    $result = mysqli_query($connect, $sql);

                    while ($product_data = mysqli_fetch_array($result)) {

                    ?>


                        <div class="img_margin col-md-2 col-sm-6">
                            <div class="product-grid text-left">
                                <div class="product-image">
                                    <a href="product.php?id=<?php echo ($product_data['id']); ?>">

                                        <?php
                                        
                                        $sql1 = "SELECT * FROM products INNER JOIN img_product ON products.id = img_product.product_id WHERE $product_data[id] = products.id;";

                                        $result1 = mysqli_query($connect, $sql1);
                                        $i = 0;
                                        while ($img_data = mysqli_fetch_array($result1)) {
                                            if ($i < 2) {
                                                $i = $i + 1;
                                        ?>
                                                <img class="pic-<?php echo ($i) ?>" src="assets/img/Product Img/<?php echo ($img_data['url']) ?>">

                                        <?php
                                            }
                                        }
                                        ?>

                                        <!-- <img class="pic-1" src="http://bestjquery.com/tutorial/product-grid/demo9/images/img-1.jpg">
                                <img class="pic-2" src="http://bestjquery.com/tutorial/product-grid/demo9/images/img-2.jpg">-->
                                    </a>

                                    <!--<span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>-->
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a href="product.php?id=<?php echo ($product_data['id']); ?>"><?php echo ($product_data['name']); ?></a></h3>
                                    <div class="price">R$<?php $price = $product_data['price']; echo number_format($price,2,",","."); ?>
                                        <?php
                                        if ($product_data['old_price'] != 0) {

                                        ?>
                                            <span>R$<?php echo number_format($product_data['old_price'],2,",","."); ?></span>
                                        <?php

                                        }
                                        ?>

                                        <!-- <span>$20.00</span>-->
                                    </div>
                                    <a class="add-to-cart" href="product.php?id=<?php echo($product_data['id']); ?>">Comprar</a>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        Todos os direitos reservados © DNBR
    </footer>
</body>

</html>