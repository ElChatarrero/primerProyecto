<?php 

	require 'Libraries/html2pdf/vendor/autoload.php';
	use Spipu\Html2Pdf\Html2Pdf;
class Reportes extends Controllers{
		public function __construct()
		{
			session_start();
			parent::__construct();			
			//session_regenerate_id(true);
			if (empty($_SESSION['login'])){
				header('Location: '.base_url().'/login');
			}
			getPermisos(6);
		}

		public function Reportes(){

				$data['page_tag'] = " Reportes";
				$data['page_title'] = " Reportes";
				$data['page_name'] = "reportes";
				$data['page_functions_js'] = "functions_menus.js";
				$this->views->getView($this,"reportes",$data);
		}

		public function reporteUsu(){

			if ($_SESSION['permisosMod']['r']){
				$data = $this->model->reportUsu();
			ob_end_clean();
			$html = getFile("Template/Reportes/listaUsuPDF",$data);

			$html2pdf = new Html2Pdf('p', 'A4', 'es', 'true', 'UTF-8');
			$html2pdf->writeHTML($html);
			$html2pdf->output('Listado de Usuarios.pdf');
			}else{
				echo "Acceso Negado";
			}
		}

		public function reporteInven(){

			if ($_SESSION['permisosMod']['r']){
				$data = $this->model->reportInven();
				$data2 = $this->model->resInven();

				for ($i=0; $i < count($data); $i++) {
					$btnView = '';

					for ($j = 0; $j < count($data2); $j++){

						if ($data[$i]['productoid'] == $data2[$j]['productoid']){
							$inventario = $data[$i]['total'];
						    $ingredientes = $data2[$j]['total'];
						    $data[$i]['total'] = $inventario - $ingredientes;
						}
					}
				}
			ob_end_clean();
			$html = getFile("Template/Reportes/listaInvenPDF",$data);

			$html2pdf = new Html2Pdf('p', 'A4', 'es', 'true', 'UTF-8');
			$html2pdf->writeHTML($html);
			$html2pdf->output('Listado del Inventario.pdf');
			}else{
				echo "Acceso Negado";
			}
		}

		public function reportePro(){

			if ($_SESSION['permisosMod']['r']){
				$data = $this->model->reportPro();
			ob_end_clean();
			$html = getFile("Template/Reportes/listaProPDF",$data);

			$html2pdf = new Html2Pdf('p', 'A4', 'es', 'true', 'UTF-8');
			$html2pdf->writeHTML($html);
			$html2pdf->output('Listado de Productos.pdf');
			}else{
				echo "Acceso Negado";
			}
		}

		public function reporteMenu(){

			if ($_SESSION['permisosMod']['r']){
				$data = $this->model->reportMenu();
			ob_end_clean();
			$html = getFile("Template/Reportes/listaMenuPDF",$data);

			$html2pdf = new Html2Pdf('p', 'A4', 'es', 'true', 'UTF-8');
			$html2pdf->writeHTML($html);
			$html2pdf->output('Listado del Menu.pdf');
			}else{
				echo "Acceso Negado";
			}
		}

	}
 ?>