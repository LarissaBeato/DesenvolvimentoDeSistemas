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

label {
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
}

input[type="text"],
 {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    transition: border 0.3s;
}

button {
    width: 100%;
    padding: 12px;
    background-color: #E0FFFF;
    border: none;
    border-radius: 5px;
    color: black;
    font-size: 15px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #000;
    color:white;
}

#botao{
    width: 150px;
}

</style>

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
   
    <button type="submit" id="botaoEnviar" name ="Entrar">Enviar</button>

</div>

</form> 

<form action ="AgendaContatosSelect.php" method="post">
    <table>
        <tr>
            <td colspan="2"><button id="botao" type="submit" name="voltar">Voltar</button>
        </tr>
    </table>
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