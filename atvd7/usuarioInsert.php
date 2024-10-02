<html>

<body>

<form method="post" action="usuarioInsert.php">
    <label for="NomeUsuario">NomeUsuario:</label><br>
    <input type="text" id="NomeUsuario" name="NomeUsuario" required ><br>
    <label for="senha">Senha:</label><br>
    <input type="password" id="senha" name="senha" required><br>
    <label for="email">email:</label><br>
    <input type="text" id="email" name="email" required><br>
    <label for="login">Login:</label><br>
    <input type="text" id="login" name="login" required><br>

    <button type="submit" name ="Entrar" target = "_blank" >Enviar</button>

</form>

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

    $senhacriptografado1 = md5($_POST["senha"]);
    $logincriptografado1 = md5($_POST["login"]);


    $sql = "insert into Usuario (NomeUsuario,senha,email,login,ativo) values ('".$_POST["NomeUsuario"]."','".$senhacriptografado1."','".$_POST["email"]."','".$logincriptografado1."',TRUE);";

    $query = $resultado->prepare($sql);
    $indice = 0;
    if($query->execute())
    {
        echo '
        <script>

        window.location.href="contatosInsert.php";
        </script>';
    }
    else{

        echo "erro ao cadastrar";
    }
}
unset($_POST["Entrar"],$_POST["NomeUsuario"],$_POST["senha"],$_POST["email"],$_POST["login"],$_POST["ativo"]);

?>
