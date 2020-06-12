<!DOCTYPE html>
<html lang="es">
	<head>
		<title>AngularJS</title>

        <meta charset="utf-8" />

				<script src="../asset/js/jquery.min.js"></script>
				<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
				<script src="../asset/js/jquery.dataTables.min.js"></script>
				<script src="../asset/js/angular-datatables.min.js"></script>
				<script src="../asset/js/bootstrap.min.js"></script>
				<link rel="stylesheet" href="../asset/css/bootstrap.min.css">
				<link rel="stylesheet" href="../asset/css/datatables.bootstrap.css">
	</head>
    <body ng-app="crudApp" ng-controller="crudController">

			<nav class="navbar navbar-inverse">
			  <div class="container-fluid">
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="index.php">INICIO</a>
			    </div>
			    <div class="collapse navbar-collapse" id="myNavbar">
			      <ul class="nav navbar-nav">
			        <li><a href="cursos.php">Cursos</a></li>
			        <li><a href="alumnos.php">Alumnos</a></li>
			        <li><a href="profesores.php">Profesores</a></li>
			        <li><a href="../controller/sesion.php">Cerrar Sesion</a></li>
			      </ul>
			    </div>
			  </div>
			</nav>
