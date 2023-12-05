<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/login1.css">
    <title>Login - ControlPet</title>
</head>
<body>

    
    <div class="login">
        <!-- parte de cima do formulario -->
    <div>
            <img src="Logo.png" alt="" class="logo">
    </div>

        <!-- parte de baixo do formulario -->
    <div class="card-login">
        <h2>Login</h2> <!-- titulo do cartao -->

                
        <form method="POST" action="valid_login.php"><!-- enviar para autenticacao ao clicar no botao -->
            <div class="formulario">

                <div class="box-input">
                    <input type="text" name="login" id="cpf" required autocomplete="off" autofocus>
                    <label for="text">Cpf / Cnpj</label>
                </div>

                <div class="box-input">
                    <input type="password" name="senha" id="senha" required>
                    <label for="senha">Senha</label>
                </div>

                <div class="esqueceu">
                    <a href="./esqueci-a-senha/esqueci-a-senha.php">Esqueceu a senha?</a>
                </div>

                    <button type="submit" class="btn-entrar"><p>Entrar</p></button>

                        <?php 
                        if(isset($_GET['saiu'])){
                        echo "deslogado com sucesso";
                        }
                        ?>

            </div>
        </form>

                <a href="./cliente/cadastrar-cliente/cadastro.php" class="btn-cadastrar">
                    <p>Cadastrar usuário</p>
                </a>
                
                <a href="./petshop/cad_petshop.php" class="btn-cadastrar">
                    <p>Cadastrar petshop</p>
                </a>
                
    </div>
        


</body>
</html>