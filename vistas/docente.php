<?php
//Se activa el almacenamiento en bufer
ob_start();
session_start();
if(!isset($_SESSION["USUARI_NOMBRES"])){
  header("Location: index.php");
}else{ 

require 'header.php';
if($_SESSION['docente']==1){
  
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
                          <h1 class="box-title">Docentes  <button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Opciones</th>
                          <th>Documento</th>
                          <th>Nombre</th>
                          <th>Fecha Ingreso</th>
                          <th>Perfil</th>
                          <th>Residencia</th>
                          <th>Telefono - Celular</th>
                          <th>Email</th>
                          <th>Planta</th>
                          <th>Grupo</th>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                          <th>Opciones</th>
                          <th>Documento</th>
                          <th>Nombre</th>
                          <th>Fecha Ingreso</th>
                          <th>Perfil</th>
                          <th>Residencia</th>
                          <th>Telefono - Celular</th>
                          <th>Email</th>
                          <th>Planta</th>
                          <th>Grupo</th>
                        </tfoot>
                      </table>
                    </div>
                    <div class="panel-body" style="height: 500px;" id="formularioregistros">
                      <div class="container" id="advanced-search-form" style="margin-left: 0px">
                        <h2 align="center">INGRESAR DATOS DOCENTE</h2>
                        <form name="formulario" id="formulario" method="POST">
                          <table>
                            <div class="form-row">
                              <tr>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 160px;margin-left: 0px">
                                    <label>Documento:</label>
                                    <input type="hidden" name="docent_id" id="docent_id">
                                    <input type="text" class="form-control"  name="docent_documento" id="docent_documento" size="30" >
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 160px;margin-left: 0px">
                                    <label>Lugar Expedición:</label>
                                    <input type="text" class="form-control" name="docent_lugarexp" id="docent_lugarexp" style="text-transform: uppercase; text-decoration: none;">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 350px;margin-left: 0px">
                                    <label>Nombre:</label>
                                    <input type="text" class="form-control" name="docent_nombre" id="docent_nombre" style="text-transform: uppercase; text-decoration: none;">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 160px;margin-left: 0px">
                                    <label>Fecha Ingreso:</label>
                                    <input size="16" type="text" class="form-control" name="docent_fechaing" id="docent_fechaing">
                                  </div>
                                </td>
                              </tr>
                            </div>
                          </table>
                          <table>
                            <div class="form-row">
                              <tr>
                                
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 250px;margin-left: 0px">
                                    <label>Residencia:</label>
                                    <input type="text" class="form-control" name="docent_residencia" id="docent_residencia" style="text-transform: uppercase; text-decoration: none;">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 160px;margin-left: 0px">
                                    <label>Telefono:</label>
                                    <input type="text" class="form-control" name="docent_telefono" id="docent_telefono" >
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 160px;margin-left: 0px">
                                    <label>Celular:</label>
                                    <input type="text" class="form-control" name="docent_celular" id="docent_celular">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 250px;margin-left: 0px">
                                    <label>Email Institucional:</label>
                                    <input type="text" class="form-control" name="docent_emailinst" id="docent_emailinst">
                                  </div>
                                </td>
                              </tr>
                            </div>
                          </table>
                          <table>
                            <div class="form-row">
                              <tr>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 250px;margin-left: 0px">
                                    <label>Email Personal:</label>
                                    <input type="text" class="form-control" name="docent_emailpers" id="docent_emailpers" >
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 400px;margin-left: 0px">
                                    <label>Perfil:</label>
                                    <input type="text" class="form-control" name="docent_perfil" id="docent_perfil">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 120px;margin-left: 0px">
                                    <label>Es de Planta?</label>
                                    <select class="form-control" name="docent_planta" id="docent_planta">
                                      <option value="" selected>SELECCIONE</option>
                                      <option value="1">SI</option>
                                      <option value="2">NO</option>
                                    </select>

                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 120px;margin-left: 0px">
                                    <label>Grupos:</label>
                                    <input type="text" class="form-control" name="docent_grupos" id="docent_grupos">
                                  </div>
                                </td>
                              </tr>
                            </div>
                          </table>
                          <table align="center">
                            <td style="width: 200px" align="center">
                               <button class="btn btn-primary" type="submit"  id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>
                            </td>
                            <td style="width: 200px" align="center">
                                 <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i>  Cancelar</button>
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
<script type="text/javascript" src="scripts/docente.js"></script>
<?php
}
ob_end_flush();
?>