<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
</head>
<body>

    <form action="AgendaUsuariosSelect.php" method="post">
        <table>
            
        <tr>
        <td colspan="2"><button id="botao" type="submit" name="buscar">Procurar</button></td>
        </tr>    
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

        $sql = "SELECT NomeUsuario, senha, email, login, ativo, id FROM Usuario;";
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
            <table>
                    <tr>
                        <td>nomeUsuario</td>
                        <td>senha</td>
                        <td>email</td>
                        <td>login</td>
                        <td>ativo</td>
                        <td>id</td>
                    </tr>';
            while($i < $indice)
            {
            echo '
                
                    <tr>
                        <td>'.$linhas[$i]['nomeusuario'].'</td>
                        <td>'.$linhas[$i]['senha'].'</td>
                        <td>'.$linhas[$i]['email'].'</td>
                        <td>'.$linhas[$i]['login'].'</td>
                        <td>'.$linhas[$i]['ativo'].'</td>  
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