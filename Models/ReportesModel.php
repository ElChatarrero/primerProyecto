<?php 

	class ReportesModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function reportUsu(){

			$sql = "SELECT p.nacionalidad, p.idpersona, p.cedula, DATE_FORMAT(p.datecreated, '%d-%m-%Y') AS fecha,p.nombre, p.apellido, p.telefono, p.correo, p.status, r.idrol, r.nombrerol FROM persona p INNER JOIN rol r ON p.rolid = r.idrol";
			$request = $this->select_all($sql);
			return $request;
		}


		public function reportInven(){

			$sql = "SELECT i.idinventario, i.productoid, MAX(i.fecha_ingreso) AS fecha_ingreso, SUM(i.stock) AS total, i.status, p.nombre as producto FROM inventario i INNER JOIN productos p ON i.productoid = p.idproducto WHERE i.status != 0 GROUP BY productoid";
			$request = $this->select_all($sql);
			return $request;
		}

		public function resInven(){

			$sql = "SELECT d.menuid, d.productoid, SUM(d.cantidad) as total FROM detalle_menu d INNER JOIN menus m on d.menuid = m.idmenu WHERE m.status = 2 GROUP BY menuid,productoid";
			$request = $this->select_all($sql);
			return $request;
		}

		public function reportPro(){

			$sql = "SELECT *, DATE_FORMAT(datecreated, '%d-%m-%Y') AS fecha FROM productos WHERE status != 0";
			$request = $this->select_all($sql);
			return $request;
		}

		public function reportMenu(){

			$sql = "SELECT m.idmenu, m.dia, m.nombre_plato, m.horario, m.tipo, m.status, p.nombre, p.apellido FROM menus m INNER JOIN persona p ON m.personaid = p.idpersona ORDER BY idmenu;";
			$request = $this->select_all($sql);
			return $request;
		}
	}
 ?>