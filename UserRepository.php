<?php 
	
	function registerUser($name, $fone, $email, $password, $cep, $street, $neighborhood, $city, $uf, $ibge, $description, $cnpjAndCpf, $typeUser)
	{
		session_start();
		include('connection.php');

		$registerQuery = "insert into user (name, fone, email, password, cep, street, neighborhood, city, uf, ibge, cnpjAndCpf, description, typeUser) VALUES ('$name', '$fone', '$email', '$password', '$cep', '$street', '$neighborhood', '$city', '$uf', '$ibge', '$cnpjAndCpf', '$description', '$typeUser')";

		try
		{
			if ($connectionUser->query($registerQuery) === TRUE) 
		    {
		      	return true;
		    } 
		    else 
		    {
		      	return false;
		    }
		}
		catch(Exception $e)
		{
			$_SESSION['DatabaseError'] = $e;
			return false;
		}
		finally
		{
	    	$connectionUser->close();
		}
	    
	}

	function loginUser($email, $password)
	{
		include('connection.php');

		$loginQuery = "select * from user where email = '$email' and password = '$password' ";

		try
		{
			$data = mysqli_fetch_array($connectionUser->query($loginQuery));

			if (!empty($data)) 
		    {
		      	return $data;
		    } 
		    else if(empty($data))
		    {
		      	return false;
		    }
		}
		catch(Exception $e)
		{
			$_SESSION['DatabaseError'] = $e;
			return false;
		}
		finally
		{
			$connectionUser->close();
		}
	}




?>