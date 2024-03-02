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
  width:auto;
}
  </style>
</head>
<body>                           
    <table style="width: 100%; border: 0px;">
    <tr>
    <td style="text-align: left;    width: 33%"><img src="<?= media();?>/images/guzzman.png" width="100"></td>
    <td style="text-align: center;    width: 34%"><h4>Liceo Antonio Guzmán Blanco</h4></td>
            <td style="text-align: right;    width: 33%"><?= date('d/m/Y'); ?></td>
            </tr>
    </table>
       <table style="width: 100%; border: 0px;" align="center">
       <tr>
        <td><h3>Listado de Usuarios</h3></td>
       </tr>
    </table>
        <table width="100%" > 
                    <thead>                               
                    <tr>
                    <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Nro.</th>
                    <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Nombre y Apellido</th>
                    <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Teléfono</th>
                    <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Correo Electronico</th>
                    <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Fecha de Registro</th>
                    <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Estado</th>
                    <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Rol</th>                                 </tr>
                    </thead>
                    <tbody>
<?php
$i=0;
while($i<count($data)){
  if($data[$i]['status'] == 1){
    $data[$i]['status'] = '<span class="badge badge-success">Activo</span>';   
  }else{
    $data[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
  }
?>
                    <tr>
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $data[$i]['idpersona']; ?></td>
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $data[$i]['nombre']." ".$data[$i]['apellido']; ?></td>
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $data[$i]['telefono']; ?> </td>   
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $data[$i]['correo']; ?></td>
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $data[$i]['fecha']; ?></td>
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $data[$i]['status']; ?></td>
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $data[$i]['nombrerol']; ?></td>                                  
                    </tr>
                    <?php  $i++;}?>             
                    </tbody>
       </table>              
</body>
</html>