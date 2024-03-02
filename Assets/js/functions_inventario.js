let tableInventario;
//let rowTable = "";
window.addEventListener('load', function(){
	fntProductos();

	tableInventario = $('#tableInventario').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Inventario/getInventario",
            "dataSrc":""
        },
        "columns":[
            {"data":"idinventario"},
            {"data":"producto"},
            {"data":"total"},
            {"data":"options"}
        ],
        "columnDefs": [
        	{'className': "textcenter", "targets": [ 2 ]}
        	],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary",
                "exportOptions":{
                	"columns": [0, 1, 2]
                }
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Exportar a Excel",
                "className": "btn btn-success",
                "exportOptions":{
                	"columns": [0, 1, 2]
                }
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Exportar a PDF",
                "className": "btn btn-danger",
                "exportOptions":{
                	"columns": [0, 1, 2]
                }
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Exportar a CSV",
                "className": "btn btn-info",
                "exportOptions":{
                	"columns": [0, 1, 2]
                }
            }
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

    if(document.querySelector('#formInventario')){
        let formInventario = document.querySelector("#formInventario");
        formInventario.onsubmit = function(e){
            e.preventDefault();
            let strNombre = document.querySelector('#listProducto');
            let strFecha = document.querySelector('#fechaIngreso');
            let intStock = document.querySelector('#cantidad');

            if( intStock == ""){
                swal ("Atención", "Ingrese la Cantidad.", "info");
                return false;
            }
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Inventario/setInventario';
            let formData = new FormData(formInventario);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){

                let objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    $('#modalFormInventario').modal("hide");
                    formInventario.reset();
                    swal("Productos", objData.msg ,"success");
                    tableInventario.api().ajax.reload();
                }else{
                    swal("Error", objData.msg , "error");
                }
            }
                divLoading.style.display = "none";
            }

        }
    }



}, false);

function openModal(){
    //rowTable = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Ingreso de productos al inventario";
    document.querySelector("#formInventario").reset();
	$('#modalFormInventario').modal('show');
}

//Para traer los nombres de los Productos
function fntProductos(){
	if(document.querySelector('#listProducto')){
		let ajaxUrl = base_url+'/Productos/getSelectProductos';
		let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		request.open("GET",ajaxUrl,true);
		request.send();
		request.onreadystatechange = function(){
			if (request.readyState == 4 && request.status == 200){
				document.querySelector('#listProducto').innerHTML = request.responseText;
				$('#listProducto').selectpicker('render');
			}
		}

	}
}

function fntViewInfo(){
     window.location.href = "http://localhost/proyecto/inventario/detalles";
}