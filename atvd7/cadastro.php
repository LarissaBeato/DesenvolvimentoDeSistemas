<html>
<style>

#d1{
    position:absolute;
    top: 50%;
    left: 50%;
    border-radius:50%;
}

</style>

<body>

<form method="post" action="cadastro.php">
    <div id=d1>
    <label for="name">Nome de Usuario:</label><br>
    <input type="text" id="name" name="name" required ><br>
    <label for="password">Senha:</label><br>
    <input type="password" id="password" name="password" required><br>
    <label for="email">email:</label><br>
    <input type="text" id="email" name="email" required><br>
   
    <button type="submit" name ="Entrar">Entrar</button>
</div>

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

    $usuariocriptografado = md5($_POST["name"]);
    $senhacriptografado1 = md5($_POST["password"]);


    $sql = "insert into Users (usuario,password,email) values ('".$usuariocriptografado"','".$senhacriptografado1"','".$_POST["email"]."');";

    $query = $resultado->prepare($sql);
    $indice = 0;
    if($query->execute())
    {
        echo " usuario cadastrado";
    }
    else{

        echo "erro ao cadastrar";
    }
}

?>