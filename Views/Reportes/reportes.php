<?php headerAdmin($data); ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-pdf-o"></i><?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/reportes">Reportes</a></li>
        </ul>
      </div>
      <div class="row">
        <?php if(!empty($_SESSION['permisos'][2]['r'])) { ?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url(); ?>/reportes/reporteUsu" class="linkw" title="Generar PDF" target="_blank">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-file-pdf-o fa-3x"></i>
            <div class="info">
              <h4>Listado de todo los Usuarios</h4>
            </div>
          </div>
        </a>
        </div>
      <?php } ?>
      <?php if(!empty($_SESSION['permisos'][4]['r'])) { ?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url(); ?>/reportes/reporteInven" class="linkw" title="Generar PDF" target="_blank">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa fa-file-pdf-o fa-3x"></i>
            <div class="info">
              <h4>Listado de todo el Inventario Actual</h4>
            </div>
          </div>
          </a>
        </div>
        <?php } ?>
        <?php if(!empty($_SESSION['permisos'][3]['r'])) { ?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url(); ?>/reportes/reportePro" class="linkw" title="Generar PDF" target="_blank">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa fa-file-pdf-o fa-3x"></i>
            <div class="info">
              <h4>Listado de todos los Productos</h4>
            </div>
          </div>
        </a>
        </div>
        <?php } ?>
        <?php if(!empty($_SESSION['permisos'][5]['r'])) { ?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url(); ?>/reportes/reporteMenu" class="linkw" title="Generar PDF" target="_blank">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa fa-file-pdf-o fa-3x"></i>
            <div class="info">
              <h4>Listado de todos los Menús</h4>
            </div>
          </div>
        </a>
        </div>
        <?php } ?>
      </div>

      <?php footerAdmin($data); ?>