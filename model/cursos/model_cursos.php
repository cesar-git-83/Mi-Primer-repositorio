<?php

//insert.php

include('../database_connection.php');

$form_data = json_decode(file_get_contents("php://input"));

$error = '';
$message = '';
$validation_error = '';
$asignatura = '';

if($form_data->action == 'fetch_single_data')
{
	$query = "SELECT * FROM asignatura WHERE id='".$form_data->id."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output['first_name'] = $row['first_name'];
	}
}
elseif($form_data->action == "Delete")
{
	$query = "
	DELETE FROM asignatura WHERE id='".$form_data->id."'
	";
	$statement = $connect->prepare($query);
	if($statement->execute())
	{
		$output['message'] = 'Registro Eliminado';
	}
}
else
{
	if(empty($form_data->first_name))
	{
		$error[] = 'El nombre es requerido';
	}
	else
	{
		$first_name = $form_data->first_name;
	}

	if(empty($error))
	{
		if($form_data->action == 'Insert')
		{
			$data = array(
				':first_name'		=>	$first_name
			);
			$query = "
			INSERT INTO asignatura
				(first_name) VALUES
				(:first_name)
			";
			$statement = $connect->prepare($query);
			if($statement->execute($data))
			{
				$message = 'Datos Insertados';
			}
		}
		if($form_data->action == 'Edit')
		{
			$data = array(
				':first_name'	=>	$first_name,
				':id'			=>	$form_data->id
			);
			$query = "
			UPDATE asignatura
			SET first_name = :first_name WHERE id = :id";

			$statement = $connect->prepare($query);
			if($statement->execute($data))
			{
				$message = 'Datos actualizados';
			}
		}
	}
	else
	{
		$validation_error = implode(", ", $error);
	}

	$output = array(
		'error'		=>	$validation_error,
		'message'	=>	$message
	);

}



echo json_encode($output);

?>
