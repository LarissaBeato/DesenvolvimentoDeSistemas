<?php
session_name('iniciar');
session_start();
?> 

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #74ebd5, #acb6e5);
            margin: 0;
            padding: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff; 
            border-radius: 5px; 
            overflow: hidden; 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #E0FFFF;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        button {
            background-color: #E0FFFF;
            color: black;
            border: none;
            padding: 10px 15px;
            border-radius: 5px; 
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: black;
            color: #fff;
        }

        a {
            text-decoration: none;
        }

        #botao {
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <form action="AgendaContatosSelect.php" method="post">
        <table>
            <tr>
                <td colspan="2"><button id="botao" type="submit" name="buscar">Procurar</button></td>
            </tr>
        </table>
    </form>
        
    <form action="contatosInsert.php" method="post">
        <table>
            <tr>
                <td colspan="2"><button id="botao" name="Cadastrar">Cadastro</button></td>
            </tr>
        </table>
    </form>
        
    <form action="AgendaContatosSelect.php" method="post">
        <table>
            <tr>
                <td colspan="2"><button id="botao" type="submit" name="voltar">Voltar</button></td>
            </tr>
        </table>
    </form>

    <table>
        <tr>
            <td colspan="2"><a href="login.php"><button id="botao" type="button" name="sair">Sair</button></a></td>
        </tr>
    </table>

    <form action="" method="post">
    <?php
    extract($_POST);
    if (isset($_POST["buscar"])) {
        include_once("conect.php");
        $obj = new conect();
        $resultado = $obj->conectarBanco();

        $sql = "SELECT nome, endereco, telefone, email, celular, id FROM Contatos;";
        $executado = $resultado->prepare($sql);

        if ($executado->execute()) {
            echo '
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Endereco</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Celular</th>
                    <th>id</th>
                    <th>Ações</th>
                </tr>';
            
            while ($linha = $executado->fetch(PDO::FETCH_ASSOC)) {
                echo '
                <tr>
                    <td>'.$linha['nome'].'</td>
                    <td>'.$linha['endereco'].'</td>
                    <td>'.$linha['telefone'].'</td>
                    <td>'.$linha['email'].'</td>
                    <td>'.$linha['celular'].'</td>
                    <td>'.$linha['id'].'</td>
                    <td>
                        <a href="ContatosUpdate.php?id='.$linha['id'].'"><button type="button">Atualizar</button></a>
                        <form action="contatosAgendaDelete.php" method="post" style="display:inline;">
                            <input type="hidden" name="deletar_id" value="'.$linha['id'].'">
                            <button type="submit" onclick="return confirm(\'Tem certeza que deseja deletar este contato?\');">Deletar</button>
                        </form>
                    </td>
                </tr>';
            }
            echo '</table>';
        } else {
            echo "Erro ao carregar os contatos.";
        }
    }

    if (isset($_POST['deletar_id'])) {
        include_once("conect.php");
        $obj = new conect();
        $resultado = $obj->conectarBanco();

        $deletar_id = $_POST['deletar_id'];
        $sql_delete = "DELETE FROM Contatos WHERE id = :id";
        $stmt = $resultado->prepare($sql_delete);
        $stmt->bindParam(':id', $deletar_id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "Contato deletado com sucesso.";
        } else {
            echo "Erro ao deletar o contato.";
        }
    }
    ?>
    </form>

</body>
</html>
