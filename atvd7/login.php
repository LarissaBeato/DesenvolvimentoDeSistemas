<?php
    session_name('iniciar');
    session_start();
?>

<html>

<body>
<form method="post" action="login.php">
    <label for="name">Nome:</label><br>
    <input type="name" id="name" name="name" required ><br>
    <label for="password">Senha:</label><br>
    <input type="password" id="password" name="password" required>
   
    <button type="submit" name ="Entrar">Entrar</button>

</form> 

</body>
</html>

<?php
    extract($_POST);

    if(isset($_POST["Entrar"]))
    {
        include_once("conect.php");
        $obj = new conect();
        $resultado = $obj->conectarBanco();
        

        $sql = "SELECT nomeUsuario, senha FROM Usuario WHERE nomeUsuario = '".$_POST["name"]."' AND senha = '".md5($_POST["password"])."';";
        $query = $resultado->prepare($sql);
        
        $indice = 0;
        
        if($query->execute())
        {
            while($linha = $query->fetch(PDO::FETCH_ASSOC))
            {
                $linhas[$indice] = $linha;
                $indice++;
            }
            if($indice == 1)
            {
                $_SESSION["cadastro"] = TRUE;
                header("location: AgendaContatosSelect.php");
            }
            else
            {
                echo "Usuário e senha não existem, verifique!";
            }
        }
    }

    unset($sql,$query);
?>

