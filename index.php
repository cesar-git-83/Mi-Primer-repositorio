<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Angular</title>
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
  </head>
  <body>


  <h3 class="text-center">Inicio de Sesion</h3>
  <hr>
  <div class="row">
    <div class="col-md-6 col-md-offset-3">

            <form id="frm-login" action="view/index.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
					<label for="Usuario">Usuario</label>
					<input type="text" name="usuario" class="form-control" placeholder="Ingrese usuario" />
				</div>

				<div class="form-group">
					<label for="Contraseña">Contraseña</label>
					<input type="password" name="password" class="form-control" placeholder="Ingrese Contraseña" />
				</div>


				<div class="text-center">

                   <button class="btn btn-success">Iniciar Sesion</button>
               </div>

            </form>

      <!-- Fin Contenido -->
    </div>
  </div>
  <!-- Fin row -->

  </body>
  </html>s
<!-- Fin container -->
<script>
    $(document).ready(function(){
        $("#frm-login").submit(function(){
            return $(this).validate();
        });
    })
</script>
