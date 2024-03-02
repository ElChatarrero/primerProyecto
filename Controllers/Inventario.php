<?php	
	class Inventario extends Controllers{
		public function __construct()
		{
			session_start();
			parent::__construct();			
			//session_regenerate_id(true);
			if (empty($_SESSION['login'])){
				header('Location: '.base_url().'/login');
			}
			getPermisos(4);
		}

		public function Inventario()
		{
			$data['page_tag'] = "Inventario";
			$data['page_title'] = " Inventario";
			$data['page_name'] = "inventario";
			$data['page_functions_js'] = "functions_inventario.js";
			$this->views->getView($this,"inventario",$data);
		}

		//Para listar
		public function getInventario(){

				if($_SESSION['permisosMod']['r']){
				    $arrData = $this->model->selectInventario();
				    $arrData2 = $this->model->selectIngredientes();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';

					for ($j = 0; $j < count($arrData2); $j++){

						if ($arrData[$i]['productoid'] == $arrData2[$j]['productoid']){
							$inventario = $arrData[$i]['total'];
						$ingredientes = $arrData2[$j]['total'];
						$arrData[$i]['total'] = $inventario - $ingredientes;
						}
					}
					if($_SESSION['permisosMod']['r']){
						$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo()" title="Detalles"><i class="fas fa-barcode"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center"> '.$btnView.' </div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
				die();
		}

		//Para registrar
		public function setInventario(){

			if($_POST){

				$strProducto =  intval($_POST['listProducto']);
				$fechaIngreso = $_POST['fechaIngreso'];
				$intCantidad = intval($_POST['cantidad']);

				
					//Crear
					if($_SESSION['permisosMod']['w']){
					$request_producto = $this->model->insertInventario($strProducto, $fechaIngreso, $intCantidad);
					$option = 1;
				}
				
				if($request_producto > 0 )
				{
					if($option == 1)
					{

						$arrResponse = array('status' => true, 'msg' => 'Guardados correctamente.');

					}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			
			die();
		}
	}

	public function detalles(){

		$data['page_tag'] = " Detalles";
			$data['page_title'] = " Detalles";
			$data['page_name'] = "detalles";
			$data['page_functions_js'] = "functions_detalles.js";
			$this->views->getView($this,"detalles",$data);
	}

	public function getDetalles(){

		if($_SESSION['permisosMod']['r']){  
				    $arrData = $this->model->selectDetalles();
				for ($i=0; $i < count($arrData); $i++) {
					
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
				die();
	}
}
?>