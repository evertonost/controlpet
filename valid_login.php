<?php
session_start(); // Iniciar a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("conexao.php");

    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $consultaClientes = $conn->prepare("SELECT * FROM clientes WHERE cpf = :login AND senha = :senha");
    $consultaClientes->bindValue(":login", $login);
    $consultaClientes->bindValue(":senha", $senha);
    $consultaClientes->execute();

    $consultaPetshops = $conn->prepare("SELECT * FROM petshops WHERE cnpj_petshop = :login AND senha_petshop = :senha");
    $consultaPetshops->bindValue(":login", $login);
    $consultaPetshops->bindValue(":senha", $senha);
    $consultaPetshops->execute();

    // Verificar se o usuário foi encontrado em uma das tabelas
    if ($consultaClientes->rowCount() > 0) {
        // Cliente encontrado
        $usuario = $consultaClientes->fetch(); // Obter informações do cliente
        $_SESSION['usuario_id'] = $usuario['id_cliente']; // Armazenar ID do usuário na sessão
        $_SESSION['usuario_nome'] = $usuario['nome']; // Armazenar nome do usuário na sessão
        header("Location: cliente/indexcliente.php");
        exit();
    } elseif ($consultaPetshops->rowCount() > 0) {
        // Petshop encontrado
        $usuario = $consultaPetshops->fetch(); // Obter informações do petshop
        $_SESSION['usuario_id'] = $usuario['id_petshop']; // Armazenar ID do petshop na sessão
        $_SESSION['usuario_nome'] = $usuario['nome_petshop']; // Armazenar nome do petshop na sessão
        header("Location: petshop/indexpetshop.php");
        exit();
        
    } else {
        // Usuário não encontrado, redirecionar para página de login com erro
        header("Location: login.php?erro=1");
        exit();
    }
} else {
    // Se o formulário não foi enviado corretamente, redirecionar para a página de login
    header("Location: login.php");
    exit();
}
?>
