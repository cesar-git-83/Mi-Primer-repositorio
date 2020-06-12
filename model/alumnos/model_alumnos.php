<?php


include('../database_connection.php');

$form_data = json_decode(file_get_contents("php://input"));

$error = '';
$message = '';
$validation_error = '';
$first_name = '';
$last_name = '';
$email = '';
$sex = '';

if($form_data->action == 'fetch_single_data')
{
	$query = "SELECT * FROM tbl_sample WHERE id='".$form_data->id."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output['first_name'] = $row['first_name'];
		$output['last_name'] = $row['last_name'];
		$output['email'] = $row['email'];
		$output['sex'] = $row['sex'];
	}
}
elseif($form_data->action == "Delete")
{
	$query = "
	DELETE FROM tbl_sample WHERE id='".$form_data->id."'
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

	if(empty($form_data->email))
	{
		$error[] = 'Correo es requerido';
	}
	else
	{
		$email = $form_data->email;
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
				':email'		=>	$email,
				':sex'		=>	$sex
			);
			$query = "
			INSERT INTO tbl_sample
				(first_name, last_name, email, sex) VALUES
				(:first_name, :last_name, :email, :sex)
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
				':email'	=>	$email,
				':sex'	=>	$sex,
				':id'			=>	$form_data->id
			);
			$query = "
			UPDATE tbl_sample
			SET first_name = :first_name, last_name = :last_name, email = :email, sex = :sex WHERE id = :id";

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
