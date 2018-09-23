<?php
session_start();
?>
<?php
  $host_db = "localhost";
  $user_db = "root";
  $pass_db = "usbw";
  $db_name = "optica-ingsfw";
  $tbl_name = "usuario";
  $conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);
  if ($conexion->connect_error) {
    die("La conexion falló: " . $conexion->connect_error);
  }
  $username = $_POST['email'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM $tbl_name WHERE nombre_usuario = '$username' && contrasena_usuario = '$password'";
  $result = $conexion->query($sql);
  if ($result->num_rows > 0) {
  }
  $row = $result->fetch_array(MYSQLI_ASSOC);
  if ($result->num_rows==1) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
    echo "Bienvenido! " . $_SESSION['username'];
    if($row['cargo_usuario']=="Secretario" || $row['cargo_usuario']=="Secretaria"){
      header("Location: /principal.html");
    }else{
      header("Location: /formulario_medico.html");
    }
    echo "<br><br><a href=panel-control.php>Panel de Control</a>";
  } else {
   echo "Username o Password estan incorrectos.";
   echo "<br><a href='login.html'>Volver a Intentarlo</a>";
  }
  mysqli_close($conexion);
?>
