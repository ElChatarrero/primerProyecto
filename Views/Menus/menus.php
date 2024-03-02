<?php  headerAdmin($data); ?>
<div id="contentAjax"></div> 
    <main class="app-content">
      <?php
    getModal('modalMenus',$data);
    getModal('modalIngredientes',$data);
    if(empty($_SESSION['permisosMod']['r'])){
?>
<p> Accseso restringido </p>
      <?php
    }else { ?>
      <div class="app-title">
        <div>
            <h1><i class="app-menu__icon fa fa-cutlery"></i><?= $data['page_title'] ?>
            <?php if($_SESSION['permisosMod']['w']){ ?>
                <button class="btn btn-light" type="button" onclick="openModal();" ><i class="fas fa-plus-circle"></i> Nuevo</button>
                <?php } ?>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/menus"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableMenus">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Día</th>
                          <th>Nombre del Plato</th>
                          <th>Turno</th>
                          <th>Tipo</th>
                          <th>Estado</th>
                          <th>Acciones</th>
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