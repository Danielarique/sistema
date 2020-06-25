<?php
//Se activa el almacenamiento en bufer
ob_start();
session_start();

if(!isset($_SESSION["USUARI_NOMBRES"])){
  header("Location: index.php");
}else{

require 'header.php';
?> 
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border" style="text-align: center">
                          <h1 class="box-title" style="font-size: 28px;font-weight: bold">BIENVENIDO AL SISTEMA DE GESTIÓN ASIGNACIÓN ACADÉMICA</h1>
                          <input type="hidden" id="usuari_id" name="usuari_id" value="<?php echo $_SESSION["USUARI_ID"]; ?>">
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                   
                    <div class="container" id="advanced-search-form" style="height: auto;border-radius: 10px">
                      <h2 style="font-family: Source Sans Pro">Privilegios Cats</h2>
                      <ul style="list-style: circle;columns: 4;" id="privil_cat"> 
                    </div>
                    <br>
                    <div class="container" id="advanced-search-form" style="height: auto;border-radius: 10px">
                      <h2 style="font-family: Source Sans Pro">Privilegios Programas</h2>
                      <ul style="list-style: circle;columns: 2;" id="privil_progra"> 
                    </div>
                    <br>
                        
                    <!--Fin centro -->
                 
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

<?php 

require 'footer.php';
?>
<script type="text/javascript" src="scripts/home.js"></script>
<?php
}
ob_end_flush();
?>
