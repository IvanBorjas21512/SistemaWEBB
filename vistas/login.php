<?php
	ob_start();
	session_start();
	if (!isset($_SESSION["nombre"])){
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema WEB - Estudio Contable</title>
    <link rel="icon" href="../diseños/logos/logo.png">
    
    <!-- Estilos -->
    <link href="../diseños/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../diseños/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">

    <div class="container">
        
        <div class="row abs-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image bg-imglogin"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">¡Bienvenido de nuevo!</h1></div>
                                    
                                    <form class="user" id="frmAcceso" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="logina" name="logina" placeholder="Usuario">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="clavea" name="clavea" placeholder="Contraseña">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block font-weight-bold">Ingresar <i class="far fa-arrow-alt-circle-right fa-fw"></i></button>
                                    </form>
                                    <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../diseños/js/jquery.min.js"></script>
    <script src="../diseños/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../diseños/js/jquery.easing.min.js"></script>

    <!-- Scripts-->
    <script src="../diseños/js/sb-admin-2.min.js"></script>
    <script src="scripts/login.js"></script>

    <!-- Bootbox alertas-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

</body>

</html>
<?php
	}else
		header("Location: escritorio.php");
?>