<?php
session_start();
include ("database.php");

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/jquery.mask.js"></script>
    <link rel="icon" href="assets/img/Icon/icon.png">
    <title>GFigures atualizar produto</title>
    <script>
        $(document).ready(function(){
            $('#oldMoney').mask('000.000.000.000.000,00', {reverse: true})
            $('#money').mask('000.000.000.000.000,00', {reverse: true});
});
    </script>
</head>
<body>
    <?php include ("header.php") ?>
    <div class="body">
        <div class="conteudo" class="container">
            <div class="register_form_column">
                <form class="needs-validation" enctype="multipart/form-data" novalidate action="receiveUpdateProduct.php" method="POST">
                    <div class="internal_form_register">
                        <div class="collunm_form_register">
                        <?php
                    $sql = "SELECT * FROM products WHERE id = $_GET[id];";

                    $result = mysqli_query($connect, $sql);

                    if(mysqli_num_rows($result) == 0){
                        header("location: listProduct.php");
                    }

                    while ($product_data = mysqli_fetch_array($result)) {
                ?>
                            <div class="form-group">
                                <input type="text" value="<?php echo($product_data['id']);  ?>" name="id" hidden required maxlength="55" class="form-control" id="validationCustom01" aria-describedby="emailHelp" placeholder="Nome da marca">
                                <label for="exampleInputEmail1">Nome do produto</label>
                                <input type="text" value="<?php echo($product_data['name']);  ?>" name="name" required maxlength="55" class="form-control" id="validationCustom01" aria-describedby="emailHelp" placeholder="Nome da marca">
                                <div class="invalid-feedback">Este campo é obrigatório.</div>
                            </div>
                          <!--  <div class="mb-3">
                                <label for="validationTextarea">Descrição</label>
                                <textarea name="description" class="form-control" rows="14" maxlength="1024" id="validationCustom01" placeholder="Insira a descrição do produto aqui" required><?php //echo($product_data['description']);  ?></textarea>
                                <div class="invalid-feedback">Este campo é obrigatório.</div>
                            </div>-->
                            <div class="mb-3">
                                <!-- <label for="validationTextarea">Descrição</label>
                                <textarea name="description" class="form-control" rows="14" maxlength="1024" id="validationCustom01" placeholder="Insira a descrição do produto aqui" required></textarea>-->

                                <label for="editor">Descrição do produto</label>
                                <textarea name="description" maxlength="1024" id="editor" required rows="14"><?php echo($product_data['description']);  ?></textarea>
                                <div class="error-msg"></div>

                                <script src="https://kit.fontawesome.com/f8d095f64b.js" crossorigin="anonymous"></script>
                                <script src="assets/js/ckeditor.js"></script>
                                <script>
                                    ClassicEditor
                                        .create(document.querySelector('#editor'), {
                                            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'blockQuote', '|', 'undo', 'redo']
                                        })
                                        .then(editor => {
                                            window.editor = editor;
                                        })
                                        .catch(err => {
                                            console.error(err.stack);
                                        });
                                </script>
                                
                                <script src="assets/js/script.js"></script>




                                <div class="invalid-feedback">Este campo é obrigatório.</div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Preço</label>
                                <input type="text" value="<?php echo number_format($product_data['price'],2,",","."); ?>" id="money" name="price" class="money form-control" aria-describedby="emailHelp" placeholder="Valor do produto">
                                <div class="invalid-feedback">Este campo é obrigatório.</div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Imagens</label>
                                <input type="file" name="imgs[]" method="POST" multiple class="form-control-file" id="exampleFormControlFile1">
                                <?php
                                        
                                        $sql1 = "SELECT * FROM products INNER JOIN img_product ON products.id = img_product.product_id WHERE $product_data[id] = products.id;";

                                        $result1 = mysqli_query($connect, $sql1);
                                        $i = 0;
                                        while ($img_data = mysqli_fetch_array($result1)) {
                                            
                                        ?>
                                                <img width="250" src="assets/img/Product Img/<?php echo ($img_data['url']) ?>">

                                        <?php
                                            }
                                        
                                        ?>
                            </div>
                            <div class="form-group">
                                <label for="inputEstado">Categoria</label>
                                <select id="inputEstado" name="category_id" class="form-control" required="required">
                                    <option value="">Selecione</option>
                                    <?php
                                $sql_data = "SELECT * FROM categories ORDER BY id ASC;";

                                $result_category = mysqli_query($connect, $sql_data);
    
                                while ($category_data = mysqli_fetch_array($result_category)) {
                            ?>
                                    <option <?php if($category_data['id'] == $product_data['category_id']){ echo("selected"); } ?> value="<?php echo($category_data['id']); ?>"><?php echo($category_data['name']); ?></option>
                                    <?php
                                }
                            ?>
                                </select>
                                <div class="invalid-feedback">Este campo é obrigatório.</div>
                            
                            </div>
                            <div class="form-group">
                                <label for="inputEstado">Marca</label>
                                <select id="inputEstado" name="brand_id" class="form-control" required="required">
                                    <option value="">Selecione</option>
                                    <?php
                                $sql_brand = "SELECT * FROM brands ORDER BY id ASC;";

                                $result_brand = mysqli_query($connect, $sql_brand);
    
                                while ($brand_data = mysqli_fetch_array($result_brand)) {
                            ?>
                                    <option <?php if($brand_data['id'] == $product_data['brand_id']){ echo("selected"); } ?> value="<?php echo($brand_data['id']); ?>"><?php echo($brand_data['name']); ?></option>
                                    <?php
                                }
                            ?>
                                </select>
                                <div class="invalid-feedback">Este campo é obrigatório.</div>
                            
                            </div>
                            <div class="form-group">
                                <label for="inputEstado">Lançamento</label>
                                <select id="inputEstado" name="launch" class="form-control" required="required">
                                    <option value="">Selecione</option>
                                    <option <?php if($product_data['launch'] == 1){ echo("selected"); } ?> value="1">Sim</option>
                                    <option <?php if($product_data['launch'] == 0){ echo("selected"); } ?> value="0">Não</option>
                                </select>
                                <div class="invalid-feedback">Este campo é obrigatório.</div>
                            </div>
                            <div class="form-group">
                                <label for="inputEstado">Em promoção</label>
                                <select id="promotion" name="sale" class="form-control" required="required">
                                    <option value="">Selecione</option>
                                    <option value="1" <?php if($product_data['sale'] == 1){ echo("selected"); } ?>>Sim</option>
                                    <option value="0" <?php if($product_data['sale'] == 0){ echo("selected"); } ?>>Não</option>
                                </select>
                                <div id="divid">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Preço Antigo</label>
                                        <input type="text" value="<?php echo number_format($product_data['old_price'],2,",","."); ?>" id="oldMoney" name="old_price" class="oldMoney form-control" aria-describedby="emailHelp" placeholder="Valor do produto antes da promoção">
                                        <div class="invalid-feedback">Este campo é obrigatório.</div>
                                    </div>
                                </div>
                                <div class="invalid-feedback">Este campo é obrigatório.</div>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form_register_button">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
                <script>            
                    // Exemplo de JavaScript inicial para desativar envios de formulário, se houver campos inválidos.
                    (function() {
                        'use strict';
                        window.addEventListener('load', function() {
                            // Pega todos os formulários que nós queremos aplicar estilos de validação Bootstrap personalizados.
                            var forms = document.getElementsByClassName('needs-validation');
                            // Faz um loop neles e evita o envio
                            var validation = Array.prototype.filter.call(forms, function(form) {
                                form.addEventListener('submit', function(event) {
                                    if (form.checkValidity() === false) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                    }
                                    form.classList.add('was-validated');
                                }, false);
                            });
                        }, false);
                    })();

                    $(document).ready(function(){
                        $('#promotion').on('change', function() {
                        if ( this.value == '1')
                        {
                            $("#divid").show();
                        }
                        else
                        {
                            $("#divid").hide();
                        }
                        });
                    });    
                    function toggleOldPrice() {
  if ( $('#promotion').val() == '1')
  {
      $("#divid").show();
  }
  else
  {
      $("#divid").hide();
  }
}

$(document).ready(function(){
  toggleOldPrice();
  
  $('#promotion').on('change', function() {
    toggleOldPrice();
  });
});                           
</script>
            </div>
        </div>
    </div>
    <footer class="footer">
        Todos os direitos reservados © DNBR
    </footer>
</body>

</html>