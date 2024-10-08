<?php
    session_name('iniciar');
    session_start();
?>

<html>
    
<style>
body {
    background: linear-gradient(135deg, #74ebd5 0%, #9face6 100%);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    width: 350px;
    text-align: center;
}

.input-group {
    margin-bottom: 20px;
    text-align: left;
}

label {
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

button {
    width: 100%;
    padding: 12px;
    background-color: #E0FFFF;
    border: none;
    border-radius: 5px;
    color: black;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s;
    
}

button:hover {
    background-color: #000;
    color: white;
}
</style>

<body>
<form method="post" action="login.php">

    <div class="container">
        <div class="input-group">
            <label for="name">Nome:</label><br>
            <input type="text" id="name" name="name" required><br>
        </div>

        <div class="input-group">
            <label for="password">Senha:</label><br>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" name="Entrar">Entrar</button>
        <button id="botao" type="button" onclick="window.location.href='usuarioInsert.php'">Cadastrar</button>
    </div>

</form> 

</body>
</html>

<?php
    extract($_POST);

    if (isset($_POST["Entrar"])) {
        include_once("conect.php");
        $obj = new conect();
        $resultado = $obj->conectarBanco();
        
        $sql = "SELECT nomeUsuario, senha FROM Usuario WHERE nomeUsuario = '".$_POST["name"]."' AND senha = '".md5($_POST["password"])."';";
        $query = $resultado->prepare($sql);
        
        $indice = 0;
        
        if ($query->execute()) {
            while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
                $linhas[$indice] = $linha;
                $indice++;
            }
            if ($indice == 1) {
                $_SESSION["cadastro"] = TRUE;
                header("location: AgendaContatosSelect.php");
            } else {
                echo "Usuário e senha não existem, verifique!";
            }
        }
    }

    unset($sql, $query);
?>
