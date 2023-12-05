<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="stylesheet" href="../estilos/cadastrar-petshop.css">
  <title>Cadastro - ControlPet</title>
  <link rel="shortcut icon" href="/Imagens/Icones/favicon-32x32.png" type="image/x-icon">
  <style>
    
    /* Adicione o estilo diretamente ao input de arquivo */
    input[type="file"] {
      display: none;
    }

    input[type="file"]+label::before {
      content: "Escolher Foto";
      display: inline-block;
      background-color: var(--botoes);
      color: var(--corfonte);
      padding: 8px 10px;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="file"]+label:hover::before {
      background-color: var(--hoverbotao);
      color: var(--hoverfonte);
    }
    .alert-message {
      display: none;
    }
  </style>
</head>
<body>
  <form action="" method="post" enctype="multipart/form-data">


            <div class="alert alert-success alert-message" role="alert">
                  Cadastrado com sucesso
                </div>
    <div class="content">
      <div class="box-cadastro">
                
        <div class="cadastro">
          <div class="conteudo">
            <div class="form">
              <div class="infos-cliente">
                <h2>Novo Petshop</h2>
                <hr>

                
                <div class="nome">
                  <label for="nome">Nome</label>
                  <input type="text" id="nome" name="nome" placeholder="digite o nome" required>

                  <label class="botao-label" for="Foto"></label>
                  <input type="file" id="Foto" name="foto" accept="image/*">


                </div>
                <div class="cpf-data"> <!-- Mesma linha -->
                  <div class="cnpj">
                    <label for="cnpj">Cnpj</label>
                    <input type="text" id="cpf" name="cnpj" maxlength="15" placeholder="000000000-00" required> 
                  </div>
                  
                </div>
                <div class="email">
                  <label for="email">Seu e-mail</label>
                  <input type="email" name="email" id="email" placeholder="vazio@vazio.com.br" required>
                </div>
                <div class="contato">
                  <div class="telefone2">
                    <label for="telefone">Telefone 1</label>  
                    <input type="tel" name="telefone" id="telefone" placeholder="(11) 00000 0000" required>    
                  </div>
                  <div class="telefone2">
                    <label for="telefone2">Telefone 2</label> 
                    <input type="tel" name="telefone2" id="telefone2" placeholder="(11) 00000 0000 (opcional)">
                  </div>

                  

                </div>
                <div class="senha">
                    <label for="senha">Senha</label>  
                    <input type="password" name="senha" id="telefone" placeholder="Digite a senha" required>  
                  </div>
                  <div class="confirmacao-senha">
                    <label for="confirmacao-senha">Confirmação</label> 
                    <input type="password" name="confirmacao_senha" id="telefone2" placeholder="Digite novamente">
                  </div>
                
              </div>

              
              <div class="localizacao">
                <h2>Endereço</h2>
                <hr>
                <div class="divisao">
                  <div class="cima"><!-- parte de cima -->
                    <div class="rua">
                      <label for="rua">Rua</label>
                      <input type="text" name="rua" id="rua" placeholder="R. exemplo" required>
                    </div>
                    <div class="numero">
                      <label for="numero">Número</label>
                      <input type="number" name="numero" id="numero" placeholder="00" required>
                    </div>
                    <div class="complemento">
                      <label for="complemento">Complemento</label>
                      <input type="text" name="complemento" id="complemento" placeholder="Bloco 0 Apto 0">
                    </div>
                  </div> 
                  <div class="baixo">
                    <div class="estado">
                      <label for="estado">Estado</label>
                      <input type="text" name="estado" id="estado" placeholder="Paraná" required>
                    </div>
                    <div class="cidade">
                      <label for="cidade">Cidade</label>
                      <input type="text" name="cidade" id="cidade" placeholder="Curitiba" required>
                    </div>
                  </div> 
                </div>
              </div>
            </div>
            <div class="link">
              
                <button class="btn" type="submit" name="finalizar" value="finalizar">Cadastrar</button>
                <a href="../login.php">
                <button class="btn" type="button" name="Voltar" value="Voltar">Voltar</button></a>
              

          </form>
          </div>
        </div>
      </div>
      <div class="foto">
        <img src="../petshop/imagens/backgrounds/img-cadastro.png" alt="" width="100%" height="100%">
      </div>
    </div>
  </div>

  <?php
