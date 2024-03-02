let tableProductos;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){

    tableProductos = $('#tableProductos').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/productos/getProductos",
            "dataSrc":""
        },
        "columns":[
            {"data":"idproducto"},
            {"data":"nombre"},
            {"data":"descripcion"},
            {"data":"status"},
            {"data":"options"}
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary",
                "exportOptions":{
                    "columns": [0, 1, 2, 3]
                }
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Exportar a Excel",
                "className": "btn btn-success",
                "exportOptions":{
                    "columns": [0, 1, 2, 3]
                }
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Exportar a PDF",
                "className": "btn btn-danger",
                "exportOptions":{
                    "columns": [0, 1, 2, 3]
                }
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Exportar a CSV",
                "className": "btn btn-info",
                "exportOptions":{
                    "columns": [0, 1, 2, 3]
                }
            }
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

  //NUEVO PRODUCTO Y ACTUALIZACIÓN
    let formProducto = document.querySelector("#formProducto");
    formProducto.onsubmit = function(e) {
        e.preventDefault();

        let strNombre = document.querySelector('#NombreProducto').value;
        let strDescripcion = document.querySelector('#DescripcionProducto').value;
        let intStatus = document.querySelector('#listStatus').value;      
        if(strNombre == '' || strDescripcion == '' || intStatus == '')
        {
            swal("Atención", "Todos los campos son obligatorios." , "error");
            return false;
        }
        divLoading.style.display = "flex";
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Productos/setProducto'; 
        let formData = new FormData(formProducto);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
           if(request.readyState == 4 && request.status == 200){
                
                let objData = JSON.parse(request.responseText);
                if(objData.status)
                {

                    if(rowTable == ""){
                       tableProductos.api().ajax.reload();
                    }else{
                        htmlStatus = intStatus == 1 ?
                        '<span class="badge badge-success">Activo</span>' :
                        '<span class="badge badge-danger">Inactivo</span>';

                        rowTable.cells[1].textContent = strNombre;
                        rowTable.cells[2].textContent = strDescripcion;
                        rowTable.cells[3].innerHTML = htmlStatus;
                        rowTable = "";
                    }
                    $('#modalFormProducto').modal("hide");
                    formProducto.reset();
                    swal("Producto", objData.msg ,"success");
                    
                }else{
                    swal("Error", objData.msg , "error");
                }              
            }
            divLoading.style.display = "none";
            return false;
        }    
    }
}, false);

function fntViewInfo(idproducto){
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/productos/getProducto/'+idproducto;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status){

                let estado = objData.data.status == 1 ?
                '<span class="badge badge-success">Activo</span>' :
                '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector('#celId').innerHTML = objData.data.idproducto;
                document.querySelector('#celNombre').innerHTML = objData.data.nombre;
                document.querySelector('#celDescripcion').innerHTML = objData.data.descripcion;
                document.querySelector('#celFechaRegistro').innerHTML = objData.data.fechaRegistro;
                document.querySelector('#celEstado').innerHTML = estado;
                $('#modalViewProducto').modal('show');
            }else{
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditInfo(element, idproducto){

    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";
    document.querySelector('#titleModal').innerHTML = "Actualizar Producto";

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/productos/getProducto/'+idproducto;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status){

                document.querySelector('#idProducto').value = objData.data.idproducto;
                document.querySelector('#NombreProducto').value = objData.data.nombre;
                document.querySelector('#DescripcionProducto').value = objData.data.descripcion;

                if(objData.data.status == 1){
                    document.querySelector('#listStatus').value = 1;
                }else{
                    document.querySelector('#listStatus').value = 2;
                }
                $('#listStatus').selectpicker('render');
                $('#modalFormProducto').modal('show');
            }else{
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntDelInfo(idproducto){
         swal({
            title: "Eliminar Producto",
            text: "¿Realmente quiere eliminar el producto?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, eliminar",
            cancelButtonText: "No, cancelar",
            closeOnConfirm: false,
            closeOnCancel: true
            }, function(isConfirm){
            if(isConfirm){
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/productos/delProducto';
            let strData = "idProducto="+idproducto;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                let objData = JSON.parse(request.responseText);
                if(objData.status){
                    swal("Eliminar!", objData.msg , "success" );
                    tableProductos.api().ajax.reload();
                    }else{
                    swal("Atención", objData.msg , "error");
                    }
                }
             }

         }
    });
}

function openModal(){
    rowTable = "";
    document.querySelector('#idProducto').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Producto";
    document.querySelector("#formProducto").reset();
	$('#modalFormProducto').modal('show');
}