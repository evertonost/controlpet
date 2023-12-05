<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit();
}

// Obtém o nome do usuário da sessão
$userName = isset($_SESSION['usuario_nome']) ? $_SESSION['usuario_nome'] : "Nome do Usuário Desconhecido";

// Estabeleça a conexão com o banco de dados (altere as configurações conforme necessário)
include("../conexao.php");

// Obtém o ID do usuário da sessão
$usuarioId = $_SESSION['usuario_id'];

// Query para obter a foto do usuário com base no ID armazenado na sessão
$queryFoto = $conn->prepare("SELECT foto_petshop FROM petshops WHERE id_petshop = :id");
$queryFoto->bindValue(":id", $usuarioId);
$queryFoto->execute();

$fotopetshop = ""; // Variável para armazenar a foto do petshop

if ($queryFoto->rowCount() > 0) {
    $rowFoto = $queryFoto->fetch(PDO::FETCH_ASSOC);
    $fotopetshop = $rowFoto['foto_petshop'];
} else {
    // Se a foto do petshop não foi encontrada, pode-se atribuir uma foto padrão ou fazer outra ação adequada
    // Por exemplo, pode-se definir uma foto padrão para o petshop
    $fotopetshop = "caminho/para/foto_padrao_petshop.jpg";
}
?>

