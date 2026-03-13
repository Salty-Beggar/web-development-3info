<?php

class Personagem {

    private $nome;
    private $vida;
    private $ataque;
    private $defesa;
    private $chanceCritico;
    private $multiplicadorCritico;

    public function __construct($nome, $vida, $ataque, $defesa, $chanceCritico, $multiplicadorCritico) {
        $this->nome = $nome;
        $this->vida = $vida;
        $this->ataque = $ataque;
        $this->defesa = $defesa;
        $this->chanceCritico = $chanceCritico;
        $this->multiplicadorCritico = $multiplicadorCritico;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getVida() {
        return $this->vida;
    }

    public function setVida($vida) {
        $this->vida = $vida;
    }

    public function getAtaque() {
        return $this->ataque;
    }

    public function getDefesa() {
        return $this->defesa;
    }
    public function getChanceCritico() {
        return $this->chanceCritico;
    }

    public function getMultiplicadorCritico() {
        return $this->multiplicadorCritico;
    }

    public function atacar($inimigo) {

        $isCritico = random_int(1, 100) <= $this->getChanceCritico();
        echo $this->nome." ataca ".$inimigo->nome."!<br>";

        $ataqueAtual = ($isCritico) ? $this->getAtaque()*$this->getMultiplicadorCritico()/100 : $this->getAtaque();
        $inimigo->setVida($inimigo->getVida() - $ataqueAtual + $inimigo->getDefesa());

        if ($isCritico) echo "**Ataque crítico!** ";
        echo $inimigo->nome.": Vida ".$inimigo->vida;
    }

}

class Jogo {

    private $personagens;
    private $jogadorAtual;

    public function __construct($personagens) {
        $this->personagens = $personagens;
        $this->jogadorAtual = 0;
    }

    public function iniciarJogo() {
        echo "**Início do Jogo!**<br>";

        foreach ($this->personagens as $personagem) {
            echo "{$personagem->getNome()}: Vida {$personagem->getVida()}<br>";
        }

        echo "<br>";
    }

    public function realizarTurno() {
        $atualPersonagem = $this->personagens[$this->jogadorAtual];
        $proximoPersonagem = $this->personagens[($this->jogadorAtual + 1) % count($this->personagens)];

        echo "**Turno do ".$atualPersonagem->getNome()."**<br>";

        $atualPersonagem->atacar($proximoPersonagem);

        $this->jogadorAtual = ($this->jogadorAtual + 1) % count($this->personagens);

        echo "<br><br>";
    }

    public function verificarVencedor() {
        foreach ($this->personagens as $personagem) {
            if ($personagem->getVida() <= 0) return $personagem;
        }
    }

}

// Criação de personagens
$heroi = new Personagem("Herói", 100, 10, 5, 20, 10);
$monstro = new Personagem("Monstro", 80, 8, 3, 10, 15);

// Criação do jogo
$jogo = new Jogo([$heroi, $monstro]);
$vencedor = null;

// Início do jogo
$jogo->iniciarJogo();

// Loop do jogo
while (!$vencedor) {
    $jogo->realizarTurno();
    $vencedor = $jogo->verificarVencedor();
}

// Exibição do vencedor
echo "**{$vencedor->getNome()} venceu!**<br>";