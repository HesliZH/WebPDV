<?php
	require_once "DBConexao.Class.php";

	abstract class DBProdutos extends DBConexao
	{	
		
        public static function DBInserir(Produtos $Produtos){
            $conexao = parent::getDB();
    
            $query = pg_query($conexao, "INSERT INTO tblProdutos (descricao, custo_real, preco_venda, qtd_estoque, unidade) VALUES ('".$Produtos->getDescricao()."', '".$Produtos->getCusto_real()."', '".$Produtos->getPreco_venda()."', '".$Produtos->getQtd_estoque()."', '".$Produtos->getUnidade()."')");
                
            if ($query)
            {
                return "Inserido com sucesso";
            }
            else
            {
                return "Erro ao inserir";
            }
        }
        
        public static function DBListar(){
            $conexao = parent::getDB();

            $query = pg_query($conexao, "SELECT id, descricao, custo_real, preco_venda, qtd_estoque, unidade FROM tblprodutos ORDER BY id");

            return pg_fetch_all($query);
        }

        public static function DBAtualizar(Produtos $Produtos){
            $conexao = parent::getDB();

            $query = pg_query("UPDATE tblprodutos SET descricao = '".$Produtos->getdescricao()."', custo_real = '".$Produtos->getCusto_real()."', preco_venda = '".$Produtos->getPreco_venda()."', qtd_estoque = '".$Produtos->getQtd_estoque()."', unidade = '".$Produtos->getUnidade()."' WHERE id = ".$Produtos->getId());
            
            if ($query)
            {
                return "Alterado com sucesso";
            }
            else
            {
                return "Erro ao alterar";
            }
        }

        public static function DBBuscar($cod_prod){
            $conexao = parent::getDB();

            $query = pg_query($conexao,"SELECT id, descricao, custo_real, preco_venda, qtd_estoque FROM tblProdutos WHERE id = ".$cod_prod);

            $dataSetProdutos = pg_fetch_assoc($query);

            if($dataSetProdutos) {
                $Produtos = new Produtos();
                $Produtos->setId($dataSetProdutos["id"]);
                $Produtos->setDescricao($dataSetProdutos["descricao"]);
                $Produtos->setCusto_real($dataSetProdutos["custo_real"]);
                $Produtos->setPreco_venda($dataSetProdutos["preco_venda"]);
                $Produtos->setQtd_estoque($dataSetProdutos["qtd_estoque"]);
                $Produtos->setUnidade($dataSetProdutos["unidade"]);
   
                return $Produtos;
            }

            return false;
        }

        public static function DBExcluir($cod_prod){
            $conexao = parent::getDB();

            $query = pg_query($conexao, "DELETE FROM tblProdutos WHERE id = '".$cod_prod."'");

            if ($query)
            {
                return "Excluído com sucesso";
            }
            else
            {
                return "Erro ao excluir";
            }
        }

        public static function DBRelatorio($filtro){


        }
	}		
?>