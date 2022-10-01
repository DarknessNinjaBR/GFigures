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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/jquery.mask.js"></script>
    <link rel="icon" href="assets/img/Icon/icon.png">
    <title>GFigures produto</title>
    <script>
        $(document).ready(function() {
            $('#oldMoney').mask('000.000.000.000.000,00', {
                reverse: true
            })
            $('#money').mask('000.000.000.000.000,00', {
                reverse: true
            });
        });
    </script>
</head>
<body>
    <?php include ("header.php") ?>
    <div class="body">
        <div class="conteudo" class="container">
            <div class="register_form_column">
                <form action="receiveProduct.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="internal_form_register">
                        <div class="collunm_form_register">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome do produto</label>
                                <input type="text" name="name" required maxlength="55" class="form-control" id="validationCustom01" aria-describedby="emailHelp" placeholder="Nome do produto">
                                <div class="invalid-feedback">Este campo é obrigatório.</div>
                            </div>
                            <div class="mb-3">
                                <!-- <label for="validationTextarea">Descrição</label>
                                <textarea name="description" class="form-control" rows="14" maxlength="1024" id="validationCustom01" placeholder="Insira a descrição do produto aqui" required></textarea>-->

                                <label for="editor">Descrição do produto</label>
                                <textarea name="description" maxlength="1024" required id="editor" required rows="14">Insira a descrição do produto aqui</textarea>

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
                                <input type="text" id="money" name="price" class="money form-control" aria-describedby="emailHelp" placeholder="Valor do produto">
                                <div class="invalid-feedback">Este campo é obrigatório.</div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Imagens</label>
                                <input type="file" name="imgs[]" method="POST" multiple class="form-control-file" id="exampleFormControlFile1">
                            </div>
                            <div class="form-group">
                                <label for="inputEstado">Categoria</label>
                                <select id="inputEstado" name="category_id" class="form-control" required="required">
                                    <option value="">Selecione</option>
                                    <?php
                                    $sql = "SELECT * FROM categories ORDER BY id ASC;";

                                    $result = mysqli_query($connect, $sql);

                                    while ($product_data = mysqli_fetch_array($result)) {
                                    ?>
                                        <option value="<?php echo ($product_data['id']); ?>"><?php echo ($product_data['name']); ?></option>
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
                                    $sql = "SELECT * FROM brands ORDER BY id ASC;";

                                    $result = mysqli_query($connect, $sql);

                                    while ($brand_data = mysqli_fetch_array($result)) {
                                    ?>
                                        <option value="<?php echo ($brand_data['id']); ?>"><?php echo ($brand_data['name']); ?></option>
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
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                                <div class="invalid-feedback">Este campo é obrigatório.</div>
                            </div>
                            <div class="form-group">
                                <label for="inputEstado">Em promoção</label>
                                <select id="promotion" name="sale" class="form-control" required="required">
                                    <option value="">Selecione</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                                <div id="divid">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Preço Antigo</label>
                                        <input type="text" id="oldMoney" value="0" name="old_price" class="oldMoney form-control" aria-describedby="emailHelp" placeholder="Valor do produto antes da promoção">
                                        <div class="invalid-feedback">Este campo é obrigatório.</div>
                                    </div>
                                </div>
                                <div class="invalid-feedback">Este campo é obrigatório.</div>
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

                    $(document).ready(function() {
                        $("#divid").hide();
                        $('#promotion').on('change', function() {
                            if (this.value == '1') {
                                $("#divid").show();
                            } else {
                                $("#divid").hide();
                            }
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