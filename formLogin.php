<?php
session_start();
include ("database.php");

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
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
  <title>Login</title>
</head>
<body>
    <?php include ("header.php") ?>
    <div class="body">
    <div class="conteudo" class="container">
    <?php
            if (isset($_GET["carrinho"])) {
            ?>
                <div class="alert alert-primary mt-5" role="alert">
                  <h5>Faça login para comprar produtos!</h5>
                </div>
              <?php
              }
              ?>
      <div class="register_form_column">
        <form onSubmit="return checkPassword(this)" class="needs-validation" novalidate action="receiveLogin.php" method="POST">
          <div class="internal_form_register">
            <div class="collunm_form_register">
              <div class="form-group">
                <label for="exampleInputEmail1">Endereço de email</label>
                <input type="email" name="email" required maxlength="55" class="form-control" id="validationCustom01" aria-describedby="emailHelp" placeholder="Seu email">
                <div class="invalid-feedback">Este campo é obrigatório.</div>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Senha</label>
                <input type="password" name="password" required maxlength="64" class="form-control" id="password" placeholder="Senha">
                <div class="invalid-feedback">Este campo é obrigatório.</div>
              </div>
            </div>
          </div>
          <div class="form_register_button">
            <?php
            if (isset($_GET["error"])) {
              if ($_GET['error'] == 2) {
            ?>
                <div class="alert alert-danger" role="alert">
                  <h5>Senha incorreta.</h5>
                </div>
              <?php
              }
              if ($_GET['error'] == 1) {
              ?>
                <div class="alert alert-danger" role="alert">
                  <h5>Esta conta não existe, <a href="formRegister.php" class="alert-link">Clique aqui para criar sua conta</a>.</h5>
                </div>
            <?php
              }
            }

            ?> <button type="submit" class="btn btn-primary">Entrar</button>
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