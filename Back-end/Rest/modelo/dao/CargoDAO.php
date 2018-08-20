<?php
    require_once __DIR__ . "/../conexao/Conexao.php";
    require_once __DIR__ . "/../entidade/Cargo.php";
    require_once __DIR__ . "/../../util/ComandoSQL.php";

    class CargoDAO
    {
        public function obterRegistro($codigo)
        {
            $cargo = null;
            $conexao = Conexao::recuperar();
            $conexao -> beginTransaction();
            $sql = new ComandoSQL();
            $sql -> adicionar("SELECT");
            $sql -> adicionar("*");
            $sql -> adicionar("FROM");
            $sql -> adicionar("CARGO");
            $sql -> adicionar("WHERE");
            $sql -> adicionar("CODIGO = :CODIGO");
            $comando = $conexao -> prepare($sql -> comando);
            $comando -> bindValue(":CODIGO", $codigo, PDO::PARAM_INT);
            $comando -> execute();
            $conexao -> commit();
            if ($comando -> rowCount() == 1)
            {
                $resultado = $comando -> fetchAll()[0];       
                $cargo = new Cargo();
                $cargo -> codigo = $resultado["CODIGO"];
                $cargo -> nome = $resultado["NOME"];
            }
            return $cargo;
        }

        public function obterLista()
        {
            $cargos = array();
            $conexao = Conexao::recuperar();
            $conexao -> beginTransaction();
            $sql = new ComandoSQL();
            $sql -> adicionar("SELECT");
            $sql -> adicionar("*");
            $sql -> adicionar("FROM");
            $sql -> adicionar("CARGO");
            $sql -> adicionar("ORDER BY");
            $sql -> adicionar("NOME");
            $comando = $conexao -> prepare($sql -> comando);
            $comando -> execute();
            $conexao -> commit();
            if ($comando -> rowCount() > 0)
            {
                $resultados = $comando -> fetchAll();
                foreach($resultados as $resultado)
                {
                    $cargo = new Cargo();
                    $cargo -> codigo = $resultado["CODIGO"];
                    $cargo -> nome = $resultado["NOME"];
                    array_push($cargos, $cargo);
                }            
            }
            return $cargos;
        }
    }
?>