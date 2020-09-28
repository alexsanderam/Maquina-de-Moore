<?php
class Estado {

    public $transicoes = array();
    public $descricao;
    public $conteudo;

}

class Automato {

    public $estados = array();
    private $estadoInicial; // = new Estado();

    public function setEstadoInicial($estado /* String */) {
        $this->estadoInicial = $this->estados[$estado];
        $this->estadoAtual = $this->estados[$estado]; //Retorna objeto estado;
    }

    public function getEstadoInicial() {
        return $this->estadoInicial;
    }

    public function adicionaTransicao($origem /* String */, $destinos /* String */) {
        @$transicoes = split(", ", $destinos);
        foreach ($transicoes as $destino){
            $this->estados[$origem]->transicoes[$destino] = $this->estados[$destino];
        }
    }

    public function transitaEstado($destino) {
        $this->estadoAtual = $estadoAtual->transicoes[$destino];
    }

    public function adicionaEstado($chave, $descricao, $conteudo) {
        $this->estados[$chave] = new Estado();
        $this->estados[$chave]->descricao = $descricao;
        $this->estados[$chave]->conteudo = $conteudo;
    }

}

?>