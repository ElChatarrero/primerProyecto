<?php	
	class Menus extends Controllers{
		public function __construct()
		{
			session_start();
			parent::__construct();			
			//session_regenerate_id(true);
			if (empty($_SESSION['login'])){
				header('Location: '.base_url().'/login');
			}
			getPermisos(5);
		}

		public function Menus(){
				$data['page_tag'] = "Menús";
				$data['page_title'] = " Menús";
				$data['page_name'] = "menus";
				$data['page_functions_js'] = "functions_menus.js";
				$this->views->getView($this,"menus",$data);
		}
	
	//Para listar
		public function getMenu(){

				if($_SESSION['permisosMod']['r']){	    
				    $arrData = $this->model->selectMenu();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';
					$btnApro = '';

					if($arrData[$i]['status'] == 0){

						$arrData[$i]['status'] = '<span class="badge badge-danger">Inavilitado</span>';
					}

					if($arrData[$i]['status'] == 1)
				{
					$arrData[$i]['status'] = '<span class="badge badge-danger">Por aprobación</span>';
				}
				if($arrData[$i]['status'] == 2){
					$arrData[$i]['status'] = '<span class="badge badge-success">Aprobado</span>';
				}

				if($arrData[$i]['tipo'] == 1)
				{
					$arrData[$i]['tipo'] = '<span>Desayuno</span>';
				}else{
					$arrData[$i]['tipo'] = '<span>Almuerzo</span>';
				}

				if($arrData[$i]['horario'] == 1)
				{
					$arrData[$i]['horario'] = '<span>Mañana</span>';
				}else{
					$arrData[$i]['horario'] = '<span>Tarde</span>';
				}

			if($_SESSION['permisosMod']['r']){

				         $btnView = ' <a title = "Ver información del menú" href = "'.base_url().'/menus/ingredientes?valor='.$arrData[$i]['idmenu'].'" target="_self" class="btn btn-info btn-sm"><i class="far fa-eye"></i></a> ';

						/*$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['idmenu'].')" title="Ver información del menú"><i class="far fa-eye"></i></button>';*/
					}

					if($_SESSION['permisosMod']['w']){

						$btnApro =  '<button class="btn btn-success btn-sm" onClick="fntApro('.$arrData[$i]['idmenu'].')" title="Aprobar Menú"><i class="fa fa-check-square" aria-hidden="true"></i></button>';
					}	

					if($_SESSION['permisosMod']['w']){			
						$btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo('.$arrData[$i]['idmenu'].')" title="Agregar Ingredientes"><i class="fa fa-lemon-o" aria-hidden="true"></i></button>';
					}
					if($_SESSION['permisosMod']['d']){
						$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idmenu'].')" title="Inavilitar Menú"><i class="far fa-trash-alt"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnApro.'  </div>';

				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
				die();
		}


         //Para registrar
		public function setMenu(){

			if($_POST){

				$intIdpersona = intval($_POST['idPersona']);
				$strNombrePlato = $_POST['nombrePlato'];
				$strDia = $_POST['dia'];
				$intTurno = intval($_POST['listTurno']);
				$intTipo = intval($_POST['listTipo']);

					//Crear
					if($_SESSION['permisosMod']['w']){
					$request_producto = $this->model->insertMenu($intIdpersona, $strNombrePlato, $strDia, $intTurno, $intTipo);
					$option = 1;
				}
				
				if($request_producto > 0 )
				{
					if($option == 1)
					{

						$arrResponse = array('status' => true, 'msg' => 'Guardados correctamente.');

					}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible crear el menú.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			
			die();
		}
	}

	public function setDetalles(){

                $idmenu = intval($_POST['menuId']);
				$intLisProducto = intval($_POST['listProducto']);
				$intCantidad = intval($_POST['cantidad']);
				
					//Crear
					if($_SESSION['permisosMod']['w']){
					$request_producto = $this->model->insertDetalle($idmenu, $intLisProducto, $intCantidad);
					$option = 1;
				}
				
				if($request_producto > 0 )
				{
					if($option == 1)
					{

						$arrResponse = array('status' => true, 'msg' => 'Ingredientes guardados correctamente.');

					}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible.');
				} 
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}	
			die();	
	}

	public function delMenu(){
		if($_POST){

				if($_SESSION['permisosMod']['d']){

					$intIdMenu = intval($_POST['idmenu']);
					$requestDelete = $this->model->deleteMenu($intIdMenu);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Menú');

					}else{

						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Menú.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			die();
		}
	}

	public function aproMenu(){

		if($_POST){

				if($_SESSION['permisosMod']['w']){

					$intIdMenu = intval($_POST['idmenu']);
					$requestApro = $this->model->aprobMenu($intIdMenu);
					if($requestApro == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha aprobado el Menú');

					}else{

						$arrResponse = array('status' => false, 'msg' => 'Cantidad Insuficiente en el Inventario.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			die();
		}
	}

	public function ingredientes(){

			$idmenu = $_GET['valor'];

		    $data['page_tag'] = " Ingredientes";
			$data['page_title'] = " Ingredientes";
			$data['page_name'] = "ingredientes";
			$data['page_functions_js'] = "functions_ingredientes.js";
			$data['ingredientes'] = $this->model->selectDetalle($idmenu);
			//dep($data['ingredientes']);
			//exit;
			$this->views->getView($this,"ingredientes",$data);
		
	}

	public function getIngredientes(){

		if($_SESSION['permisosMod']['r']){

						$arrData = $this->model->selectDetalle();
						for ($i=0; $i < count($arrData); $i++) {
						}
						echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
				}
				die();
	}

}
?> 