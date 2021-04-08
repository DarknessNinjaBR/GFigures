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
    <title>GFigures categorias</title>
</head>
<body>
    <?php include ("header.php") ?>
    <div class="body">
    <div class="conteudo" class="container">
      <div class="register_form_column">
        <form class="needs-validation" novalidate action="receiveCategory.php" method="POST">
          <div class="internal_form_register">
            <div class="collunm_form_register">
              <div class="form-group">
                <label for="exampleInputEmail1">Nome da Categoria</label>
                <input type="text" name="name" required maxlength="55" class="form-control" id="validationCustom01" aria-describedby="emailHelp" placeholder="Nome da Categoria">
                <div class="invalid-feedback">Este campo é obrigatório.</div>
              </div>
            </div>
          </div>
          <div class="form_register_button">
            <?php
            if (isset($_GET["error"])) {
              if ($_GET['error'] == 1) {
            ?>
                <div class="alert alert-danger" role="alert">
                  <h5>Esta categoria já esta cadastrada.</h5>
                </div>
              <?php
              }
              if ($_GET['error'] == 2) {
              ?>
                <div class="alert alert-danger" role="alert">
                  <h5>Voce não deveria estar vendo essa mensagem 0-0.</h5>
                </div>
            <?php
              }
            }

            ?> <button type="submit" class="btn btn-primary">Cadastrar</button>
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
        </script>
      </div>
    </div>
  </div>
  <footer class="footer">
    Todos os direitos reservados © DNBR
  </footer>
</body>

</html>