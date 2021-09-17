<?php
  session_start();//Iniciar una nueva sesión o reanudar la existente

  //validamos si la session esta activa
  if (!empty($_SESSION['activo'])) {
    header("Location:panel.php");
  }

// Incluir la conexion
include_once("conexion_sqlserver.php");
/* valida si se presiono el boton  ingresar $_POST->(RECUPERAR DATOS DEL FORMULARIO.)es el metodo pos que envia */
if (isset($_POST["ingresar"])) {
  $email=$_POST["email"];
  $pass = MD5($_POST["password"]);//CIFRA CONTRASEÑA CON MD5

  //VALIDAR SI LOS CAMPOS NO ESTAN VACIOS
  if (!empty($email) && $email != "" && !empty($pass) && $pass !="") {

    $query ="SELECT id, email, nombre, telefono,password, es_admin From usuario  
    /* al trabajar con PDO se usa parametros execionales  */
    /* se esta validando los datos si son corrwsctos, para evitar una inyeccion sql o hackeo se coloca una almoadilla
     : en vez del parametro */
     WHERE email=:email AND password =:password";
    /*  prepare() - Prepara una sentencia para su ejecución y devuelve un objeto sentencia  */
     $sentencia = $conn->prepare($query);
     /* bindParam(":COMODIN", VARIABLE REAL QUE SE ENVIO, TIPO PARAMETRO)->VINCULA LOS DATOS  */
     $sentencia->bindParam(":email", $email, PDO::PARAM_STR);
     $sentencia->bindParam(":password", $pass, PDO::PARAM_STR);


     $resultado= $sentencia->execute();
      $registro = $sentencia->fetch(PDO::FETCH_ASSOC);// Obtiene la siguiente fila de un conjunto de resultados
     if (!$registro) {
       $error = "Error, acceso invalido";
     }else{
       //Aqui creamos sesiones
       $_SESSION['activo']=true;
       $_SESSION['idUsuario']=$registro['id'];
       $_SESSION['nombre']=$registro['nombre'];
       $_SESSION['email']=$registro['email'];
       $_SESSION['esAdmin']=$registro['es_admin'];

       //despues de crear sessiones, redirigimos al panel.php
       header("Location:panel.php");//header()permite redireccionar otra pagina
     }
  }else{
    $error="Error,alunos datos esan vacios";
  }
}


?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
 
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
		
    <title>App Notas PHP, PDO y SQL Server</title>
  </head>
  <body class="hold-transition login-page">

  

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



  <div class="login-box">
  <div class="login-logo">
    <img src="dist/img/account.png" class="img-fluid" width="200">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Ingrese sus datos para iniciar sesión</p>

      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Ingresa el email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control"  name="password" placeholder="Ingresa el password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-sm-12">
            <button type="submit" name="ingresar" class="btn btn-primary d-block w-100"><i class="fas fa-user"></i> Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>  

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- REQUIRED SCRIPTS -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>