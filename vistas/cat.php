<?php
//Se activa el almacenamiento en bufer
ob_start();
session_start();

if(!isset($_SESSION["USUARI_NOMBRES"])){
  header("Location: index.php");
}else{

require 'header.php';
if($_SESSION['cat']==1){
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
                          <h1 class="box-title">Cat<button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Opciones</th>
                          <th>Codigo</th>
                          <th>Codigo GCI</th>
                          <th>Nombre</th>
                          <th>Email</th>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                          <th>Opciones</th>
                          <th>Codigo</th>
                          <th>Codigo GCI</th>
                          <th>Nombre</th>
                          <th>Email</th>
                        </tfoot>
                      </table>
                    </div>
                    <div class="panel-body" style="height: 500px;" id="formularioregistros">
                      <div class="container" id="advanced-search-form" style="height: 400px">
                        <h2 align="center">INGRESAR DATOS CAT</h2>
                        <form name="formulario" id="formulario" method="POST">
                          <table align="center">
                            <div class="form-row">
                              <tr>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 200px">
                                    <label>Código:</label>
                                    <input type="hidden" name="cat_id" id="cat_id">
                                    <input type="text" class="form-control"  name="cat_codigo" id="cat_codigo" size="4" >
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 400px">
                                    <label>Nombre:</label>
                                    <input type="text" class="form-control" name="cat_nombre" id="cat_nombre" style="text-transform: uppercase; text-decoration: none;">
                                  </div>
                                </td>
                              </tr>
                            </div>
                          </table>
                           <table align="center">
                            <div class="form-row">
                              <tr>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 200px">
                                    <label>Código GCI:</label>
                                    <input type="text" class="form-control" name="cat_codigogci" id="cat_codigogci">
                                  </div>
                                </td>
                                 <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 400px">
                                    <label>Email:</label>
                                    <input type="text" class="form-control" name="cat_email" id="cat_email">
                                  </div>
                                </td>
                              </tr>
                            </div>
                          </table>
                          <table align="center">
                            <td style="width: 200px" align="center">
                               <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>   Guardar</button>
                            </td>
                            <td style="width: 200px" align="center">
                                 <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i>    Cancelar</button>
                            </td>
                          </table>
                        </form>
                      </div>
                        
                    <!--Fin centro -->
                  </div><!-- /.box -->
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
<script type="text/javascript" src="scripts/cat.js"></script>
<?php
}
ob_end_flush();
?>
