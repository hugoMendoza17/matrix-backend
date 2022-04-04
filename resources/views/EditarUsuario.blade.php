<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title> </title>
           <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    </head>
    <body>
 	    <div class="card text-white bg-danger mb-3" style="padding: 50px;">
	    	<div class="card-body" align="center">
	    		<form method="POST" action="" name="frm1" id="frm1">
                    @csrf
		        	<h2 class="card-title">Q-A MATRIX</h2>
		          	<p class="card-text">EDITAR USUARIOS</p>
		          		<div class="form_container">
						    <label for="usuario" class="formulario_label">Usuario:
						    	<input type="text" name="user" id="user" class="form-control" placeholder="Ingresa tu usuario" value>
						    </label>  
						</div> 
						<div class="form_container">
						    <label for="contrasena" class="formulario_label">Contraseña:
						    	<input type="password" name="password" id="contrasena" class="form-control" placeholder="Ingresa tu contraseña">
						    </label>
						</div>
						<div class="form_container">
							<label for="nombre" class="">Seleccionar tipo de Usuario:
								<br>
								<select name="TypeUser" id="TypeUser" >
									<br>
								<option disabled selected>Selecciona una opción</option>
								<option value="Administrador">Administrador</option>
								<option value="Supervisor">Supervisor</option>
								<option value="Usuario">Usuario</option>
								</select>
							</label>
							</div>
                        <br>
						<div class="form_container">            
							<input type="submit" name="" class="btn btn-success" style="font-size: 12px" value="Actualizar Datos">
						</div>
							
		        </form>
	        </div>
	    </div>	
	</div>
</div>  
