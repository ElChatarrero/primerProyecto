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
   <td style="text-align: center;    width: 34%"><h4>Liceo Antonio Guzmán Blanco</h4></td>
   <td style="text-align: right;    width: 33%"><?= date('d/m/Y'); ?></td>
   </tr>
    </table>
       <table style="width: 100%; border: 0px;" align="center">
       <tr>
        <td><h3>Listado Actual del Inventario</h3></td>
       </tr>
       </table>
        <table align="center" width="100%">
                  <thead>                          
                    <tr>
                    <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Nro.</th>
                    <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Nombre del Producto</th>
                    <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Stock</th>
                    <th style="width: 30%; text-align: center; border: solid 1px #D2691E; background: #2E64FE; color:#FFFFFF">Últ Fecha de Ingreso</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php
$i = 1;
foreach ($data as $datos) {	
?>
                    <tr>
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $i; ?></td>
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $datos['producto']; ?></td>
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $datos['total']; ?> </td>   
                    <td style="width: 20%; text-align: center; border: solid 1px black;"><?= $datos['fecha_ingreso']; ?></td>
                    </tr>
                    <?php $i++;}?>
                    </tbody>
       </table>          
</body>
</html>