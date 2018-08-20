<?php
    abstract class Entidade implements JsonSerializable
    {
        protected $codigo;

        public function __construct()
        {
            $this -> codigo = -1;
        }

        public abstract function jsonSerialize();
    }
?>