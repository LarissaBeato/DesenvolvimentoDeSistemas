<?php
    session_name('iniciar');
    session_start();
?>

<html>
<head>
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5 0%, #9face6 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
            font-size: 14px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #74ebd5;
            outline: none;
        }

        button {
            width: 100%;
            padding: 15px;
            background-color: #74ebd5;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }

        button:hover {
            background-color: black;
        }

        .botao2:hover {
            background-color:black;
            color:white;
        }

    </style>
</head>

<body>

<div class="container">
    <form method="post" action="usuarioInsert.php">
        <div class="input-group">
            <label for="NomeUsuario">Nome de Usuário:</label>
            <input type="text" id="NomeUsuario" name="NomeUsuario" required>
        </div>

        <div class="input-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </div>

        <div class="input-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
        </div>

        <div class="input-group">
            <label for="login">Login:</label>
            <input type="text" id="login" name="login" required>
        </div>

        <button type="submit" name="enviar">Enviar</button>
        <div style="margin-top: 15px;">
            <a href="login.php"><button type="button" class="botao2" >Voltar para Login</button></a>
        </div>
    </form>
</div>

</body>
</html>

<?php

extract($_POST);

if (isset($_POST["enviar"])) {
    include_once("conect.php");
    $obj = new conect();
    $resultado = $obj->conectarBanco();

    $senhacriptografado1 = md5($_POST["senha"]);
    $logincriptografado1 = md5($_POST["login"]);

    $sql = "INSERT INTO Usuario (NomeUsuario, senha, email, login, ativo) VALUES ('".$_POST["NomeUsuario"]."', '".$senhacriptografado1."', '".$_POST["email"]."', '".$logincriptografado1."', TRUE);";

    $query = $resultado->prepare($sql);
    if ($query->execute()) {
        echo '<script>window.location.href="contatosInsert.php";</script>';
    } else {
        echo "Erro ao cadastrar";
    }
}
unset($_POST["enviar"], $_POST["NomeUsuario"], $_POST["senha"], $_POST["email"], $_POST["login"]);
?>
