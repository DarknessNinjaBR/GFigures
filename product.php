<?php
session_start();
include ("database.php");
error_reporting(0);

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    if ($_SESSION['frete'] == "") {

        $cep_origem = "88745000";     // Seu CEP , ou CEP da Loja
        $cep_destino = $_SESSION['cep']; // CEP do cliente, que irá vim via POST

        /* DADOS DO PRODUTO A SER ENVIADO */
        $peso          = 2;
        $valor         = 100;
        $tipo_do_frete = '41106'; //Sedex: 40010   |  Pac: 41106
        $altura        = 40;
        $largura       = 30;
        $comprimento   = 30;


        $url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?";
        $url .= "nCdEmpresa=";
        $url .= "&sDsSenha=";
        $url .= "&sCepOrigem=" . $cep_origem;
        $url .= "&sCepDestino=" . $cep_destino;
        $url .= "&nVlPeso=" . $peso;
        $url .= "&nVlLargura=" . $largura;
        $url .= "&nVlAltura=" . $altura;
        $url .= "&nCdFormato=1";
        $url .= "&nVlComprimento=" . $comprimento;
        $url .= "&sCdMaoProria=n";
        $url .= "&nVlValorDeclarado=" . $valor;
        $url .= "&sCdAvisoRecebimento=n";
        $url .= "&nCdServico=" . $tipo_do_frete;
        $url .= "&nVlDiametro=0";
        $url .= "&StrRetorno=xml";

        $xml = simplexml_load_file($url);

        $frete =  $xml->cServico;

        $valorFrete = "".$frete->Valor."";
        $_SESSION['pac'] = $valorFrete;


        $prazoPac = "PAC - Prazo de ".$frete->PrazoEntrega." dias";
        $_SESSION['prazo_pac'] = $prazoPac;

        $_SESSION['frete'] = "<p>PAC: R$ " . $frete->Valor . "<br />Prazo: " . $frete->PrazoEntrega . " dias</p>";


        $peso          = 2;
        $valor         = 100;
        $tipo_do_frete = '40010'; //Sedex: 40010   |  Pac: 41106
        $altura        = 40;
        $largura       = 30;
        $comprimento   = 30;


        $urlSedex = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?";
        $urlSedex .= "nCdEmpresa=";
        $urlSedex .= "&sDsSenha=";
        $urlSedex .= "&sCepOrigem=" . $cep_origem;
        $urlSedex .= "&sCepDestino=" . $cep_destino;
        $urlSedex .= "&nVlPeso=" . $peso;
        $urlSedex .= "&nVlLargura=" . $largura;
        $urlSedex .= "&nVlAltura=" . $altura;
        $urlSedex .= "&nCdFormato=1";
        $urlSedex .= "&nVlComprimento=" . $comprimento;
        $urlSedex .= "&sCdMaoProria=n";
        $urlSedex .= "&nVlValorDeclarado=" . $valor;
        $urlSedex .= "&sCdAvisoRecebimento=n";
        $urlSedex .= "&nCdServico=" . $tipo_do_frete;
        $urlSedex .= "&nVlDiametro=0";
        $urlSedex .= "&StrRetorno=xml";


        $xml = simplexml_load_file($urlSedex);

        $frete =  $xml->cServico;

        $valorFrete = "".$frete->Valor."";
        $_SESSION['sedex'] = $valorFrete;


        $prazoPac = "SEDEX - Prazo de ".$frete->PrazoEntrega." dias";
        $_SESSION['prazo_sedex'] = $prazoPac;

        $_SESSION['frete'] = $_SESSION['frete'] . "<p>SEDEX: R$ " . $frete->Valor . "<br />Prazo: " . $frete->PrazoEntrega . " dias</p>";
    }
}

