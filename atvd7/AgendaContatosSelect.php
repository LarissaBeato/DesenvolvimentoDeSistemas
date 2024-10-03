<?php
    session_name('iniciar');
    session_start();

    if($_SESSION['cadastro']==FALSE)
    {
        session_destroy();
        header("location: login.php");
    }

   ?> 

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <style>
    
    body {
    background: linear-gradient(135deg, #74ebd5 0%, #9face6 100%);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.tabela {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.tabela th, .tabela td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.tabela th {
    background-color: #4CAF50;
    color: white;
}

.tabela tr:nth-child(even) {
    background-color: #f2f2f2;
}

.tabela tr:hover {
    background-color: #ddd;
}

#botao{
    width: 90px ;
    height: 40px;

}

#botao:hover{
    color: black;

}
    
        </style>
</head>
<body>

    <form action="AgendaContatosSelect.php" method="post">
        <table>

        <form action ="AgendaContatosSelect.php" method="post">
            <table>
                <tr>
                    <td colspan="2"><button id="botao" type="submit" name="buscar">Procurar</button>
                </tr>
            </table>
        </form>
        
        <form action ="contatosInsert.php" method="post">
            <table>
                <tr>
                    <td colspan="2"><button id="botao" name="Cadastrar">Cadastro</button>
                </tr>
            </table>
        </form>  
        
    </table>
        
    </form>
</body>
</html>

<?php

    extract ($_POST);
    
    if(isset($_POST["buscar"]))
    {
        include_once("conect.php");
        $obj = new conect();
        $resultado = $obj->conectarBanco();

        $sql = "SELECT Nome, endereco, telefone, email, celular, id FROM Contatos;";
        $indice = 0;

        $executado = $resultado->prepare($sql);

        if($executado->execute())
        {
            while($linha = $executado->fetch(PDO::FETCH_ASSOC))
            {
                $linhas[$indice] = $linha;
                $indice++;
            }

            $i = 0;
            echo '
            <table class="tabela">
                    <tr>
                        <td>Nome</td>
                        <td>Endereco</td>
                        <td>Telefone</td>
                        <td>Email</td>
                        <td>Celular</td>
                        <td>id</td>
                    </tr>';
            while($i < $indice)
            {
            echo '
                
                    <tr>
                        <td>'.$linhas[$i]['nome'].'</td>
                        <td>'.$linhas[$i]['endereco'].'</td>
                        <td>'.$linhas[$i]['telefone'].'</td>
                        <td>'.$linhas[$i]['email'].'</td>
                        <td>'.$linhas[$i]['celular'].'</td> 
                        <td>'.$linhas[$i]['id'].'</td> 
                           
                    </tr>
            ';
            $i++;
            }
            echo '</table>';
        }
        else
        {
            echo "Deu errado";
        }
    }
?>