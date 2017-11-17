<?php
	$errores = false;

	// Conectar a base de datos
	$db = mysqli_connect('localhost', 'root', '', 'lista-del-super');

	if (isset($_POST['submit'])) {
		$tarea = $_POST['tarea'];
		if (empty($tarea)) {
			$errores = true;
		} else {
			mysqli_query($db, "INSERT INTO tareas (tarea) VALUES ('$tarea')");
			header('location: index.php');
		}
	}

	if (isset($_GET['marcar_listo'])) {
		$id = $_GET['marcar_listo'];
		mysqli_query($db, "DELETE FROM tareas WHERE id=$id");
		header("location: index.php");
	}

	$tareas = mysqli_query($db, "SELECT * FROM tareas");

?>

<!doctype html>
<html lang="es">
	<head>
		<title>Lista del Supermercado</title>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  	</head>
  	<body>
		<main role="main">
		<?php if($errores == true) { ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>¡Error!</strong> No dejes el campo de ingreso vacío.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php } ?>

			<section class="container pt-5">
				<h1 class="text-center">Lista del Supermercado</h1>

				<div class="row mt-5">
					<div class="col-sm text-center">
						<form method="post" class="form-inline justify-content-center">
							<div class="input-group form-group mx-sm-3">
								<input name="tarea" type="text" class="form-control" id="todo-input" placeholder="Agregar..." aria-label="Agregar..." autofocus>
								<span class="input-group-btn">
									<button name="submit" type="submit" class="btn btn-dark">
										<i class="fa fa-plus" aria-hidden="true"></i>
									</button>
								</span>
							</div>
						</form>
					</div>
				</div>

				<div class="row mt-5">
					<table class="table text-center">
						<thead>
							<tr>
								<th scope="col">#</th>
					      		<th scope="col">Pendiente</th>
					      		<th scope="col">Acción</th>
					    	</tr>
					  	</thead>
					  	<tbody>
				  		<?php $i = 1; while($row = mysqli_fetch_array($tareas)) { ?>
				  			<tr>
						    	<th scope="row"><?php echo $i; ?></th>
					      		<td><?php echo $row['tarea']; ?></td>
					      		<td>
					      			<a href="index.php?marcar_listo=<?php echo $row['id'];?>" class="text-success">
					      				<i class="fa fa-check fa-lg" aria-hidden="true"></i>
					      			</a>
					      		</td>
					    	</tr>
				  		<?php $i++; } ?>
					  	</tbody>
					</table>
				</div>
			</section>

		</main>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  	</body>
</html>