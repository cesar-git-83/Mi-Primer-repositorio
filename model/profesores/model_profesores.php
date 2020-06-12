<?php



include('../database_connection.php');

$form_data = json_decode(file_get_contents("php://input"));

$error = '';
$message = '';
$validation_error = '';
$first_name = '';
$last_name = '';
$date = '';
$sex = '';

if($form_data->action == 'fetch_single_data')
{
	$query = "SELECT * FROM profesores WHERE id='".$form_data->id."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output['first_name'] = $row['first_name'];
		$output['last_name'] = $row['last_name'];
		$output['date'] = $row['date'];
		$output['sex'] = $row['sex'];
	}
}
elseif($form_data->action == "Delete")
{
	$query = "
	DELETE FROM profesores WHERE id='".$form_data->id."'
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

	if(empty($form_data->last_name))
	{
		$error[] = 'Apellido es requerido';
	}
	else
	{
		$last_name = $form_data->last_name;
	}

	if(empty($form_data->date))
	{
		$error[] = 'Fecha es requerido';
	}
	else
	{
		$date = $form_data->date;
	}

	if(empty($form_data->sex))
	{
		$error[] = 'Seleccione sexo';
	}
	else
	{
		$sex = $form_data->sex;
	}

	if(empty($error))
	{
		if($form_data->action == 'Insert')
		{
			$data = array(
				':first_name'		=>	$first_name,
				':last_name'		=>	$last_name,
				':date'		=>	$date,
				':sex'		=>	$sex
			);
			$query = "
			INSERT INTO profesores
				(first_name, last_name, date, sex) VALUES
				(:first_name, :last_name, :date, :sex)
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
				':last_name'	=>	$last_name,
				':date'	=>	$date,
				':sex'	=>	$sex,
				':id'			=>	$form_data->id
			);
			$query = "
			UPDATE profesores
			SET first_name = :first_name, last_name = :last_name, date = :date, sex = :sex WHERE id = :id";

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
