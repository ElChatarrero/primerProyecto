<?php 

	class ProductosModel extends Mysql
	{
		public $intIdProducto;
		public $strProducto;
		public $strDescripcion;
		public $intStatus;

		public function __construct()
		{
			parent::__construct();
		}	


		public function selectProductos(){

			//EXTRAE PRODUCTOS
			$sql = "SELECT * FROM productos WHERE status != 0";
			$request = $this->select_all($sql);
			return $request;
		}


	public function insertProducto(string $producto, string $descripcion, int $status){

			$return = 0;
			$this->strProducto = $producto;
			$this->strDescripcion = $descripcion;
			$this->intStatus = $status;

			$sql = "SELECT * FROM productos WHERE nombre = '{$this->strProducto}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO productos(nombre,descripcion,status) VALUES(?,?,?)";
	        	$arrData = array($this->strProducto, $this->strDescripcion, $this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}

		public function updateProducto(int $idproducto, string $producto, string $descripcion, int $status){

			$this->intIdProducto = $idproducto;
			$this->strProducto = $producto;
			$this->strDescripcion = $descripcion;
			$this->intStatus = $status;

			$sql = "SELECT * FROM productos WHERE nombre = '{$this->strProducto}' AND idproducto != $this->intIdProducto";
			$request = $this->select_all($sql);

			if(empty($request)){

				$sql = "UPDATE productos SET nombre = ?, descripcion = ?, status = ? WHERE idproducto = $this->intIdProducto ";
				$arrData = array($this->strProducto, $this->strDescripcion, $this->intStatus);
				$request = $this->update($sql, $arrData);
			}else{
				$request = "exist";
			}
			return $request;
		}

		public function selectProducto(int $idproducto){

			$this->intIdProducto = $idproducto;
			$sql = "SELECT idproducto, nombre, descripcion, status, DATE_FORMAT(datecreated, '%d-%m-%Y') as fechaRegistro FROM productos WHERE idproducto = $this->intIdProducto";
			$request = $this->select($sql);
			return $request;
		}

		public function deleteProducto(int $idproducto)
		{
			$this->intIdProducto = $idproducto;

			$sql = "SELECT * FROM inventario WHERE productoid = '$this->intIdProducto'";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE productos SET status = ? WHERE idproducto = '$this->intIdProducto'";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			}else{
				$request = 'exist';
			}
			return $request;
		}
	}

 ?>