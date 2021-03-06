<?php include "includes/header.php" ?>
<?php 
/* CON ISSTE VALIDAMOS QUE ESTA PRESIOINADO ELK BOTON */
if (isset($_POST["crearUsuario"])) {
  $email = $_POST["email"];
  $nombre = $_POST["nombre"];
  $telefono = $_POST["telefono"];
  $password =md5($_POST["password"]);
  $rol = $_POST["rol"];

/*   $idUsuario = $_SESSION["idUsuario"];*/

    
  //validar que no nesten vacion
  if (!empty($email) && $email != "" && !empty($nombre) && $nombre != "" &&!empty($telefono) && $telefono != "" && !empty($password) && $password != "") {
    $query="INSERT INTO usuario(email,nombre,telefono,password,es_admin)VALUES(:email,:nombre,:telefono,:password,:rol)";

    

    $sentencia= $conn->prepare($query);
    $sentencia->bindParam(":email",$email, PDO::PARAM_STR);
    $sentencia->bindParam(":nombre",$nombre, PDO::PARAM_STR);
    $sentencia->bindParam(":telefono",$telefono, PDO::PARAM_STR);
    $sentencia->bindParam(":password",$password, PDO::PARAM_STR);
    $sentencia->bindParam(":rol",$rol, PDO::PARAM_INT);

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
                    <h3 class="card-title">Crear un nuevo usuario</h3>
                  </div>                 
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                  <form role="form" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">            

                      <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control">
                      </div>

                      <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" class="form-control">
                      </div>

                       <div class="mb-3">
                        <label for="telefono" class="form-label">Tel??fono:</label>
                        <input type="text" name="telefono" class="form-control">
                      </div>    

                       <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" class="form-control">
                      </div>   

                      <div class="mb-3">
                       <label for="rol" class="form-label">Rol:</label>
                        <select class="form-control" name="rol" aria-label="Default select example">                       
                        <option value="">Selecciona una opci??n</option>
                        <option value="0">Registrado</option>
                        <option value="1">Administrador</option>
                        </select>  
                    </div>   

                            <button type="submit" name="crearUsuario" class="btn btn-primary"><i class="fas fa-cog"></i> Crear Usuario</button>  

                        </div>
                      </form>
                  </div>
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
