<?php 

include ("../conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_servicos'])) {
    $id_servicos = $_POST['id_servicos'];

    // Atualize o status para 2
    $queryAtualizarStatus = $conn->prepare("UPDATE agendamentos SET status = 2 WHERE id_servicos = :id_servicos");
    $queryAtualizarStatus->bindValue(":id_servicos", $id_servicos, PDO::PARAM_INT);
    $queryAtualizarStatus->execute();

    // Aqui você pode adicionar mais lógica ou redirecionar para outra página, se necessário
    header("Location: indexpetshop.php");
    exit(); // É uma boa prática adicionar exit() após o redirecionamento
}
?>