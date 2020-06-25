<?php
//Se activa el almacenamiento en bufer
ob_start();
session_start();

if(!isset($_SESSION["USUARI_NOMBRES"])){
  header("Location: index.php");
}else{

require 'header.php';
if($_SESSION['privi_catprogra']==1){
?> 

<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Privilegios Cats-Programas</h1>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Nombre</th>
                          <th>Usuario</th>
                          <th>Cats</th>
                          <th>Programas</th>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                          <th>Nombre</th>
                          <th>Usuario</th>
                          <th>Cats</th>
                          <th>Programas</th>
                        </tfoot>
                      </table>
                    </div>
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

<?php 
}else{
  require 'noacceso.php';
}
require 'footer.php';
?>
<script type="text/javascript" src="scripts/priv_catprogra.js"></script>
<?php
}
ob_end_flush();
?>
