<html>

<body>

<form method="post" action="contatosInsert.php">
    <div id=d1>
    <label for="name">Nome:</label><br>
    <input type="text" id="name" name="name" required ><br>
    <label for="endereco">Endereço:</label><br>
    <input type="text" id="endereco" name="endereco" required><br>
    <label for="email">email:</label><br>
    <input type="text" id="email" name="email" required><br>
    <label for="telefone">Telefone:</label><br>
    <input type="text" id="telefone" name="telefone" required><br>
    <label for="celular">Celular:</label><br>
    <input type="text" id="celular" name="celular" required><br>
   
    <button type="submit" name ="Entrar">Enviar</button>


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

    $sql = "insert into Contatos (nome,endereco,email,telefone,celular) values ('".$_POST["name"]."','".$_POST["endereco"]."','".$_POST["email"]."','".$_POST["telefone"]."','".$_POST["celular"]."');";

    $query = $resultado->prepare($sql);
    $indice = 0;
    if($query->execute())
    {
        echo "cadastrado com sucesso";
    }
    else{

        echo "erro ao cadastrar";
    }
}

    unset($_POST["Entrar"],$_POST["nome"],$_POST["endereco"],$_POST["email"],$_POST["telefone"],$_POST["celular"]);


?>