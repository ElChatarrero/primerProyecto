
let tableMenu;
//let rowTable = "";
window.addEventListener('load', function(){
    fntProductos();

    tableMenu = $('#tableMenus').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Menus/getMenu",
            "dataSrc":""
        },
        "columns":[
            {"data":"idmenu"},
            {"data":"dia"},
            {"data":"nombre_plato"},
            {"data":"horario"},
            {"data":"tipo"},
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
                    "columns": [0, 1, 2, 3, 4, 5]
                }
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Exportar a Excel",
                "className": "btn btn-success",
                "exportOptions":{
                    "columns": [0, 1, 2, 3, 4, 5]
                }
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Exportar a PDF",
                "className": "btn btn-danger",
                "exportOptions":{
                    "columns": [0, 1, 2, 3, 4, 5]
                }
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Exportar a CSV",
                "className": "btn btn-info",
                "exportOptions":{
                    "columns": [0, 1, 2, 3, 4, 5]
                }
            }
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

    if(document.querySelector('#formMenu')){
        let formMenu = document.querySelector("#formMenu");
        formMenu.onsubmit = function(e){
            e.preventDefault();

            let intIdpersona = document.querySelector('#idPersona');
            let strNombrePlato = document.querySelector('#nombrePlato');
            let strDia = document.querySelector('#dia');
            let intTurno = document.querySelector('#listTurno');
            let intTipo = document.querySelector('#listTipo');

            if( strNombrePlato == "" || intTurno == ""|| intTipo == ""){
                swal ("Atención", "Ingrese todos los datos.", "info");
                return false;
            }
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Menus/setMenu';
            let formData = new FormData(formMenu);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){

                let objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    $('#modalMenu').modal("hide");
                    formMenu.reset();
                    swal("Menú", objData.msg ,"success");
                    tableMenu.api().ajax.reload();
                }else{
                    swal("Error", objData.msg , "error");
                }
            }
                divLoading.style.display = "none";
            }

        }
    }
}, false);

function fntViewInfo(){
    window.location.href = "http://localhost/proyecto/menus/ingredientes";
}


function fntEditInfo(idmenu){
    $('#modalIngredientes').modal('show');
    document.querySelector("#menuId").value = idmenu;
    if(document.querySelector('#formIngredientes')){
        let formIngredientes = document.querySelector("#formIngredientes");
        formIngredientes.onsubmit = function(e){
            e.preventDefault();

            let intIdMenu = document.querySelector('#menuId');
            let intLisProducto = document.querySelector('#listProducto');
            let intCantidad = document.querySelector('#cantidad');    

            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Menus/setDetalles';
            let formData = new FormData(formIngredientes);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){

                let objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    $('#modalIngredientes').modal("hide");
                    formIngredientes.reset();
                    swal("Ingredientes", objData.msg ,"success");
                    tableMenu.api().ajax.reload();
                }else{
                    swal("Error", objData.msg , "error");
                }
            }
                divLoading.style.display = "none";
            }

        }
    }
}

function fntDelInfo(idmenu){
         swal({
            title: "Eliminar Menú",
            text: "¿Realmente quiere eliminar el Menú?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, eliminar",
            cancelButtonText: "No, cancelar",
            closeOnConfirm: false,
            closeOnCancel: true
            }, function(isConfirm){
            if(isConfirm){
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/menus/delMenu';
            let strData = "idmenu="+idmenu;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                let objData = JSON.parse(request.responseText);
                if(objData.status){
                    swal("Eliminar!", objData.msg , "success" );
                    tableMenu.api().ajax.reload();
                    }else{
                    swal("Atención", objData.msg , "error");
                    }
                }
             }

         }
    });
}

function fntApro(idmenu){

    swal({
            title: "Aprobar Menú",
            text: "¿Realmente quiere aprobar el Menú?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, aprobar",
            cancelButtonText: "No, cancelar",
            closeOnConfirm: false,
            closeOnCancel: true
            }, function(isConfirm){
            if(isConfirm){
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/menus/aproMenu';
            let strData = "idmenu="+idmenu;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                let objData = JSON.parse(request.responseText);
                if(objData.status){
                    swal("Aprobardo!", objData.msg , "success" );
                    tableMenu.api().ajax.reload();
                    }else{
                    swal("Atención", objData.msg , "error");
                    }
                }
             }

         }
    });
}

function openModal(){
    //rowTable = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Menú del Dia";
    document.querySelector("#formMenu").reset();
	$('#modalMenu').modal('show');
}

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
