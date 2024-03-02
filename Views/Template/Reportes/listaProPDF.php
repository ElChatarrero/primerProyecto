<html>
<head>
<lang="es">
<meta charset="utf-8">  
<title>Sistema AGB</title>
<link rel="shortcut icon" href="<?= media();?>/images/guzzman.png" type="image/x-icon">
<style> 
body{
   font-family: Arial;
    }
th, td{
  padding: 10px 0;
}
</style>
</head>
<body>                         
  <table style="width: 100%; border: 0px;">
  <tr>
  <td style="text-align: left;    width: 33%"><img src="<?= media();?>/images/guzzman.png" width="100"></td>
  <td style="text-align: center;    width: 34%">Liceo Antonio Guzmán Blanco</td>
  <td style="text-align: right;    width: 33%"><?= date('d/m/Y'); ?></td>
  </tr>
  </table>
       <table style="width: 100%; border: 0px;" align="center">
       <tr>
       <td><h3>Listado de Productos</h3></td>
       </tr>
       </table>
       <table align="center" width="100%">
       <thead>  
       <tr>
       <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Nro.</th>
       <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Nombre del Producto</th>
       <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Descripción</th>
       <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Fecha de Registro</th>
       <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Estado</th>
       </tr>
       </thead>
       <tbody>
<?php
$i = 1;
foreach ($data as $datos) {
  if($datos['status'] == 1){
    $datos['status'] = '<span class="badge badge-success">Activo</span>';   
  }else{
    $datos['status'] = '<span class="badge badge-danger">Inactivo</span>';
  }
?>
                    <tr>
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $i; ?></td>
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $datos['nombre']; ?></td>
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $datos['descripcion']; ?> </td>
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $datos['fecha']; ?> </td>  
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $datos['status']; ?></td>                                               
                    </tr>
                  <?php $i++;
                  }?>
        </tbody>
        </table>        
</body>
</html>