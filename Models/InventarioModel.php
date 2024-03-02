<?php 

	class InventarioModel extends Mysql
	{
		public $intIdInventario;
		public $intProductoId;
		public $fechaIngreso;
		public $intStock;
		public $intStatus;


		public function __construct()
		{
			parent::__construct();
		}

		public function selectInventario(){

			$sql = "SELECT i.idinventario, i.productoid, MAX(i.fecha_ingreso) AS fecha_ingreso, SUM(i.stock) AS total, i.status, p.nombre as producto FROM inventario i INNER JOIN productos p ON i.productoid = p.idproducto GROUP BY productoid";
			$request = $this->select_all($sql);
			return $request;
		}

		public function insertInventario(int $producto,  $fechaingreso, int $cantidad){

			$return = 0;
			$this->intProductoId = $producto;
			$this->fechaIngreso = $fechaingreso;
			$this->intStock = $cantidad;
			
				$sql  = "INSERT INTO inventario(productoid, fecha_ingreso, stock) VALUES(?,?,?)";
	        	$arrData = array($this->intProductoId, $this->fechaIngreso, $this->intStock);
	        	$request_insert = $this->insert($sql,$arrData);
	        	$return = $request_insert;
			
			return $return;
		}

		public function selectDetalles(){

			$sql = "SELECT i.idinventario, i.productoid, i.fecha_ingreso, i.stock, i.status, p.nombre as producto FROM inventario i INNER JOIN productos p ON i.productoid = p.idproducto WHERE i.status != 0";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectIngredientes(){

			$sql = "SELECT d.menuid, d.productoid, SUM(d.cantidad) as total FROM detalle_menu d INNER JOIN menus m on d.menuid = m.idmenu WHERE m.status = 2 GROUP BY menuid,productoid";
			$request = $this->select_all($sql);
			return $request;
		}

	}
 ?>