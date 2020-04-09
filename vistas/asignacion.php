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
            <h1 class="box-title">ASIGNACIÓN</h1>
          </div>
          <!-- /.box-header -->
          <!-- centro -->
          <div class="panel-body" style="height: 500px;" id="formularioregistros">
            <div class="container" id="advanced-search-form" style="width: 1000px">
              <h2 align="center">INGRESAR DATOS ASIGNACIÓN</h2>
              <form name="formulario" id="formulario" method="POST">
                <table>
                  <tr>
                    <td style="width: 120px">CAT:</td>
                    <td style="width: 20px">&nbsp;&nbsp;</td>
                    <td style="width: 180px">Desplazamiento:</td>
                    <td style="width: 20px">&nbsp;&nbsp;</td>
                    <td style="width: 180px">Materia:</td>
                    <td style="width: 20px">&nbsp;&nbsp;</td>
                    <td style="width: 100px">C.C Docente</td>
                    <td style="width: 10px">&nbsp;&nbsp;</td>
                    <td style="width: 200px">Nombre Docente:</td>
                    <td style="width: 10px">&nbsp;&nbsp;</td>
                  </tr>
                  <tr>
                    <td>
                      <input type="hidden" name="asigna_id" id="asigna_id">
                      <input type="text" class="form-control"  name="cat_id" id="cat_id" size="4" >
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <input type="text" class="form-control"  name="cat_id" id="cat_id" size="4" >
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <input type="text" class="form-control"  name="cat_id" id="cat_id" size="4" >
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <input type="text" class="form-control"  name="cat_id" id="cat_id" size="4" >
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <input type="text" class="form-control"  name="cat_id" id="cat_id" size="4" >
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <img src="../public/img/buscar.png">
                    </td>
                  </tr>
                </table>
                <br>
                <table>
                  <tr>
                    <td style="width: 80px">Grupo:</td>
                    <td style="width: 20px">&nbsp;&nbsp;</td>
                    <td style="width: 80px">Semana:</td>
                    <td style="width: 20px">&nbsp;&nbsp;</td>
                    <td style="width: 80px">Día:</td>
                    <td style="width: 20px">&nbsp;&nbsp;</td>
                    <td style="width: 120px">Hora</td>
                    <td style="width: 10px">&nbsp;&nbsp;</td>
                    <td style="width: 100px">Horas lid. art.:</td>
                    <td style="width: 10px">&nbsp;&nbsp;</td>
                    <td style="width: 100px">Salón:</td>
                    <td style="width: 10px">&nbsp;&nbsp;</td>
                    <td style="width: 200px">Observaciones:</td>
                  </tr>
                  <tr>
                    <td>
                      <input type="hidden" name="asigna_id" id="asigna_id">
                      <input type="text" class="form-control"  name="cat_id" id="cat_id" size="4" >
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <input type="text" class="form-control"  name="cat_id" id="cat_id" size="4" >
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <input type="text" class="form-control"  name="cat_id" id="cat_id" size="4" >
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <input type="text" class="form-control"  name="cat_id" id="cat_id" size="4" >
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <input type="text" class="form-control"  name="cat_id" id="cat_id" size="4" >
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <input type="text" class="form-control"  name="cat_id" id="cat_id" size="4" >
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <textarea name="textarea"  class="form-control"  name="cat_id" id="cat_id" size="4" ></textarea>
                    </td>
                  </tr>               
                </table>
                <br>
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
      </div>
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
<script type="text/javascript" src="scripts/asignacioon.js"></script>
<script type="text/javascript" src="scripts/valiForm.js"></script>
<?php
}
ob_end_flush();
?>
