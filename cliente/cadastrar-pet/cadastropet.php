<?php
include("conexao.php");

session_start();


// Verificar se a sessão está iniciada
if (!isset($_SESSION['usuario_id'])) {
    // Redirecionar para a página de login
    header("Location: ../../login.php");
    exit(); // Certificar-se de que o script é encerrado após o redirecionamento
}



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
                $foto_nome = uniqid() . '_' . $_FILES["photo"]["name"];
                $foto_temp = $_FILES["photo"]["tmp_name"];
                $foto_destino = "./imagens_pet/" . $foto_nome;
      
                // Move a imagem para a pasta fotos_upload
                if (move_uploaded_file($foto_temp, $foto_destino)) {
                    // Prepara e executa a inserção no banco de dados
                    $stmt = $conn->prepare("INSERT INTO pets (id_cliente, nome, tipo_pet, raca, genero, comportamento, obs, foto_pet, status_pet) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1)");
                    
                    $stmt->execute([$id_cliente, $pet_nome, $tipo_pet, $raca, $genero, $comportamento, $obs, $foto_destino]);

                    // Verificar se a inserção foi bem-sucedida
                    if ($stmt->rowCount() > 0) {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Pet cadastrado com sucesso.</strong>
                              </div>';
                        // Redirecionamento após 2 segundos
                        redirect("../indexcliente.php");
                    } else {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Erro ao inserir o pet no banco de dados. Por favor, tente novamente!</strong>
                              </div>';
                    }
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Erro ao mover o arquivo para o destino. Por favor, tente novamente!</strong>
                          </div>';
                }
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>O arquivo não foi enviado. Por favor, tente novamente!</strong>
                      </div>';
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Variáveis do formulário não estão definidas corretamente. Por favor, tente novamente!</strong>
                  </div>';
        }
    }
} catch(PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../../estilos/cadastropet.css">
  <title>Cadastro - ControlPet</title>
  <link rel="shortcut icon" href="/Imagens/Icones/favicon-32x32.png" type="image/x-icon">
</head>
<body>
  <div class="content">
    <div class="box-cadastro">
      <div class="cadastro">
        <div class="conteudo">
          <div class="form">
            <div class="infos-pet">
              <h2>Informações sobre seu pet</h2>
              <hr>
              
              <form method="POST" action="" enctype="multipart/form-data">
              <input type="hidden" id="id_cliente" name="id_cliente" value="<?php echo $_SESSION['usuario_id']; ?>">

              <div class="nome">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="pet_nome" placeholder="Nome do seu bichinho" required>
                <div>
                
                  <label for="file-upload" class="upload-label">Selecionar Foto</label>
                  <input id="file-upload" class="upload-input" type="file" name="photo" accept="image/*">
               
              </div>
              </div>
              <div class="tipo-raca"> <!-- Mesma linha -->
              <div class="tipo-pet">
                <label for="tipo_pet">Tipo de pet</label>
                <input type="text" id="tipo_pet" name="tipo_pet" maxlength="15" placeholder="Cachorro" required>
              </div>
              <div class="raca">
                <label for="raca">Raça</label>
                <input type="text" id="raca" name="raca" maxlength="15" placeholder="pitbull" required><br>
              </div>
              </div>
              <div class="lala">
              <div class="genero">
                <label for="genero">Gênero</label>
                <div>
                  <input type="radio" id="macho" name="genero" value="m">
                  <label for="macho">Macho</label>
                </div>
                <div>
                  <input type="radio" id="femea" name="genero" value="f">
                  <label for="femea">Fêmea</label>
                </div>
              </div>
              
            </div>
              
              <div class="comportamento">
                <label for="comportamento">Comportamento</label>
                <input type="text" name="comportamento" id="comportamento" placeholder="Amigável, tímido, agressivo, etc.">
              </div>
              <div class="obs">
                <label for="obs">Observações gerais</label>
                <textarea name="obs" id="obs" cols="30" rows="3" placeholder="Medicamentos, comandos, etc." wrap=""></textarea>
              </div>
            </div>

            </div>
            <div class="link">
            
              <button class="btn btn-finalizar" type="submit">Finalizar cadastro</button>
              <a href="../indexcliente.php">
                <button class="btn btn-voltar" type="button">Voltar</button>
              </a>
              
            </div>
          </form>
        </div>
      </div>
      <div class="foto">
        <img src="../cadastrar-cliente/Imagens/backgrounds/img-cadastro2.png" alt="" width="100%" height="100%">
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
