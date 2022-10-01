<?php
include ("database.php");
session_start();

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
    <title>Minha conta</title>
</head>
<body>
    <?php include ("header.php") ?>
    <div class="body">
        <div class="content">
            <a href="orders.php" class="btn btn-primary btn-lg">Meu Pedidos</a>
            <a href="formUpdateAccount.php" class="btn btn-primary btn-lg">Atualizar meus dados</a>
            <button type="button" class="btn btn-primary btn-lg confirm" role="button" data-toggle="popover" data-trigger="focus" data-content="Você tem CERTEZA de quer quer EXCLUIR sua conta? Isso não poderá ser desfeito.   <a href='deleteAccount.php' class='btn-sm btn-danger'>EXCLUIR</a>">  Excluir conta
</button>
        </div>
    <div class="account_info">
        <div>
            <?php
                $sql = "SELECT * FROM users WHERE id = $_SESSION[id];";

                $result = mysqli_query($connect, $sql);

                while ($account_data = mysqli_fetch_array($result)) {
            ?>
            <ul class="list-group">
                <li class="list-group-item list-group-item-dark black">Meus dados:</li>
                <li class="list-group-item">Nome Completo: <?php echo($account_data['first_name']." ".$account_data['last_name']);  ?></li>
                <li class="list-group-item">Email: <?php echo($account_data['email']); ?></li>
                <li class="list-group-item">CPF: <?php echo($account_data['cpf']); ?></li>
                <li class="list-group-item">RG: <?php echo($account_data['rg']); ?></li>
                <li class="list-group-item">Endereço: <?php echo($account_data['address']); ?></li>
                <li class="list-group-item">Número: <?php echo($account_data['address_number']); ?></li>
                <li class="list-group-item">Estado: <?php echo($account_data['state']); ?></li>
                <li class="list-group-item">Cidade: <?php echo($account_data['city']); ?></li>
                <li class="list-group-item">CEP: <?php echo($account_data['cep']); ?></li>
            </ul>
        </div>
        <?php
                }
            ?>
    </div>
    </div>
    <footer class="footer">
        Todos os direitos reservados © DNBR
    </footer>
</body>
<script>
$("[data-toggle=popover]")
.popover({html:true})

    $(function () {
    $('[data-toggle="popover"]').popover()
    })
    $('.popover-dismiss').popover({
  trigger: 'focus'
})
</script>

</html>