<?php
session_start();
include("database.php");


if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {
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
  <title>Atualizar conta</title>
</head>

<body>
  <?php include("header.php") ?>
  <div class="body">
    <div class="conteudo" class="container">
      <div class="register_form_column">
        <form onSubmit="return checkPassword(this)" class="needs-validation" novalidate action="receiveUpdateRegister.php" method="POST">
          <?php

          $sql = "SELECT * FROM users WHERE id = $_SESSION[id];";
          $result = mysqli_query($connect, $sql);

          while ($account_data = mysqli_fetch_array($result)) {
          ?>

            <div class="internal_form_register">
              <div class="collunm_form_register">
                <div class="form-group">
                  <label for="exampleInputEmail1">Endereço de email</label>
                  <input value="<?php echo ($account_data['email']); ?>" type="email" name="email" required maxlength="55" class="form-control" id="validationCustom01" aria-describedby="emailHelp" placeholder="Seu email">
                  <div class="invalid-feedback">Este campo é obrigatório.</div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Senha</label>
                  <input type="password" name="password" required maxlength="64" class="form-control" id="password" placeholder="Nova senha">
                  <div class="invalid-feedback">Este campo é obrigatório.</div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Confirmar Senha</label>
                  <input type="password" name="confirm_password" required maxlength="64" class="form-control" id="confirm_password" placeholder="Confirmar Senha">
                  <div class="invalid-feedback">Este campo é obrigatório.</div>
                </div>
              </div>
              <div class="collunm_form_register">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="inputText4">Nome</label>
                    <input value="<?php echo ($account_data['first_name']); ?>" type="text" name="first_name" required maxlength="55" class="form-control" id="inputText4" placeholder="Nome">
                    <div class="invalid-feedback">Este campo é obrigatório.</div>
                  </div>
                  <div class="form-group col-md-8">
                    <label for="inputText4">Sobrenome</label>
                    <input value="<?php echo ($account_data['last_name']); ?>" type="text" name="last_name" required maxlength="55" class="form-control" id="inputPassword4" placeholder="Sobrenome">
                    <div class="invalid-feedback">Este campo é obrigatório.</div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-7">
                    <label for="inputText4">CPF</label>
                    <input value="<?php echo ($account_data['cpf']); ?>" type="text" name="cpf" required maxlength="11" class="form-control" id="inputText4" placeholder="CPF">
                    <div class="invalid-feedback">Este campo é obrigatório.</div>
                  </div>
                  <div class="form-group col-md-5">
                    <label for="inputText4">RG</label>
                    <input value="<?php echo ($account_data['rg']); ?>" type="text" name="rg" required maxlength="14" class="form-control" id="inputPassword4" placeholder="RG">
                    <div class="invalid-feedback">Este campo é obrigatório.</div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-9">
                    <label for="inputAddress2">Endereço</label>
                    <input value="<?php echo ($account_data['address']); ?>" type="text" name="address" required maxlength="55" class="form-control" id="inputAddress" placeholder="Nome da Rua">
                    <div class="invalid-feedback">Este campo é obrigatório.</div>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="inputAddress2">Numero</label>
                    <input value="<?php echo ($account_data['address_number']); ?>" type="tel" name="address_number" required maxlength="10" class="form-control" id="inputAddress" placeholder="123...">
                    <div class="invalid-feedback">Este campo é obrigatório.</div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputCity">Cidade</label>
                    <input value="<?php echo ($account_data['city']); ?>" type="text" name="city" required maxlength="55" class="form-control" id="inputCity">
                    <div class="invalid-feedback">Este campo é obrigatório.</div>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="inputEstado">Estado</label>
                    <select id="inputEstado" name="state" class="form-control" required="required">
                      <option value="">Selecione</option>
                      <option value="AC">AC</option>
                      <option value="AL">AL</option>
                      <option value="AP">AP</option>
                      <option value="AM">AM</option>
                      <option value="BA">BA</option>
                      <option value="CE">CE</option>
                      <option value="DF">DF</option>
                      <option value="ES">ES</option>
                      <option value="GO">GO</option>
                      <option value="MA">MA</option>
                      <option value="MS">MS</option>
                      <option value="MT">MT</option>
                      <option value="MG">MG</option>
                      <option value="PA">PA</option>
                      <option value="PB">PB</option>
                      <option value="PR">PR</option>
                      <option value="PE">PE</option>
                      <option value="PI">PI</option>
                      <option value="RJ">RJ</option>
                      <option value="RN">RN</option>
                      <option value="RS">RS</option>
                      <option value="RO">RO</option>
                      <option value="RR">RR</option>
                      <option value="SC">SC</option>
                      <option value="SP">SP</option>
                      <option value="SE">SE</option>
                      <option value="TO">TO</option>
                    </select>
                    <div class="invalid-feedback">Este campo é obrigatório.</div>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="inputCEP" maxlength="55">CEP</label>
                    <input value="<?php echo ($account_data['cep']); ?>" type="text" name="cep" required maxlength="8" class="form-control" id="inputCEP">
                    <div class="invalid-feedback">Este campo é obrigatório.</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form_register_button">
              <button type="submit" class="btn btn-primary">Atualizar Conta</button>
            </div>
          <?php
          }
          ?>
        </form>
        <script>
          function checkPassword(form) {
            password1 = form.password.value;
            password2 = form.confirm_password.value;



            // If Not same return False.     
            if (password1 != password2) {
              alert("\nAs senhas não batem")
              return false;
            }

            // If same return True. 
            else {
              return true;
            }
          }

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