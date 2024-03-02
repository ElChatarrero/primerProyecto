<?php  headerAdmin($data); ?>
<div id="contentAjax"></div> 
    <main class="app-content">
      <?php
    if(empty($_SESSION['permisosMod']['r'])){
?>
<p> Accseso restringido </p>
      <?php
    }else { ?>
      <div class="app-title">
        <div>
            <h1><i class="app-menu__icon fa fa-balance-scale"></i><?= $data['page_title'] ?>
            
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/inventario/detalles"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableDetalles">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nombre</th>
                          <th>Cantidad</th>
                          <th>Fecha de Ingreso</th>                   
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
      <?php } ?>
    </main>
<?php footerAdmin($data); ?> 