if (isset($_GET["id"])) {
    $sql = "SELECT * FROM products WHERE id = $_GET[id];";

    $result = mysqli_query($connect, $sql);
} else {
    header("location: index.php");
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
    <title>GFigures</title>
</head>

<body>
    <?php include("header.php") ?>
    <div class="body">
        <div class="wrapper">

            <main>
                <div id="shopify-section-product-template" class="shopify-section">
                    <div class="single-product-area mt-80 mb-80" style="">
                        <div class="container">
                            <div class="row" style="justify-content: center;">
                                <?php
                                while ($product_data = mysqli_fetch_array($result)) {
                                ?>
                                    <div class="col-md-6">
                                        <div class="product-details-large" id="ProductPhoto">
                                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                    <?php

                                                    $sql1 = "SELECT * FROM products INNER JOIN img_product ON products.id = img_product.product_id WHERE $product_data[id] = products.id;";

                                                    $result1 = mysqli_query($connect, $sql1);
                                                    $i = 0;
                                                    while ($img_data = mysqli_fetch_array($result1)) {
                                                        if ($i == 0) {
                                                    ?>
                                                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo ($i); ?>"></li>
                                                    <?php
                                                        }
                                                        $i = $i + 1;
                                                    }
                                                    ?>
                                                    <!--<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>-->
                                                </ol>
                                                <div class="carousel-inner">
                                                    <?php

                                                    $sql1 = "SELECT * FROM products INNER JOIN img_product ON products.id = img_product.product_id WHERE $product_data[id] = products.id;";
                                                    $result1 = mysqli_query($connect, $sql1);
                                                    $i = 0;
                                                    while ($img_data = mysqli_fetch_array($result1)) {
                                                        if ($i == 0) {
                                                    ?>
                                                            <div class="carousel-item active">
                                                                <img class="d-block w-100" src="<?php echo("assets/img/Product Img/".$img_data['url']); ?>" alt="Primeiro Slide">
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="carousel-item">
                                                                <img class="d-block w-100" src="<?php echo("assets/img/Product Img/".$img_data['url']); ?>" alt="Segundo Slide">
                                                            </div>
                                                    <?php
                                                        }
                                                        $i = $i + 1;
                                                    }
                                                    ?>
                                                <!--<div class="carousel-item active">
                                                        <img class="d-block w-100" src="https://cdn.awsli.com.br/600x450/203/203009/produto/47757693/27ebd5282e.jpg" alt="Primeiro Slide">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100" src="https://cdn.awsli.com.br/600x450/203/203009/produto/47757693/27ebd5282e.jpg" alt="Segundo Slide">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100" src="https://cdn.awsli.com.br/600x450/203/203009/produto/47757693/27ebd5282e.jpg" alt="Terceiro Slide">
                                                    </div>-->
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                   <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
                                                   <img width="20" src="https://suncatcherstudio.com/uploads/patterns/arrow-icons/png/circle-left-arrow-icon.png" alt="">
                                                    <span class="sr-only">Anterior</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                    <!--<span class="carousel-control-next-icon" aria-hidden="true"></span>-->
                                                    <img width="20" style="transform: rotateY(180deg)" src="https://suncatcherstudio.com/uploads/patterns/arrow-icons/png/circle-left-arrow-icon.png" alt="">
                                                    <span class="sr-only">Próximo</span>
                                                </a>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-md-5 text-left">
                                        <div class="single-product-content">
                                            <input type="hidden" name="form_type" value="product" /><input type="hidden" name="utf8" value="✓" />
                                            <div class="product-details">
                                                <h2><?php echo ($product_data['name']); ?></h2>
                                                <div class="single-product-reviews">
                                                    <span class="shopify-product-reviews-badge" data-id="1912078270534"></span>
                                                </div>
                                                <?php

                                                $sql_brand = "SELECT * FROM brands WHERE id = $product_data[brand_id]";

                                                $result_brand = mysqli_query($connect, $sql_brand);

                                                while ($brand_data = mysqli_fetch_array($result_brand)) {


                                                ?>

                                                    <div class="product-sku">Marca: <span class="variant-sku"><?php echo ($brand_data['name']); ?></span></div>

                                                <?php } ?>
                                                <?php

                                                $sql_category = "SELECT * FROM categories WHERE id = $product_data[category_id]";

                                                $result_category = mysqli_query($connect, $sql_category);

                                                while ($category_data = mysqli_fetch_array($result_category)) {


                                                ?>
                                                    <div class="product-sku"><?php echo ($category_data['name']);  ?></div>
                                                <?php
                                                }
                                                ?>
                                                <div class="single-product-price">
                                                    <div class="product-grid-content">
                                                        <div class="price text-left">R$<?php echo number_format($product_data['price'], 2, ",", "."); ?><?php if ($product_data['old_price'] != 0) { ?><span>R$<?php echo number_format($product_data['old_price'], 2, ",", "."); ?></span><?php } ?>
                                                        </div>

                                                        <!-- <span>$20.00</span>-->
                                                    </div>
                                                </div>

                                                <div class="single-product-action">

                                                    <div id="teste">
                                                        <div style="margin: 2%;"></div>
                                                        <div class="container">
                                                            <div class="row" style="justify-content: left;">
                                                                <div class="col-md-4">
                                                                    <form action="calcula.php" method="POST">

                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Digite Seu CEP</label>
                                                                            <input type="text" class="form-control" name="cep" id="cep" placeholder="Seu cep">
                                                                            <input type="id" hidden class="form-control" name="id" id="cep" value="<?php echo($product_data['id']); ?>">
                                                                            <small class="form-text text-muted"><a href="http://www.consultaenderecos.com.br/busca-endereco" target="_blank">Não sei meu CEP</a></small>
                                                                            <div>
                                                                                <?php
                                                                                if ($_SESSION['frete'] != "") {
                                                                                    echo ($_SESSION['frete']);
                                                                                }
                                                                                ?>

                                                                            </div>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary">Calcular</button>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- JavaScript-->


                                                    </div>

                                                    <div class="product-add-to-cart">
                                                        <form method="POST" action="cart.php?add=true&id=<?php echo($product_data['id']); ?>">
                                                            <div class="cart-plus-minus">
                                                                <input class="form-control" type="text" name="id" hidden value="<?php echo($product_data['id']); ?>">
                                                                
                                                                <span class="control-label">Quantidade</span>
                                                                <input class="form-control" style="width: 65px;" type="number" min="1" max="100" name="quantity" value="1">
                                                            </div>
                                                            <div class="add" style="margin: 5%;">
                                                                <span class="control-label"><br></span>
                                                                <button type="submit" class="btn btn-primary" id="AddToCart">
                                                                    <i class="ion-bag"></i>
                                                                    <span class="list-cart-title cart-title" id="AddToCartText">Adicionar ao Carrinho</span>
                                                                </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="row text-left" style="
                            width: 85%;
    margin: 2%;
    justify-content: left;">
                                <div class="col">
                                    <h3>Descrição do Produto<br><br></h3>

                                    <?php echo ($product_data['description']); ?>
                                </div>
                            </div>
                        </div>
                    <?php
                                }

                    ?>
                    </div>
                </div>
                <style type="text/css">
                    .product-details .countdown-timer-wrapper {
                        display: none !important;
                    }
                </style>

        </div>
        </main>
    </div>
    <footer class="footer">
        Todos os direitos reservados © DNBR
    </footer>
</body>

</html>