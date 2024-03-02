<?php headerAdmin($data); ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i><?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">Bienvenido, <?= $_SESSION['userData']['nombre'].' '.$_SESSION['userData']['apellido']; ?></div>
          </div>
        </div>
      </div>
      <div class="row">
        <?php if(!empty($_SESSION['permisos'][2]['r'])) { ?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url(); ?>/usuarios" class="linkw">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Usuarios</h4>
              <p><b><?= $data['usuarios']; ?></b></p>
            </div>
          </div>
        </a>
        </div>
      <?php } ?>
      <?php if(!empty($_SESSION['permisos'][4]['r'])) { ?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url(); ?>/inventario" class="linkw">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-balance-scale fa-3x"></i>
            <div class="info">
              <h4>Inventario</h4>
              <p><b><?= $data['inventario']; ?></b></p>
            </div>
          </div>
          </a>
        </div>
        <?php } ?>
        <?php if(!empty($_SESSION['permisos'][3]['r'])) { ?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url(); ?>/productos" class="linkw">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-cubes fa-3x"></i>
            <div class="info">
              <h4>Productos</h4>
              <p><b><?= $data['productos']; ?></b></p>
            </div>
          </div>
        </a>
        </div>
        <?php } ?>
        <?php if(!empty($_SESSION['permisos'][5]['r'])) { ?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url(); ?>/menus" class="linkw">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-cutlery fa-3x"></i>
            <div class="info">
              <h4>Menús</h4>
              <p><b><?= $data['menus']; ?></b></p>
            </div>
          </div>
        </a>
        </div>
        <?php } ?>
      </div>
      <div class="row">
        <?php if(!empty($_SESSION['permisos'][5]['r'])) { ?>
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Ultimos Menús Aprobados</h3>
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Día</th>
                  <th>Nombre del Plato</th>
                  <th>Turno</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody>
                <?php if(count($data['ultiMenu']) > 0) {
                  foreach ($data['ultiMenu'] as $menus) {

                  if($menus['horario'] == 1){
                      $menus['horario'] = '<span>Mañana</span>';
                    }else{
                      $menus['horario'] = '<span>Tarde</span>';
                    }

                    if($menus['status'] == 2){
                       $menus['status'] = '<span class="badge badge-success">Aprobado</span>';
                      }
                 ?>
                <tr>
                  <td><?= $menus['idmenu']?></td>
                  <td><?= $menus['dia']?></td>
                  <td><?= $menus['nombre_plato']?></td>
                  <td><?= $menus['horario']?></td>
                  <td><?= $menus['status']?></td>
                </tr>
                <?php }
              } ?>
              </tbody>
            </table>
          </div>
        </div>
      <?php } ?>

      <div class="col-md-6">
          <div class="tile">
            <div class="container-title"> 
            <h3 class="tile-title">Inventario</h3>
          </div>

          </div>

          <div id="inventario"></div>

        </div>
      </div>
    </main>
<?php footerAdmin($data); ?>
    
    <script>
      Highcharts.chart('inventario', {
        chart: {
        type: 'pie'
    },
    title: {
        text: 'Productos más usado'
    },
    tooltip: {
        valueSuffix: ''
    },
  
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: [{
                enabled: true,
                distance: 20
            }, {
                enabled: true,
                distance: -40,
                format: '{point.percentage:.1f}%',
                style: {
                    fontSize: '1.2em',
                    textOutline: 'none',
                    opacity: 0.7
                },
                filter: {
                    operator: '>',
                    property: 'percentage',
                    value: 10
                }
            }]
        }
    },
    series: [
        {
            name: 'Nro de Productos Usados',
            colorByPoint: true,
            data: [
              <?php 
                foreach ($data['stock'] as $datos){
                  
                  echo "{name:'".$datos['nombre']."',y:".$datos['cantidad']."},";
                }
               ?>
                ]
        }]
});
    </script>