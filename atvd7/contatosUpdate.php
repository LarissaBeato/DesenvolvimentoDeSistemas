<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Contato</title>
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5 0%, #9face6 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
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

        button:hover {
            background-color: #000;
            color: #fff;
        }

        a {
            text-decoration: none;
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

        a button:hover {
            background-color: #000;
            color: #fff;
        }
    </style>
</head>
<body>
    <form action="contatosUpdate.php" method="post">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="text" name="endereco" placeholder="Endereço" required>
        <input type="text" name="telefone" placeholder="Telefone" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="celular" placeholder="Celular" required>
        <input type="text" name="id" placeholder="ID" required>
        <a href="AgendaContatosSelect.php"><button type="submit" name="update_contato">Atualizar Contato</button></a>
        <a href="AgendaContatosSelect.php"><button type="button" name="voltar">Voltar</button></a>
    </form>
</body>
</html>
<?php
include_once("conect.php");

$obj = new conect();
$resultado = $obj->conectarBanco();

if (isset($_POST['update_contato'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];

    $sql = "UPDATE Contatos SET nome=:nome, endereco=:endereco, telefone=:telefone, email=:email, celular=:celular WHERE id=:id";
    $executado = $resultado->prepare($sql);

    $executado->bindParam(':nome', $nome);
    $executado->bindParam(':endereco', $endereco);
    $executado->bindParam(':telefone', $telefone);
    $executado->bindParam(':email', $email);
    $executado->bindParam(':celular', $celular);
    $executado->bindParam(':id', $id);

    if ($executado->execute()) {
        echo "<script>alert('Contato atualizado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao atualizar contato.');</script>";
    }
}
?>
