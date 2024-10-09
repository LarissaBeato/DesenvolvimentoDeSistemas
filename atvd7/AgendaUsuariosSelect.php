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

    <form action="AgendaUsuariosSelect.php" method="post">
        <table>
            <tr>
                <td colspan="2"><button id="botao" type="submit" name="buscar">Procurar</button></td>
            </tr>
        </table>
    </form>

    <form action="usuarioInsert.php" method="post">
        <table>
            <tr>
                <td colspan="2"><button id="botao" type="submit" name="cadastrar">Cadastrar</button></td>
            </tr>
        </table>
    </form>

    <form action="login.php" method="post">
        <table>
            <tr>
                <td colspan="2"><button id="botao" type="submit" name="sair">Sair</button></td>
            </tr>
        </table>
    </form>



    <?php
    extract($_POST);

    if (isset($_POST["buscar"])) {
        include_once("conect.php");
        $obj = new conect();
        $resultado = $obj->conectarBanco();

        $sql = "SELECT nomeusuario, senha, email, login, ativo, id FROM Usuario;";
        $indice = 0;

        $executado = $resultado->prepare($sql);

        if ($executado->execute()) {
            $linhas = array();
            while ($linha = $executado->fetch(PDO::FETCH_ASSOC)) {
                $linhas[$indice] = $linha;
                $indice++;
            }

            echo '
            <table>
                <tr>
                    <th>NomeUsuario</th>
                    <th>Senha</th>
                    <th>Email</th>
                    <th>Login</th>
                    <th>Ativo</th>
                    <th>Id</th>
                    <th>Ações</th>
                </tr>';
            
            for ($i = 0; $i < $indice; $i++) {
                echo '
                <tr>
                    <td>'.$linhas[$i]['nomeusuario'].'</td>
                    <td>'.$linhas[$i]['senha'].'</td>
                    <td>'.$linhas[$i]['email'].'</td>
                    <td>'.$linhas[$i]['login'].'</td>
                    <td>'.$linhas[$i]['ativo'].'</td>
                    <td>'.$linhas[$i]['id'].'</td>
                    <td>
                        <a href="UsuarioUpdate.php?id='.$linhas[$i]['id'].'"><button type="button">Atualizar</button></a>
                        <form action="usuarioDelete.php" method="post" style="display:inline;">
                            <input type="hidden" name="deletar_id" value="'.$linhas[$i]['id'].'">
                            <button type="submit" onclick="return confirm(\'Tem certeza que deseja deletar este usuário?\');">Deletar</button>
                        </form>
                    </td>
                </tr>';
            }
            echo '</table>';
        } else {
            echo "Erro ao carregar os usuários.";
        }
    }

    if (isset($_POST['deletar_id'])) {
        include_once("conect.php");
        $obj = new conect();
        $resultado = $obj->conectarBanco();

        $deletar_id = $_POST['deletar_id'];
        $sql_delete = "DELETE FROM Usuario WHERE id = :id";
        $stmt = $resultado->prepare($sql_delete);
        $stmt->bindParam(':id', $deletar_id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "Usuário deletado com sucesso.";
        } else {
            echo "Erro ao deletar o usuário.";
        }
    }
    ?>
</body>
</html>
