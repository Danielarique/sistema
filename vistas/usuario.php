<?php
//Se activa el almacenamiento en bufer
ob_start();
session_start();

if(!isset($_SESSION["USUARI_NOMBRES"])){
  header("Location: index.php");
}else{

require 'header.php';
if($_SESSION['usuario']==1){
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
                          <h1 class="box-title">Usuarios  <button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Opciones</th>
                          <th>Nombres</th>
                          <th>Usuario</th>
                          <th>Email</th>
                          <th>Rol</th>
                          <th>Estado</th>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                          <th>Opciones</th>
                          <th>Nombres</th>
                          <th>Usuario</th>
                          <th>Email</th>
                          <th>Rol</th>
                          <th>Estado</th>
                        </tfoot>
                      </table>
                    </div>
                    <div class="panel-body" style="height: 500px;" id="formularioregistros">
                      <div class="container" id="advanced-search-form" style="height: 400px">
                        <h2 align="center">INGRESAR DATOS USUARIO</h2>
                        <form name="formulario" id="formulario" method="POST">
                          <table align="center">
                            <div class="form-row">
                              <tr>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 400px">
                                    <label>Nombres:</label>
                                    <input type="hidden" name="usuari_id" id="usuari_id">
                                    <input type="text" class="form-control"  name="usuari_nombres" id="usuari_nombres" size="4" >
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 200px">
                                    <label>Usuario:</label>
                                    <input type="text" class="form-control" name="usuari_usuario" id="usuari_usuario" style="text-transform: uppercase; text-decoration: none;" onkeyup="sinEspa(this.value);">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 200px">
                                    <label>Password:</label>
                                    <input type="password" class="form-control" name="usuari_password" id="usuari_password" style="text-transform: uppercase; text-decoration: none;">
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
                                    <label>Email:</label>
                                    <input type="email" class="form-control" name="usuari_email" id="usuari_email">
                                  </div>
                                </td>
                                 <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 200px">
                                    <label>Rol:</label>
                                    <input type="text" class="form-control" name="usuari_rol" id="usuari_rol">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 200px">
                                    <label>Estado:</label>
                                    <select class="form-control" name="usuari_estado" id="usuari_estado">
                                      <option value="" selected>SELECCIONE</option>
                                      <option value="1">ACTIVO</option>
                                      <option value="2">DESACTIVO</option>
                                    </select>

                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 200px">
                                    <label>Privilegios Modulos:</label>
                                    <ul style="list-style: none;" id="privil_modulo">     
                                    </ul>
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
<script type="text/javascript" src="scripts/usuario.js"></script>
<script type="text/javascript" src="scripts/valiForm.js"></script>
<?php
}
ob_end_flush();
?>
