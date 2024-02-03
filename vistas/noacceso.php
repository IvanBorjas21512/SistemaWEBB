<?php
	ob_start();
	if (!isset($_SESSION["nombre"]))
	{
	  header("Location: login.php");
	}
	else{
?>
<div class="content-wrapper">        
      <section class="content">
          <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title">¡Usted no tiene acceso para ingresar a esta página!</h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                  </div>
              </div>
          </div>
      </section>
    </div>
<?php
}
?>