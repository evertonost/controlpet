

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../../estilos/cadastrarfuncionario.css">
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
              <h2>Informações sobre o novo funcionário</h2>
              <hr>
              
              <form method="POST" action="" enctype="multipart/form-data">
              <input type="hidden" id="id_petshop" name="id_petshop" value="<?php echo $_SESSION['usuario_id']; ?>">

              <div class="nome">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="func_nome" placeholder="Nome completo" required>
                <div>
                
                  <label for="file-upload" class="upload-label">Selecionar Foto</label>
                  <input id="file-upload" class="upload-input" type="file" name="photo" accept="image/*">
               
              </div>
              
              </div>

              


              <div class="tipo-raca"> <!-- Mesma linha -->
              <div class="tipo-pet">
                <label for="tipo_pet">Email</label>
                <input type="text" id="tipo_pet" name="func_email" maxlength="15" placeholder="teste@gmail.com" required>
              </div>
              <div class="raca">
                <label for="raca">Celular</label>
                <input type="text" id="raca" name="func_cel" maxlength="15" placeholder="(00) 0000-0000" required><br>
              </div>
              </div>
              <div class="lala">
              <div class="genero">
                <label for="genero">Sexo</label>
                <div>
                  <input type="radio" id="macho" name="sexo" value="m">
                  <label for="macho">Masculino</label>
                </div>
                <div>
                  <input type="radio" id="femea" name="sexo" value="f">
                  <label for="femea">Feminino</label>
                </div>
              </div>
              
            </div>
              
              
              <div class="nome">
                <label for="cpf">Cpf</label>
                <input type="text" id="cpf" name="func_cpf" maxlength="11" placeholder="000.000.000-00" required><br>
              </div>
            </div>
            <?php
// Certifique-se de que o cliente esteja logado e o ID seja armazenado em uma variável de sessão.

session_start();
if (isset($_SESSION['usuario_id'])) { // Verifique se o nome da variável de sessão é 'usuario_id'
    $id_cliente = $_SESSION['usuario_id']; // Use o nome correto da variável de sessão aqui
    echo '<input type="hidden" name="id_cliente" value="' . $id_cliente . '">';
}
?>

          </div>
            <div class="link">
            
              <button class="btn btn-finalizar" type="submit">Finalizar cadastro</button>
              <a href="../indexpetshop.php">
                <button class="btn btn-voltar" type="button">Voltar</button>
              </a>
              
        </div>
          
        </div>
        </form>


      </div>
      <div class="foto">
      <img src="../../petshop/imagens/backgrounds/img-cad-funcionario.jpg" alt="" width="100%" height="100%">
      </div>
    </div>
  </div>
  
  <?php


include("../../conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (
            isset($_POST['func_nome'], $_POST['func_email'], $_POST['func_cel'], $_POST['sexo'], $_POST['func_cpf'], $_POST['id_petshop'])
        ) {
            $func_nome = $_POST['func_nome'];
            $func_email = $_POST['func_email'];
            $func_cel = $_POST['func_cel'];
            $sexo = $_POST['sexo'];
            $func_cpf = $_POST['func_cpf'];
            $id_petshop = $_POST['id_petshop'];
            
            $foto_pet = $_FILES['photo'];

            if (!empty($_FILES["photo"]["name"])) {
                $foto_nome = $_FILES["photo"]["name"];
                $foto_temp = $_FILES["photo"]["tmp_name"];
                $foto_destino = "Imagens/imagens_funcionario/" . $foto_nome;
                $caminho_diretorio = 'Imagens/imagens_funcionario/';

                // Verificar se o diretório não existe e, se não, criar o diretório
                if (!file_exists($caminho_diretorio)) {
                    mkdir($caminho_diretorio, 0777, true); // Cria o diretório recursivamente
                }
      
                // Move a imagem para o diretório correto
                if (move_uploaded_file($foto_temp, $foto_destino)) {
                    // Prepara e executa a inserção no banco de dados
                    $stmt = $conn->prepare("INSERT INTO funcionarios (id_petshop, func_nome, func_email, func_celular, sexo, func_cpf, foto) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$id_cliente, $func_nome, $func_email, $func_cel, $sexo, $func_cpf, $foto_destino]);

                    // Verificar se a inserção foi bem-sucedida
                    if ($stmt->rowCount() > 0) {
                      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Funcionário cadastrado com sucesso.</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      </div>';
              
                      echo '<script>
                      document.getElementById("alert-success").addEventListener("closed.bs.alert", function () {
                        window.location.href = "../indexpetshop.php";
                      });

                    </script>';

                     // Redirecionamento após 2 segundos
                    echo '<script>
                    setTimeout(function(){
                        window.location.href = "../indexpetshop.php";
                    }, 1500);
                    </script>';


                    } else {
                        echo "Erro ao inserir o funcionário no banco de dados.";
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
    } catch(PDOException $e) {
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    } finally {
        // Fechar a conexão com o banco de dados
        $conn = null;
    }
}
?>
