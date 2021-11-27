<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kardex</title>
  <link href="dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/estilo.css">
  <link rel="stylesheet" href="dist/fontawesome/css/all.min.css">
</head>
<body class="index">
  <!-- Login -->
  <form class="form-signin text-center">
    <i class="fas fa-users fa-5x"></i>
    <h4 class="mb-3 font-weight-normal">Iniciar Sesión</h4>
    <label class="sr-only">usuario</label>
    <input type="text" id="inputEmail" class="form-control" placeholder="Ingresar usuario" required autofocus autocomplete="off"><br>
    <label class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Ingresar su contraseña" required><br>
    <button class="btn btn-lg btn-primary btn-block btnIngresar" type="submit">Ingresar</button>
  </form>
</body>
<script src="dist/js/jquery-3.6.0.js"></script>
<script src="js/login.js"></script>
</html>