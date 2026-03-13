<?php

// teste_twig.php

require 'carregar_twig.php';

$nome = 'Abacaxi';

echo $twig->render('teste_twig.html', [
    'nome' => $nome
]);