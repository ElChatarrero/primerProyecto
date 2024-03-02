<?php  
class Ingredientes extends Controllers{
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

		public function ingredientes(){

		
		    $data['page_tag'] = " Ingredientes";
			$data['page_title'] = " Ingredientes";
			$data['page_name'] = "ingredientes";
			$data['page_functions_js'] = "functions_ingredientes.js";
			$this->views->getView($this,"ingredientes",$data);
		}

	public function getIngredientes(){

		if($_SESSION['permisosMod']['r']){

			if($_GET){
			$idmenu = intval($_GET['valor']);

						$arrData = $this->model->selectDetalle($dato);
						for ($i=0; $i < count($arrData); $i++) {
						}
						echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
				}
				die();
	}
}

}
?>