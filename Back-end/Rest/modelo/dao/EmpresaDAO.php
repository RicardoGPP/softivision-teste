<?php
    require_once __DIR__ . "/../conexao/Conexao.php";
    require_once __DIR__ . "/../entidade/Empresa.php";
    require_once __DIR__ . "/../../util/ComandoSQL.php";

    class EmpresaDAO
    {
        public function obterRegistro($codigo)
        {
            $empresa = null;
            $conexao = Conexao::recuperar();
            $conexao -> beginTransaction();
            $sql = new ComandoSQL();
            $sql -> adicionar("SELECT");
            $sql -> adicionar("*");
            $sql -> adicionar("FROM");
            $sql -> adicionar("EMPRESA");
            $sql -> adicionar("WHERE");
            $sql -> adicionar("CODIGO = :CODIGO");
            $comando = $conexao -> prepare($sql -> comando);
            $comando -> bindValue(":CODIGO", $codigo, PDO::PARAM_INT);
            $comando -> execute();
            $conexao -> commit();
            if ($comando -> rowCount() == 1)
            {
                $resultado = $comando -> fetchAll()[0];       
                $empresa = new Empresa();
                $empresa -> codigo = $resultado["CODIGO"];
                $empresa -> nome = $resultado["NOME"];
            }
            return $empresa;
        }

        public function obterLista()
        {
            $empresas = array();
            $conexao = Conexao::recuperar();
            $conexao -> beginTransaction();
            $sql = new ComandoSQL();
            $sql -> adicionar("SELECT");
            $sql -> adicionar("*");
            $sql -> adicionar("FROM");
            $sql -> adicionar("EMPRESA");
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
                    $empresa = new Empresa();
                    $empresa -> codigo = $resultado["CODIGO"];
                    $empresa -> nome = $resultado["NOME"];
                    array_push($empresas, $empresa);
                }            
            }
            return $empresas;
        }
    }
?>