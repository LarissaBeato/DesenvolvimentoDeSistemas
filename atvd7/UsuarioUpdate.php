<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Usuario</title>
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5 0%, #9face6 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #E0FFFF;
            border: none;
            color: black;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        a {
            width: 100%;
        }
        
        a button {
            width: 100%;
            padding: 10px;
            background-color: #E0FFFF;
            border: none;
            color: black;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        
        button:hover {
            background-color: #000;
            color: #fff;
        }

    </style>
</head>
<body>
    <form action="contatosUpdate.php" method="post">
        <input type="text" name="nomeUsuario" placeholder="nomeUsuario" required>
        <input type="text" name="senha" placeholder="senha" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="login" placeholder="login" required>
        <button type="submit" name="update_contato">Atualizar Usuario</button>
        <a href="AgendaUsuariosSelect.php"><button type="button" name="voltar">Voltar</button></a>

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
 
    echo $sql = "UPDATE Contatos SET nomeUsuario='".$_POST["nomeUsuario"]."',senha='".$_POST["senha"]."',email='".$_POST["email"]."',login='".$_POST["login"]."' WHERE id=".$id.";";
    $executado = $resultado->prepare($sql);
    $executado->execute();

    echo "Contato atualizado com sucesso!";
    exit();
}
?>
