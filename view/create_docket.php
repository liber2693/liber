<?php
//include("conexion/conexion.php");
session_start();
if(empty($_SESSION['user']))
{
  //echo"<script>alert('You must login')</script>";
  echo"<meta http-equiv='refresh' content='0;URL=../index.php'>";
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>NETEX GLOBAL</title>
  <?php include('cabecera.php');?>
</head>
<body>
  <!-- container section start -->
  <section id="container" class="">
  <?php include('encabezado.php');?>
    <!--header end-->
    <!--sidebar start-->
     <?php include('menu.php');?>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <!--overview start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-folder-open"></i>Create Docket</li>
            </ol>
          </div>
        </div>
      </section>
      <section class="panel">
        <div class="panel-group">
          <div class="panel-group">
            <div class="panel panel-link">
              <div class="panel-heading" align=center>
                <h3>
                  <b>CREATE DOCKET</b>
                </h3>
              </div><br>
              <div class="panel-body">
                <center>
                  <a href="#myModal" data-toggle="modal" class="btn btn-primary btn-lg"><b>Import Docket</b></a>
                  <a href="#myModal-1" data-toggle="modal" class="btn btn-danger btn-lg"><b>Export Docket</b></a><br><br>
                  <a href="docket_list.php" class="btn btn-success btn-lg"><b>Go to Docket List</b></a>
                </center>
              </div>
            </div><!--Link, succes, warning, danger, info-->
          </div>
          <!-- INICIO Formulario Importacion de documento -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                  <h4 class="modal-title"><b>Import Docket Form</b></h4>
                </div>
                <div class="modal-body">
                  <form role="form" name="importacion" id="importacion" action="../controllers/documentoControllers.php" enctype="multipart/form-data" method='post'>
                    <input type="hidden" value="I" name="tipoDocumento">
                    <div class="form-group">
                      <label for="shipper">Shipper <b style="color: red">*</b></label>
                      <input name="shipper" type="text" class="form-control round-input" id="shipper" placeholder="Enter Shipper" >
                    </div>
                    <div class="form-group">
                      <label for="fecha">Date <b style="color: red;">*</b></label>
                      <input name="fecha" type="text" class="form-control round-input fecha" id="fecha"  placeholder="Enter Date">
                    </div>
                    <div class="form-group">
                      <label for="origin">Phone</label>
                      <input name="telefono" type="text" class="form-control round-input" placeholder="Enter Phone"  autocomplete='tel'>
                    </div>
                    <div class="form-group">
                      <label for="origin">PO #</label>
                      <input name="codigo_zip" type="text" class="form-control round-input" placeholder="Enter ZIP code" autocomplete='postal-code'>
                    </div>
                    <div class="form-group">
                      <label for="origin">Country of origin <b style="color: red;">*</b></label>
                      <select name="pais_origen" class="form-control round-input" autocomplete='country-name' id="pais_origen">
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="origin">Origin</label>
                      <input name="origen" type="text" class="form-control round-input" placeholder="Enter Origin">
                    </div>
                    <div class="form-group">
                      <label for="origin">Destination country <b style="color: red;">*</b></label>
                      <select name="pais_destino" class="form-control round-input" autocomplete='country-name' id="pais_destino">
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="destination">Destination</label>
                      <input name="destino" type="text" class="form-control round-input" placeholder="Enter Destination">
                    </div>
                  <div>
                    <div class="form-group col-lg-6">
                      <label for="pieces">Pieces</label>
                      <input name="pieza" type="text" class="form-control round-input" autocomplete='tel-country-code' placeholder="Enter Pieces">
                    </div>
                    <div class="form-group col-lg-6">
                      <label class="control-label col-lg-6" for="inputSuccess">Type</label>
                      <div class="col-lg-12">
                        <input name="tipo_pieza" type="text" class="form-control round-input" placeholder="Enter type of piece">
                        <!--<select class="form-control m-bot15 round-input" id="tipo_pieza" name="tipo_pieza">
                          <option value="0" selected="selected">SELECT</option>
                          <option value="BOX">BOX</option>
                          <option value="OTHER">OTHER</option>
                        </select>-->
                      </div>
                    </div>
                    <div>
                      <div class="form-group col-lg-6">
                        <label for="weight">Weight</label>
                        <input name="peso" type="text" class="form-control round-input" placeholder="Enter Weight">
                      </div>
                      <div class="form-group col-lg-6">
                        <label class="control-label col-lg-6" for="inputSuccess">Type</label>
                        <div class="col-lg-12">
                          <input name="tipo_peso" type="text" class="form-control round-input" placeholder="Enter type of weight">
                          <!--<select class="form-control m-bot15 round-input" id="tipo_peso" name="tipo_peso">
                            <option value="0" selected="selected">SELECT</option>
                            <option value="KILOGRAMS">KILOGRAMS</option>
                            <option value="POUNDS">POUNDS</option>
                          </select>-->
                        </div>
                      </div>
                      <div>
                        <div class="form-group col-lg-3">
                          <label for="height">Height</label>
                          <input name="alto" type="text" class="form-control round-input" placeholder="Enter Height">
                        </div>
                        <div class="form-group col-lg-3">
                          <label for="width">Width</label>
                          <input name="ancho" type="text" class="form-control round-input" placeholder="Enter Width">
                        </div>
                        <div class="form-group col-lg-3">
                          <label for="long">Long</label>
                          <input name="largo" type="text" class="form-control round-input" placeholder="Enter Long">
                        </div>
                        <div class="form-group col-lg-3">
                          <label class="control-label col-lg-6" for="inputSuccess">Type</label>
                          <div class="col-lg-14">
                            <input type="text"  class="form-control m-bot15 round-input" autocomplete='tel-country-code' name="medida" placeholder="type measure">
                            <!--<select class="form-control m-bot15 round-input" autocomplete='tel-country-code' id="medida" name="medida">
                              <option value="0" selected="selected">SELECT</option>
                              <option value="CENTIMETERS">CENTIMETERS</option>
                              <option value="INCHES">INCHES</option>
                            </select>-->
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="origin">Description</label>
                          <textarea name="descripcion" class="form-control round-input" placeholder="Description"></textarea>
                        </div>
                      </div>
                      <center>
                        <div class="form-group">
                          <label for="files">File input</label>
                          <input type="file" name="archivo[]" multiple="true">
                        </div>
                          <button type="submit" id="enviar_documento" name="enviar_documento" class="btn btn-primary"><b>Save</b></button>
                          <button type="reset" class="btn btn-info"><b>Reset</b></button>
                      </center>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- FIN Formulario Importacion de documento -->
        </div>
      </div>
      <!-- INICIO Formulario Exportacion de documento -->
      <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-1" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
              <h4 class="modal-title"><b>Export Docket Form</b></h4>
            </div>
            <div class="modal-body">
              <form role="form" name="exportacion" id="exportacion" action="../controllers/documentoControllers.php" enctype="multipart/form-data" method='post'>
                <input type="hidden" value="E" name="tipoDocumento">
                <div class="form-group">
                  <label for="shipper">Shipper <b style="color: red">*</b></label>
                  <input name="shipper" type="text" class="form-control round-input" id="shipperE" placeholder="Enter Shipper" >
                </div>
                <div class="form-group">
                  <label for="fecha">Date <b style="color: red;">*</b></label>
                  <input name="fecha" type="text" class="form-control round-input fecha" id="fechaE"  placeholder="Enter Date">
                </div>
                <div class="form-group">
                  <label for="origin">Phone</label>
                  <input name="telefono" type="text" class="form-control round-input" placeholder="Enter Phone"  autocomplete='tel'>
                </div>
                <div class="form-group">
                  <label for="origin">PO #</label>
                  <input name="codigo_zip" type="text" class="form-control round-input" placeholder="Enter ZIP code" autocomplete='postal-code'>
                </div>
                <div class="form-group">
                  <label for="origin">Country of origin <b style="color: red;">*</b></label>
                  <select name="pais_origen" class="form-control round-input" autocomplete='country-name' id="pais_origenE">
                  </select>
                </div>
                <div class="form-group">
                  <label for="origin">Origin</label>
                  <input name="origen" type="text" class="form-control round-input" placeholder="Enter Origin">
                </div>
                <div class="form-group">
                  <label for="origin">Destination country <b style="color: red;">*</b></label>
                  <select name="pais_destino" class="form-control round-input" autocomplete='country-name' id="pais_destinoE">
                  </select>
                </div>
                <div class="form-group">
                  <label for="destination">Destination</label>
                  <input name="destino" type="text" class="form-control round-input" placeholder="Enter Destination">
                </div>
                <div>
                  <div class="form-group col-lg-6">
                    <label for="pieces">Pieces</label>
                    <input name="pieza" type="text" class="form-control round-input" autocomplete='tel-country-code' placeholder="Enter Pieces">
                  </div>
                  <div class="form-group col-lg-6">
                    <label class="control-label col-lg-6" for="inputSuccess">Type</label>
                    <div class="col-lg-12">
                      <input name="tipo_pieza" type="text" class="form-control round-input" placeholder="Enter type of piece">
                      <!--<select class="form-control m-bot15 round-input" id="tipo_pieza" name="tipo_pieza">
                        <option value="0" selected="selected">SELECT</option>
                        <option value="BOX">BOX</option>
                        <option value="OTHER">OTHER</option>
                      </select>-->
                    </div>
                  </div>
                  <div>
                    <div class="form-group col-lg-6">
                      <label for="weight">Weight</label>
                      <input name="peso" type="text" class="form-control round-input" placeholder="Enter Weight">
                    </div>
                    <div class="form-group col-lg-6">
                      <label class="control-label col-lg-6" for="inputSuccess">Type</label>
                      <div class="col-lg-12">
                        <input name="tipo_peso" type="text" class="form-control round-input" placeholder="Enter type of weight">
                        <!--<select class="form-control m-bot15 round-input" id="tipo_peso" name="tipo_peso">
                          <option value="0" selected="selected">SELECT</option>
                          <option value="KILOGRAMS">KILOGRAMS</option>
                          <option value="POUNDS">POUNDS</option>
                        </select>-->
                      </div>
                    </div>
                    <div>
                      <div class="form-group col-lg-3">
                        <label for="height">Height</label>
                        <input name="alto" type="text" class="form-control round-input" placeholder="Enter Height">
                      </div>
                      <div class="form-group col-lg-3">
                        <label for="width">Width</label>
                        <input name="ancho" type="text" class="form-control round-input" placeholder="Enter Width">
                      </div>
                      <div class="form-group col-lg-3">
                        <label for="long">Long</label>
                        <input name="largo" type="text" class="form-control round-input" placeholder="Enter Long">
                      </div>
                      <div class="form-group col-lg-3">
                        <label class="control-label col-lg-6" for="inputSuccess">Type</label>
                        <div class="col-lg-14">
                          <input type="text"  class="form-control m-bot15 round-input" autocomplete='tel-country-code' name="medida" placeholder="type measure">
                          <!--<select class="form-control m-bot15 round-input" autocomplete='tel-country-code' name="medida">
                            <option value=" " selected="selected">SELECT</option>
                            <option value="CENTIMETERS">CENTIMETERS</option>
                            <option value="INCHES">INCHES</option>
                          </select>-->
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="origin">Description</label>
                        <textarea name="descripcion" class="form-control round-input" placeholder="Description"></textarea>
                      </div>
                    </div>
                    <center>
                      <div class="form-group">
                        <label for="files">File input</label>
                        <input type="file" name="archivo[]" multiple=true>
                      </div>
                      <button type="submit" id="enviar_documento" name="enviar_documento" class="btn btn-primary"><b>Save</b></button>
                      <button type="reset" class="btn btn-info"><b>Reset</b></button>
                    </center>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- FIN Formulario Exportacion de documento -->

    </div>
  </div>
      </section>
    </section>
    <!--main content end-->
  </section>
  <!-- container section start -->

  <!-- javascripts -->
  <?php include('pie.php');?>


</body>

</html>
<?php
}
?>