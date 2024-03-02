<?php 

	class DashboardModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}	

		public function cantUsuarios(){

			$sql = "SELECT COUNT(*) as total FROM persona WHERE status != 0";
			$request = $this->select($sql);
			$total = $request['total'];
			return $total;
		}

		public function cantInventario(){

			$sql = "SELECT COUNT(*) as total FROM inventario WHERE status != 0";
			$request = $this->select($sql);
			$total = $request['total'];
			return $total;
		}

		public function cantProductos(){

			$sql = "SELECT COUNT(*) as total FROM productos WHERE status = 1";
			$request = $this->select($sql);
			$total = $request['total'];
			return $total;
		}

		public function cantMenus(){

			$sql = "SELECT COUNT(*) as total FROM menus WHERE status = 2";
			$request = $this->select($sql);
			$total = $request['total'];
			return $total;
		}

		public function ultiMenu(){

			$sql = "SELECT idmenu, dia, nombre_plato, horario, status FROM menus WHERE status = 2 ORDER BY idmenu DESC LIMIT 10;";
			$request = $this->select_all($sql);
			return $request;
		}
		public function stock(){

			$sql = "SELECT p.nombre, SUM(d.cantidad) as cantidad FROM detalle_menu d INNER JOIN productos p ON d.productoid = p.idproducto INNER JOIN menus m ON d.menuid = m.idmenu WHERE m.status = 2 GROUP BY p.idproducto ORDER BY SUM(d.cantidad) DESC LIMIT 5";
			$request = $this->select_all($sql);
			return $request;
		}

		public function resStock(){

			$sql = "SELECT d.menuid, d.productoid, SUM(d.cantidad) as total FROM detalle_menu d INNER JOIN menus m on d.menuid = m.idmenu WHERE m.status = 2 GROUP BY menuid,productoid";
			$request = $this->select_all($sql);
			return $request;
		}

	}
 ?>