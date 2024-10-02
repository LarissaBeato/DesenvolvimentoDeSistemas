<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Contato</title>
</head>
<body>
    <h1>Atualizar Contato</h1>
    <form action="contatosUpdate.php" method="post">
        <input type="text" name="nomeUsuario" placeholder="nomeUsuario" required>
        <input type="text" name="senha" placeholder="senha" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="login" placeholder="login" required>
        <input type="text" name= "id" placeholder="id" required>
        <button type="submit" name="update_contato">Atualizar Contato</button>
    </form>
</body>
</html>

<?php


    include_once("conect.php");
    $obj = new conect();
    $resultado = $obj->conectarBanco();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_contato'])) {

    $id = $_POST['id'];
    $nomeUsuario = $_POST['nomeUsuario'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $login = $_POST['login'];
 
    echo $sql = "UPDATE Contatos SET nomeUsuario='".$_POST["nomeUsuario"]."',senha='".$_POST["senha"]."',email='".$_POST["email"]."',login='".$_POST["login"]."'where id=".$id.";";
    $executado = $resultado->prepare($sql);
    $executado->execute();

    echo "Contato atualizado com sucesso!";
    exit();
}
?>
