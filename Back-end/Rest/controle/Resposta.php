<?php
    class Resposta implements JsonSerializable
    {
        private $sucesso;
        private $mensagem;
        private $retorno;

        public function __construct($sucesso, $mensagem, $retorno)
        {            
            $this -> status = $sucesso;
            $this -> mensagem = $mensagem;
            $this -> retorno = $retorno;
        }

        public function jsonSerialize()
        {
            return
            [
                'sucesso' => $this -> status,
                'mensagem' => $this -> mensagem,
                'retorno' => $this -> retorno
            ];
        }
    }
?>