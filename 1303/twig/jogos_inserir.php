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
        
        // Importar PDO
        
    }
}

require('carregar_twig.php');

echo $twig->render('jogos_inserir.html', [
    'erro' => $erro,
]);