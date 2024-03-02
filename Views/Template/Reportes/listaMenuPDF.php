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
       <td><h3>Listado de Menús</h3></td>
       </tr>
       </table>
            <table align="center" width="100%">
                  <thead>                                                 
                  <tr>
                    <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Nro.</th>
                    <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Día</th>
                    <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Nombre del Plato</th>
                    <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Horario</th>
                    <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Tipo</th>
                    <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Hecho por</th>
                    <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Estado</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php
$i = 1;
foreach ($data as $datos){

  if($datos['status'] == 0){

            $datos['status'] = '<span class="badge badge-danger">Inavilitado</span>';
          }

          if($datos['status'] == 1)
        {
          $datos['status'] = '<span class="badge badge-danger">Por aprobación</span>';
        }

        if($datos['status'] == 2){
          $datos['status'] = '<span class="badge badge-success">Aprobado</span>';
        }

        if($datos['tipo'] == 1)
        {
          $datos['tipo'] = '<span>Desayuno</span>';
        }else{
          $datos['tipo'] = '<span>Almuerzo</span>';
        }

        if($datos['horario'] == 1)
        {
          $datos['horario'] = '<span>Mañana</span>';
        }else{
          $datos['horario'] = '<span>Tarde</span>';
        }
?>
                  <tr>
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $i; ?></td>
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $datos['dia']; ?></td>
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $datos['nombre_plato']; ?> </td> 
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $datos['horario']; ?> </td>
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $datos['tipo']; ?> </td>
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $datos['nombre']. ' '.$datos['apellido']; ?> </td> 
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $datos['status']; ?></td>                                               
                  </tr>
                  <?php $i++;
                   }?>
                  </tbody>
                </table>
              
</body>
</html>