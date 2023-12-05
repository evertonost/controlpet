<?php
include("conexao.php");
session_start();

// Função para redirecionamento
function redirect($url) {
    echo '<script>
            setTimeout(function(){
                window.location.href = "' . $url . '";
            }, 2000);
          </script>';
}

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (
            isset($_POST['pet_nome'], $_POST['tipo_pet'], $_POST['raca'], $_POST['genero'], $_POST['comportamento'], $_POST['obs'], $_POST['id_cliente'])
        ) {
            $pet_nome = $_POST['pet_nome'];
            $tipo_pet = $_POST['tipo_pet'];
            $raca = $_POST['raca'];
            $genero = $_POST['genero'];
            $comportamento = $_POST['comportamento'];
            $obs = $_POST['obs'];
            $id_cliente = $_POST['id_cliente'];
            
            $foto_pet = $_FILES['photo'];

            if (!empty($_FILES["photo"]["name"])) {
                $foto_nome = $_FILES["photo"]["name"];
                $foto_temp = $_FILES["photo"]["tmp_name"];
                $foto_destino = "Imagens/imagens_pet/" . $foto_nome;
      
                // Move a imagem para a pasta fotos_upload
                if (move_uploaded_file($foto_temp, $foto_destino)) {
                    // Prepara a inserção no banco de dados apenas com o caminho da foto
                    // ...

                    // Verificar se o id_cliente existe na tabela clientes
                    $sql = "SELECT id_cliente FROM clientes WHERE id_cliente = '" . $id_cliente . "'";
                    $result = $conn->query($sql);

                    if ($stmt->rowCount() > 0) {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Sucesso!</strong> Pet cadastrado com sucesso.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                        
                        // Adicionando um script JavaScript para redirecionamento após 2 segundos
                        echo '<script>
                                setTimeout(function(){
                                    window.location.href = "cadastropet.php";
                                }, 2000);
                            </script>';
                    
                    } else {
                        echo "ID de cliente inválido. Certifique-se de que o cliente exista na tabela clientes.";
                    }
                } else {
                    echo "Erro ao mover o arquivo para o destino.";
                }
            } else {
                echo "O arquivo não foi enviado.";
            }
        } else {
            echo "Variáveis do formulário não estão definidas corretamente.";
        }
    }

    // Fechar a conexão com o banco de dados
    $conn = null;
} catch(PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
