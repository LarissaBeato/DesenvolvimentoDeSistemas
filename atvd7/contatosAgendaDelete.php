<?php
session_name('iniciar');
session_start();

if ($_SESSION['cadastro'] == FALSE) {
    session_destroy();
    header("location: login.php");
    exit();
}

include_once("conect.php"); 

$obj = new conect();
$resultado = $obj->conectarBanco();

if (isset($_POST['deletar_id'])) {
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

header("location: AgendaContatosSelect.php");
exit();
?>

</body>
</html>