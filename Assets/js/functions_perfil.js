function openModalPerfil(){
    $('#modalFormPerfil').modal('show');
}
var divLoading = document.querySelector("#divLoading");
if(document.querySelector("#formPerfil")){
    var formPerfil = document.querySelector("#formPerfil");
    var base_url = 'http://localhost/proyecto';
    formPerfil.onsubmit = function(e){
        e.preventDefault();
        var strNacionalidad = document.querySelector('#txtNacionalidad').value;
        var strCedula = document.querySelector('#txtCedula').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var strApellido = document.querySelector('#txtApellido').value;
        var intTelefono = document.querySelector('#txtTelefono').value;
        var strPassword = document.querySelector('#txtPassword').value;
        var strPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;

        if(strNacionalidad == '' || strCedula == '' || strApellido == '' || strNombre == '' || intTelefono == '')
        {
            swal("Atención", "Todos los campos son obligatorios." , "error");
            return false;
        }

        if(strPassword != "" || strPasswordConfirm != ""){

            if(strPassword != strPasswordConfirm){
                swal("Atención", "las contraseñas no son iguales." , "info");
                return false;
            }
            if(strPassword.length < 6 ){
                swal("Atención", "La contraseña debe tener mínimo 6 caracteres.", "info");
                return false;
            }
        }

        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) { 
            if(elementsValid[i].classList.contains('is-invalid')) { 
                swal("Atención", "Por favor verifique los campos en rojo." , "error");
                return false;
            } 
        }
        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Usuarios/putPerfil';
        var formData = new FormData(formPerfil);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
            if(request.readyState != 4) return;
            if(request.status == 200){
                var objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    $('#modalFormPerfil').modal("hide");
                    swal({
                        title: "",
                        text: objData.msg,
                        type: "success",
                        confirmButtonText: "Aceptar",
                        closeOnConfirm: false,
                    }, function(isConfirm){
                        if(isConfirm){
                            location.reload();
                        }
                    });   
                }else{
                    swal("Error", objData.msg , "error");
                }
            }
            divLoading.style.display = "none";
            return false;
        }
    }
}