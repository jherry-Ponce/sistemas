<?php include "includes/header.php" ?>

<?php 
/* CON ISSTE VALIDAMOS QUE ESTA PRESIOINADO ELK BOTON */
if (isset($_POST["registrarNota"])) {
  $Titulo = $_POST["titulo"];
  $descripcion = $_POST["descripcion"];
/*   $idUsuario = $_SESSION["idUsuario"];*/

    
  //validar que no nesten vacion
  if (!empty($Titulo) && $Titulo != "" && !empty($descripcion) && $descripcion != "" ) {
    $query="INSERT INTO notas(titulo,descripcion,fecha,usuario_id)VALUES(:titulo,:descripcion,:fecha,:usuario_id)";

    $fechaatcual= date('Y-m-d');

    $sentencia= $conn->prepare($query);
    $sentencia->bindParam(":titulo",$Titulo, PDO::PARAM_STR);
    $sentencia->bindParam(":descripcion",$descripcion, PDO::PARAM_STR);
    $sentencia->bindParam(":fecha",$fechaatcual, PDO::PARAM_STR);
    $sentencia->bindParam(":usuario_id",$idUsuario, PDO::PARAM_INT);

    $resultado = $sentencia->execute();

    if ($resultado) {
      $mensaje= "Registro de nota creado correctamente";
    }else{
      $error ="Error, no se pudo crear la nota";
    }

  }else{
  $error ="Error, algunos campos estan vacios";
  }
}

?>


              <div class="row">
                  <div class="col-sm-12">
                  <?php if (isset($mensaje)) :  ?>
                          <div class="alert alert-warning alert-dismissible fade show" role="alert">
                              <strong><?php echo $mensaje;?></strong> 
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                    <?php endif; ?>
                  </div>
              </div>

              <div class="row">
                  <div class="col-sm-12">
                  <?php if (isset($error)) :  ?>
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <strong><?php echo $error;?></strong> 
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                    <?php endif; ?>
                  </div>
              </div>

              <div class="card-header">               
                <div class="row">
                  <div class="col-md-9">
                    <h3 class="card-title">Crear una nota nueva</h3>
                  </div>                 
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                  <form role="form" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">            

                      <div class="mb-3">
                        <label for="titulo" class="form-label">Título:</label>
                        <input type="text" name="titulo" class="form-control">
                      </div>

                      <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea class="form-control" name="descripcion" rows="3"></textarea>
                      </div>        

                            <button type="submit" name="registrarNota" class="btn btn-primary"><i class="fas fa-cog"></i> Crear Nota</button>  

                        </div>
                      </form>
                  </div>
                </div>
             
              <!-- /.card-body -->


<?php include "includes/footer.php" ?>

<!-- page script -->
<script>
  $(function () {   
    $('#tblRegistros').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    }); 
  });
</script>
