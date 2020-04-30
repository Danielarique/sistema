<?php
//Se activa el almacenamiento en bufer
ob_start();
session_start();

if(!isset($_SESSION["USUARI_NOMBRES"])){
  header("Location: index.php");
}else{

require 'header.php';
if($_SESSION['asignacion']==1){
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
                          <h1 class="box-title">ASIGNACIÓN ACADÉMICA<button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Opciones</th>
                          <th>Cod. CAT</th>
                          <th>Nombre CAT</th>
                          <th>Cod. Programa</th>
                          <th>Nombre Programa</th>
                          <th>Semestre</th>
                          <th>Grupo</th>
                          <th>Cod. Curso</th>
                          <th>Nombre Curso</th>
                          <th>Perfil Establecido</th>
                          <th>Semana</th>
                          <th>Día</th>
                          <th>Hora</th>
                          <th>Horas Curso</th>
                          <th>Horas Art. Curso</th>
                          <th>Horas Prac. Curso</th>
                          <th>Horas lider art. curso</th>
                          <th>Doc. Docente</th>
                          <th>Nombre Docente</th>
                          <th>Perfil Docente</th>   
                          <th>Residencia Docente</th>
                          <th>Teléfono Docente</th>
                          <th>Celular Docente</th>
                          <th>Email Inst. Docente</th>
                          <th>Email Pers. Docente</th>
                          <th>Planta</th>
                          <th>Ciudad Origen</th>
                          <th>Ciudad Destino</th>
                          <th>Salón</th>
                          <th>Observaciones</th>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                          <th>Opciones</th>
                          <th>Cod. CAT</th>
                          <th>Nombre CAT</th>
                          <th>Cod. Programa</th>
                          <th>Nombre Programa</th>
                          <th>Semestre</th>
                          <th>Grupo</th>
                          <th>Cod. Curso</th>
                          <th>Nombre Curso</th>
                          <th>Perfil Establecido</th>
                          <th>Semana</th>
                          <th>Día</th>
                          <th>Hora</th>
                          <th>Horas Curso</th>
                          <th>Horas Art. Curso</th>
                          <th>Horas Prac. Curso</th>
                          <th>Horas lider art. curso</th>
                          <th>Doc. Docente</th>
                          <th>Nombre Docente</th>
                          <th>Perfil Docente</th>   
                          <th>Residencia Docente</th>
                          <th>Teléfono Docente</th>
                          <th>Celular Docente</th>
                          <th>Email Inst. Docente</th>
                          <th>Email Pers. Docente</th>
                          <th>Planta</th>
                          <th>Ciudad Origen</th>
                          <th>Ciudad Destino</th>
                          <th>Salón</th>
                          <th>Observaciones</th>
                        </tfoot>
                      </table>
                    </div>
                    <div class="panel-body" style="height: 500px;" id="formularioregistros">
                      <div class="container" id="advanced-search-form" style="height: 400px">
                        <h2 align="center">INGRESAR ASIGNACIÓN</h2>
                        <form name="formulario" id="formulario" method="POST">
                          <input type="text" name="usuari_id" id="usuari_id" value="<?php echo $_SESSION["USUARI_ID"]; ?>">
                          <input type="text" name="usuari_usuario" id="usuari_usuario" value="<?php echo $_SESSION['USUARI_USUARIO']; ?>">
                          <table>
                            <tr>
                              <td>
                                <input type="text" name="asigna_id" id="asigna_id">
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 100px">
                                  <label>CAT:</label>
                                  <select class="selectpicker" data-live-search="true" name="cat_id" id="cat_id" style="text-transform: uppercase;text-decoration:none;align-content: left">
                                  </select>
                                </div> 
                              </td>
                              <td>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 170px">
                                  <label>Desplazamiento:</label>
                                  <select class="selectpicker" data-width="auto" data-live-search="true" name="despla_id" id="despla_id" style="text-transform: uppercase;text-decoration:none;align-content: left;">
                                  </select>
                                </div> 
                              </td>
                              <td>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 200px">
                                  <label>Materia:</label>
                                  <select class="selectpicker" data-width="auto" data-live-search="true" name="materi_id" id="materi_id" style="text-transform: uppercase;text-decoration:none;align-content: left">
                                  </select>
                                </div> 
                              </td>
                            </tr>
                          </table>
                          <table>
                            <tr>
                              <td>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 130px">
                                  <label>Doc. Docente:</label>
                                  <input type="text" class="form-control" name="docent_documento" id="docent_documento" onchange="autoco_docente(this.value)" autocomplete="off"/>
                                </div> 
                              </td>
                              <td>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 300px">
                                  <label>Nombre Docente:</label>
                                  <input type="text" class="form-control"  name="docent_nombre" id="docent_nombre" onchange="autoco_docente(this.value)" autocomplete="off">
                                </div> 
                              </td>
                              <td>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 80px">
                                  <label>Grupo:</label>
                                  <select class="form-control" name="grupo_id" id="grupo_id" style="text-transform: uppercase;text-decoration:none;align-content: left;">
                                    <option value="1">1</option> 
                                    <option value="2">2</option> 
                                    <option value="3">3</option>
                                    <option value="4">4</option> 
                                    <option value="5">5</option> 
                                    <option value="6">6</option> 
                                    <option value="7">7</option> 
                                    <option value="8">8</option> 
                                    <option value="9">9</option> 
                                    <option value="10">10</option> 
                                  </select>
                                </div> 
                              </td>
                              <td>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 90px">
                                  <label>Semana:</label>
                                  <select class="form-control" name="semana_id" id="semana_id" style="text-transform: uppercase;text-decoration:none;align-content: left;">
                                    <option value="1">1</option> 
                                    <option value="2">2</option> 
                                  </select>
                                </div> 
                              </td>
                              <td>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 130px">
                                  <label>Día:</label>
                                  <select class="form-control" name="dia_id" id="dia_id" style="text-transform: uppercase;text-decoration:none;align-content: left;">
                                    <option value="1">Lunes</option> 
                                    <option value="2">Martes</option>
                                    <option value="3">Miercoles</option> 
                                    <option value="4">Jueves</option> 
                                    <option value="5">Viernes</option> 
                                    <option value="6">Sabado</option> 
                                    <option value="7">Domingo</option> 
                                  </select>
                                </div> 
                            </tr>               
                          </table>
                          <table>
                            <tr>
                              <td>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 180px">
                                  <label>Hora:</label>
                                   <select class="form-control" name="hora_id" id="hora_id" style="text-transform: uppercase;text-decoration:none;align-content: left;">
                                    <option value="1">7:00 am a 10:00 am</option> 
                                    <option value="2">7:00 am a 1:00 pm</option> 
                                    <option value="3">9:00 am a 12:00 m</option>
                                    <option value="4">10:00 am a 1:00 pm</option> 
                                    <option value="5">1:00 pm a 4:00 pm</option> 
                                    <option value="6">2:00 pm a 5:00 pm</option> 
                                    <option value="7">2:00 pm a 8:00 pm</option> 
                                    <option value="8">4:00 pm a 7:00 pm</option> 
                                    <option value="9">5:00 pm a 8:00 pm</option> 
                                    <option value="10">7:00 pm a 10:00 pm</option> 
                                  </select>
                                </div> 
                              </td>
                              <td>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 130px">
                                  <label>Horas lid. art.:</label>
                                  <input type="text" class="form-control" name="asigna_lidart" id="asigna_lidart" maxlength="4" value="0"  onKeyPress="numerico(this.value);">
                                </div> 
                              </td>
                              <td>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 120px">
                                  <label>Salón:</label>
                                  <input type="text" class="form-control"  name="asigna_salon" id="asigna_salon" value="N.A">
                                </div> 
                              </td>
                              <td>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 300px">
                                  <label>Observaciones:</label>
                                  <textarea class="form-control" name="asigna_observ" id="asigna_observ" rows="1"></textarea>
                                </div>
                              </td>
                            </tr>               
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
<script type="text/javascript" src="scripts/asignacion.js"></script>
<script type="text/javascript" src="scripts/valiForm.js"></script>
<?php
}
ob_end_flush();
?>
