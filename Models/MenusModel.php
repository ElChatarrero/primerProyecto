<?php 

	class MenusModel extends Mysql{

		public $idMenu;
		public $idPersona;
		public $strNombrePlato;
		public $strDia;
		public $intTurno;
		public $intTipo;
		public $intProducto;
		public $intCantidad;


		public function __construct()
		{
			parent::__construct();
		}	


public function selectMenu(){

			$sql = "SELECT idmenu, dia, nombre_plato, horario, tipo, status FROM menus";
			$request = $this->select_all($sql);
			return $request;
		}

		public function insertMenu(int $idpersona,  string $nombreplato, string $dia, int $turno, int $tipo){

			$return = 0;
			$this->idPersona = $idpersona;
			$this->strNombrePlato = $nombreplato;
			$this->strDia = $dia;
			$this->intTurno = $turno;
			$this->intTipo = $tipo;
			
				$sql  = "INSERT INTO menus(personaid, dia, nombre_plato, horario, tipo) VALUES(?,?,?,?,?)";
	        	$arrData = array($this->idPersona,  $this->strDia,$this->strNombrePlato, $this->intTurno, $this->intTipo);
	        	$request_insert = $this->insert($sql,$arrData);
	        	$return = $request_insert;
			
			return $return;
		}

		public function insertDetalle(int $idmenu,  int $pruducto, int $cantidad){

			$return = 0;
			$this->idMenu = $idmenu;
			$this->intProducto = $pruducto;
			$this->intCantidad = $cantidad;

			
				$sql  = "INSERT INTO detalle_menu(menuid, productoid, cantidad) VALUES(?,?,?)";
	        	$arrData = array($this->idMenu,  $this->intProducto,$this->intCantidad);
	        	$request_insert = $this->insert($sql,$arrData);
	        	$return = $request_insert;	
			    return $return;
		}

		public function selectDetalle( $idmenu){

			$this->idMenu = $idmenu;
			$sql = "SELECT d.id_detalle, d.menuid, d.productoid, SUM(d.cantidad) AS total, p.nombre, m.nombre_plato FROM detalle_menu d INNER JOIN productos p on d.productoid = p. idproducto INNER JOIN menus m ON d.menuid = m.idmenu WHERE d.menuid = '$this->idMenu' GROUP BY d.productoid ";
			$request = $this->select_all($sql);
			return $request;

		}

		public function deleteMenu(int $idmenu){

			$this->idMenu = $idmenu;

				$sql = "UPDATE menus SET status = ? WHERE idmenu = '$this->idMenu'";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			
			return $request;
		}

		public function aprobMenu(int $idmenu){

			    $this->idMenu = $idmenu;

			    $sql1 = "SELECT i.idinventario, i.productoid, SUM(i.stock) AS total FROM inventario i INNER JOIN productos p ON i.productoid = p.idproducto GROUP BY productoid";
			    $pedido = $this->select_all($sql1);
			    
			    $sql2 = "SELECT  d.menuid, d.productoid,SUM(d.cantidad) as total FROM detalle_menu d INNER JOIN menus m on d.menuid = m.idmenu WHERE d.menuid = '$this->idMenu' GROUP BY menuid,productoid";
			    $pedido2 = $this->select_all($sql2);

			    for ($i=0; $i < count($pedido); $i++) {

					for ($j = 0; $j < count($pedido2); $j++){

						if ($pedido[$i]['productoid'] == $pedido2[$j]['productoid'] and $pedido[$i]['total'] < $pedido2[$j]['total']){

							$request = 'error';

						}
						if($pedido[$i]['productoid'] == $pedido2[$j]['productoid'] and $pedido[$i]['total'] > $pedido2[$j]['total']){

							$sql = "UPDATE menus SET status = ? WHERE idmenu = '$this->idMenu'";
				            $arrData = array(2);
				            $datos = $this->update($sql,$arrData);
				            $request = 'ok';
						}
					}	
				}
				return $request;
		}
	}
?>