<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Contato</title>
</head>
<body>
    <h1>Atualizar Contato</h1>
    <form action="contatosUpdate.php" method="post">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="text" name="endereco" placeholder="Endereço" required>
        <input type="text" name="telefone" placeholder="Telefone" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="celular" placeholder="Celular" required>
        <input type="text" name= "id" placeholder="id" required>
        <button type="submit" name="update_contato">Atualizar Contato</button>
    </form>
</body>
</html>

<?php

    include_once("conect.php");
    $obj = new conect();
    $resultado = $obj->conectarBanco();

    extract ($_POST);

if (isset($_POST['update_contato'])) {

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];
 
    $sql = "UPDATE Contatos SET nome='".$nome."',endereco='".$endereco."',telefone='".$telefone."',email='".$email."',celular='".$celular."' where id=".$id.";";
    $executado = $resultado->prepare($sql);
    $executado->execute();

    echo "Contato atualizado com sucesso!";
    exit();
}
?>
