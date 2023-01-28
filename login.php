<?php

require __DIR__ . '/errors/errors.php';

session_start();
$_SESSION["erros"] = null;

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (isset($_POST['email'])) {
    $usuarios = [
        [
            "nome" => "Aluno Code3r",
            "email" => "aluno@code3r.com.br",
            "senha" => "123456"
        ], [
            "nome" => "Outro Aluno Code3r",
            "email" => "outro@code3r.com.br",
            "senha" => "654321"
        ]

    ];

    foreach ($usuarios as $usuario) {
        $emailValido = $email == $usuario["email"];
        $senhalValida = $senha == $usuario["senha"];

        if ($emailValido && $senhalValida) {
            $_SESSION["erros"] = null;
            $_SESSION["usuario"] = $usuario["nome"];
            setcookie('usuario', $usuario['nome'], time() + 3600);
            header('location: index.php');
        } else {
            $_SESSION["erros"] = ["Email ou senha inválidos"];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="recursos/css/estilo.css">
    <link rel="stylesheet" href="recursos/css/login.css">
</head>

<body class="login">
    <header class="cabecalho">
        <h1>Curso PHP</h1>
        <h2>Índice dos Exercícios</h2>
    </header>
    <main class="principal">
        <div class="conteudo">
            <h3>Identifique-se</h3>
            <?php if (!is_null($_SESSION['erros'])) : ?>
                <div class="erros">
                    <?php foreach ($_SESSION['erros'] as $erro) : ?>
                        <p><?= $erro ?></p>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

            <form action="#" method="post">
                <div>
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email">
                </div>
                <div>
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha">
                </div>
                <button type="submit">Entrar</button>
            </form>
        </div>
    </main>
    <footer class="rodape">
        COD3R & ALUNOS © <?= date('Y'); ?>
    </footer>
</body>

</html>