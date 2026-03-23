<?php
// jogos_inserir.php
$erro = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Preparar os dados para inserir no banco
    $nome = $_POST['nome'] ?? false;
    $estilo = $_POST['estilo'] ?? false;

    // Verifica erro
    if (!$nome || !$estilo) {
        $erro = 'Preencha todos os campos';
    } else {
        // Tudo certo - gravar os dados
        require('carregar_pdo.php');

        $ext = pathinfo($_FILES['capa']['name'], PATHINFO_EXTENSION);
        $capa = uniqid()."{$ext}";

        move_uploaded_file($_FILES['capa']['tmp_name'], "img/{$capa}");

        die;

        $pdo->beginTransaction();

        $dados = $pdo->prepare('INSERT INTO jogos (nome, estilo) VALUES (?, ?)');
        $dados->bindParam(1, $nome);
        $dados->bindParam(2, $estilo);
        $dados->execute();

        $pdo->commit();

        header('location:jogos.php');
        die;
    }
}

require('carregar_twig.php');

echo $twig->render('jogos_inserir.html', [
    'erro' => $erro,
]);