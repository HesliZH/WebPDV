<?php

	abstract class DBConexao
	{
		private static $objCNX = null;

		private static function conectarDB()
		{
			try {
				if (self::$objCNX == null){
					$stringConexao = "host=localhost port=5432 dbname=Unbunthy user=postgres password=postgres";
					self::$objCNX = pg_connect($stringConexao);
				}
			} catch (Exception $e) {
				echo "Erro: servidor não encontrado";
			}
			return self::$objCNX;
		}

		protected static function getDB() {
			return self::conectarDB();
		}
	}
?>