// Verifica se o formulário foi submetido
if(isset($_POST["finalizar"])) {
    include("../conexao.php");

    // Obtenção dos dados do formulário
    $nome = $_POST["nome"];
    $cnpj = $_POST["cnpj"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $telefone2 = $_POST["telefone2"];
    $senha = $_POST["senha"];
    $confirmacao_senha = $_POST["confirmacao_senha"];
    $rua = $_POST["rua"];
    $numero = $_POST["numero"];
    $complemento = $_POST["complemento"];
    $estado = $_POST["estado"];
    $cidade = $_POST["cidade"];

    // Verificar se o CPF ou o e-mail já existem no banco de dados
    $verifica_cnpj_email = $conn->prepare("SELECT COUNT(*) FROM `petshops` WHERE `cnpj_petshop` = :pcnpj OR `email_petshop` = :pemail");
    $verifica_cnpj_email->bindValue(":pcnpj", $cnpj);
    $verifica_cnpj_email->bindValue(":pemail", $email);


    // Executar a consulta
    if ($verifica_cnpj_email->execute()) {
        // Verificar se há resultados
        $result = $verifica_cnpj_email->fetchColumn();
        
        if ($result > 0) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    alert('cnpj ou e-mail já cadastrados.');
                });
            </script>";
        } else {
            // Se não existirem duplicatas de CPF ou e-mail, prossegue com o cadastro

            // Verifica se uma imagem foi enviada
            if (!empty($_FILES["foto"]["name"])) {
                $foto_nome = $_FILES["foto"]["name"];
                $foto_temp = $_FILES["foto"]["tmp_name"];
                $foto_destino = "imagenspetshop" . $foto_nome;

                // Move a imagem para a pasta fotos_upload
                if (move_uploaded_file($foto_temp, $foto_destino)) {
                    // Prepara a inserção no banco de dados apenas com o caminho da foto
                    $grava = $conn->prepare("INSERT INTO `petshops`(`nome_petshop`,`foto_petshop`, `cnpj_petshop`, `email_petshop`,`telefone1_petshop`, `telefone2_petshop`, `senha_petshop`, `confirm_senha_petshop`, `rua_petshop`, `numero_petshop`, `complemento_petshop`, `estado_petshop`, `cidade_petshop`, `status_petshop`) VALUES (:pnome, :pfoto, :pcnpj, :pemail, :ptelefone1, :ptelefone2, :psenha, :pconfirmacao_senha, :prua, :pnumero, :pcomplemento, :pestado, :pcidade, 1)");

                    // Bind dos parâmetros
                    $grava->bindValue(":pnome", $nome);
                    $grava->bindValue(":pfoto", "imagenspetshop" . $foto_nome); // Salva o caminho da foto
                    $grava->bindValue(":pcnpj", $cnpj);
                    $grava->bindValue(":pemail", $email);
                    $grava->bindValue(":ptelefone1", $telefone);
                    $grava->bindValue(":ptelefone2", $telefone2);
                    $grava->bindValue(":psenha", $senha);
                    $grava->bindValue(":pconfirmacao_senha", $confirmacao_senha);
                    $grava->bindValue(":prua", $rua);
                    $grava->bindValue(":pnumero", $numero);
                    $grava->bindValue(":pcomplemento", $complemento);
                    $grava->bindValue(":pestado", $estado);
                    $grava->bindValue(":pcidade", $cidade);

                    // Executa a inserção
                    if ($grava->execute()) {
                        echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Exibe a mensagem de alerta
                                document.querySelector('.alert-message').style.display = 'block';
                                
                                // Define um temporizador para esconder a mensagem após 1000 milissegundos (1 segundo)
                                setTimeout(function() {
                                    document.querySelector('.alert-message').style.display = 'none';
                                    
                                    // Redireciona para o login.php na pasta raiz
                                    window.location.href = '../login.php';
                                }, 1000);
                            });
                        </script>";
                    } else {
                        // Se houver um erro, imprima a mensagem de erro
                        echo "Erro: " . $grava->errorInfo()[2];
                    }
                } else {
                    echo "Erro ao mover o arquivo para o diretório desejado.";
                }
            }
        }
    }
}
?>