<?php
//Se activa el almacenamiento en bufer
ob_start();
session_start();

if(!isset($_SESSION["USUARI_NOMBRES"])){
  header("Location: index.php");
}else{

require 'header.php';
if($_SESSION['materia']==1){
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
                          <h1 class="box-title">MATERIAS <button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Opc.</th>
                          <th>Codigo</th>
                          <th>Nombre</th>
                          <th>Programa</th>
                          <th>Plan Estudio</th>
                          <th>Semestre</th>
                          <th>Horas Curso</th>
                          <th>Horas de articulación</th>
                          <th>Horas Lider articulación</th>
                          <th>Horas práctica</th>
                          <th>Perfil establecido</th>
                          <th>Acta comité curricular</th>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                           <th>Opc.</th>
                          <th>Codigo</th>
                          <th>Nombre</th>
                          <th>Programa</th>
                          <th>Plan Estudio</th>
                          <th>Semestre</th>
                          <th>Horas Curso</th>
                          <th>Horas de articulación</th>
                          <th>Horas Lider articulación</th>
                          <th>Horas práctica</th>
                          <th>Perfil establecido</th>
                          <th>Acta comité curr.</th>
                        </tfoot>
                      </table>
                    </div>
                    <div class="panel-body" style="height: 500px;" id="formularioregistros">
                      <div class="container" id="advanced-search-form">
                        <h2 align="center">INGRESAR DATOS MATERIA</h2>
                        <form name="formulario" id="formulario" method="POST">
                          <input type="hidden" name="materi_usuadigi" id="materi_usuadigi" value="<?php echo $_SESSION['USUARI_USUARIO']; ?>">
                          <table>
                            <div class="form-row">
                              <tr>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 100px">
                                    <label>Código:</label>
                                    <input type="hidden" name="materi_id" id="materi_id">
                                    <input type="text" class="form-control"  name="materi_codigo" id="materi_codigo" size="30" >
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 200px">
                                    <label>Nombre:</label>
                                    <input type="text" class="form-control" name="materi_nombre" id="materi_nombre" style="text-decoration: none;"  onkeyup="javascript:this.value=this.value.toUpperCase();">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 100px">
                                    <label>Programa:</label>
                                    <select class="selectpicker" data-live-search="true" name="progra_id" id="progra_id" style="text-transform: uppercase;text-decoration:none;align-content: left" title="SELECCIONAR PROGRAMA">
                                    </select>
                                  </div> 
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 120px">
                                    <label>Plan Estudio:</label>
                                    <select class="selectpicker" data-live-search="false"  name="materi_planest"id="materi_planest" title="SELECCIONAR PLAN ESTUDIO">
                                      
                                    </select>
                                  </div>
                                </td>
                                 <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 100px">
                                    <label>Semestre:</label>
                                    <select class="selectpicker" data-live-search="false" name="materi_semestre" id="materi_semestre" style="text-transform: uppercase; text-decoration: none;" title="SELECCIONAR SEMESTRE">
                                      
                                    </select>
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 120px">
                                    <label>Horas curso:</label>
                                    <input type="text" class="form-control" maxlength="2" name="materi_horascur" id="materi_horascur" >
                                  </div>
                                </td>
                              </tr>
                            </div>
                          </table>
                          <table>
                            <div class="form-row">
                              <tr>   
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 100px">
                                    <label>Horas articulación:</label>
                                    <input type="text" class="form-control" maxlength="2" name="materi_horasart" id="materi_horasart">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 100px">
                                    <label>Horas lid. articulación:</label>
                                    <input type="text" class="form-control"  maxlength="2" name="materi_horaslidart" id="materi_horaslidart">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 100px">
                                    <label>Horas práctica:</label>
                                    <input type="text" class="form-control"  maxlength="2" name="materi_horasprac" id="materi_horasprac">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 350px">
                                    <label>Perfil  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;establecido:</label>
                                    <textarea class="form-control" name="materi_perfilest" id="materi_perfilest"></textarea>
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="width: 140px">
                                    <label>Acta comité curricular:</label>
                                    <input type="text" class="form-control" name="materi_actacurr" id="materi_actacurr">
                                  </div>
                                </td> 
                              </tr>
                            </div>
                          </table>
                          <table>
                            <div class="form-row">
                              <tr>
                                
                                
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
<script type="text/javascript" src="scripts/materia.js"></script>
<?php
}
ob_end_flush();
?>