<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_funcionario'])) {
    $idFuncionario = $_POST['id_funcionario'];

    // Query para excluir o funcionário com base no ID
    $queryExcluir = $conn->prepare("DELETE FROM funcionarios WHERE id_funcionario = :id AND id_petshop = :usuario_id");
    $queryExcluir->bindValue(":id", $idFuncionario);
    $queryExcluir->bindValue(":usuario_id", $usuarioId);

    if ($queryExcluir->execute()) {
        // Funcionário excluído com sucesso, você pode redirecionar ou realizar outras ações necessárias
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Erro ao excluir o funcionário.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/indexpetshop.css">
    <title>ControlPet - petshop</title>
    <style>
    .funcionarios-list {
        list-style-type: none; /* Remove as bolinhas da lista */
        padding: 0; /* Remove o preenchimento padrão da lista */
    }

    .funcionarios-list li {
        margin-bottom: 10px; /* Adapte o espaçamento vertical conforme necessário */
    }

    hr {
        margin: 5px 0; /* Adapte o espaçamento vertical conforme necessário */
        border: none;
        border-top: 1px solid #ccc; /* Cor e estilo da linha horizontal */
    }
    
    /* Adicione este bloco de estilo */
    .agendamentos-container {
        margin-top:800px ;
        margin-bottom:100px;
      display: flex;
      flex-direction: column; /* Alinha os itens verticalmente */
    }

    /* Adicione este bloco de estilo */
    .agendamento {
      border: 1px solid #000; /* Cor e largura da borda */
      padding: 10px; /* Espaçamento interno ao redor do bloco */
      margin-bottom: 10px; /* Espaçamento entre os blocos */
    }

    /* Remova a margem e o espaçamento da tag <p> dentro do bloco .agendamento */
    .agendamento p {
      margin: 0;
      padding: 0;
      color: #EAE2B7;
      font-size: 20pt;
      text-align: start;
    }

    .servicos {
        background-color: var(--sobrepor);
        width: 40%;
        float: left;
        height: auto;
        min-height: 399px;
        overflow-y: auto;
        max-height: 399px;
        border-radius: 20px;
        margin-right: 20px;
        max-height: 400px; 
        


    }

    .meuspets {
        background-color: var(--sobrepor);
        width: 40%;
        float: right;
        height: auto;
        min-height: 399px;
        overflow-y: auto;
        max-height: 399px;
        border-radius: 20px;
        margin-right: 20px;
        max-height: 400px; 
        
        
    }

    .funcionarios-list ul {
    padding: 10px; /* Adicione margem interna ao ul */
}

.funcionarios-list li {
    margin-bottom: 10px;
    margin-top: 10px; /* Adicione margem superior ao li */
}
  

</style>
</head>
<body>
    <div class="fundo">
        <div class="perfil">
            <div class="ajustarfotonaesquerda">
                <img src="<?php echo $fotopetshop; ?>" alt="foto de perfil" class="fotodeperfil">
                <div class="ajustebotoes">
                    <a href="detalhesperfil_petshop.php">
                        <button class="mais">Detalhes</button>
                    </a>
                    <a href="logout.php">
                        <button class="sair">Sair</button>
                    </a>
                </div>
            </div>
            <h2>Bem-vindo <?php echo $userName; ?></h2>
            <div class="botoesdomenu">
                <div class="ajustarbotoesdadireita">
                    <a href="./cadastrarfuncionario/cadastrarfuncionario.php">
                        <button class="mais">Cadastrar funcionário</button>
                    </a>
                    <!-- <button class="mais">Ver serviços</button> -->
                </div>
            </div>
        </div>
        <div class="servicos">
        <div class="agendamentos-container">
        <?php
            $queryAgendamentos = $conn->prepare("SELECT * FROM agendamentos WHERE  petshop = :petshop");
            $queryAgendamentos->bindValue(":petshop", $userName);
            $queryAgendamentos->execute();

            if ($queryAgendamentos->rowCount() > 0) {
                while ($rowAgendamento = $queryAgendamentos->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='agendamento'>";
                    echo "<h2>Serviço Agendado</h2>";
                    echo "<p><strong>Pet:</strong> {$rowAgendamento['pet']}</p>";
                    echo "<p><strong>Serviço:</strong> {$rowAgendamento['servico']}</p>";
                    echo "<p><strong>Petshop:</strong> {$rowAgendamento['petshop']}</p>";
                    echo "<p><strong>Funcionário:</strong> {$rowAgendamento['funcionario']}</p>";
                    // Adicionar botão para aceitar
                    echo "<form method='POST' action='aceitar_agendamento.php'>";
                    echo "<input type='hidden' name='id_servicos' value='{$rowAgendamento['id_servicos']}'>";
                    echo "<button class ='mais'type='submit'>Aceitar</button>";
                    echo "</form>";

                    echo "<form method='POST' action='finalizar_agendamento.php'>";
                    echo "<input type='hidden' name='id_servicos' value='{$rowAgendamento['id_servicos']}'>";
                    echo "<button class ='mais' type='submit'>finalizar</button>";
                    echo "</form>";
        
                    echo "</div>";
                }
            } else {
                echo "<h2>Não há serviços agendados.</h2>";
            }
            ?>
            </div>
        </div>
        <div class="meuspets">
        <div class="imagenzinha">
    <?php
    $queryFuncionarios = $conn->prepare("SELECT id_funcionario, func_nome, foto FROM funcionarios WHERE id_petshop = :id");
    $queryFuncionarios->bindValue(":id", $usuarioId);
    $queryFuncionarios->execute();

    if ($queryFuncionarios->rowCount() > 0) {
        while ($rowFuncionario = $queryFuncionarios->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='funcionario'>";
            echo "<h2>{$rowFuncionario['func_nome']}</h2>";

            // Utilizando o caminho absoluto para a imagem do funcionário
            $caminhoImagemFuncionario = "http://localhost/teste/petshop/cadastrarfuncionario/" . $rowFuncionario['foto'];

            // Exibindo a imagem se ela existir
            if (@getimagesize($caminhoImagemFuncionario)) {
                echo "<img src='$caminhoImagemFuncionario' alt='Foto do Funcionário' width='300' class='imagenzinha' style='border-radius: 20px;'>";
            } else {
                echo "<p>Imagem não encontrada.</p>";
            }

            // Formulário para excluir o funcionário
            echo "<form method='POST' action=''>";
            echo "<input type='hidden' name='id_funcionario' value='{$rowFuncionario['id_funcionario']}'>"; // Correção aqui
            echo "<button class='sair' type='submit'>Excluir Funcionario</button>";
            echo "</form>";

            // Formulário para consultar o pet
            //echo "<form method='GET' action='pagina_detalhes_pet.php'>";
            //echo "<input type='hidden' name='id_funcionario' value='{$rowFuncionario['id_funcionario']}'>"; // Correção aqui
            //echo "<button class='sair' type='submit'>Consultar funcionario</button>";
            echo "</form>";

            echo "</div>";
            echo '<hr>';
        }
    } else {
        echo "<h2>Ainda não possui funcionários cadastrados.</h2>";
    }
    ?>
</div>
</div>



</body>
</html>
