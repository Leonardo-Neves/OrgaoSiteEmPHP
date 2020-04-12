<?php 
	
	
	function registerUser($name, $fone, $email, $password, $cep, $street, $neighborhood, $city, $uf, $ibge, $description, $cnpjAndCpf, $typeUser)
	{
		session_start();
		include('connection.php');

		// This function is responsable for register of users

		$alteredPassword = "false";

		// Database Query
		$registerQuery = "insert into user (name, fone, email, password, cep, street, neighborhood, city, uf, ibge, cnpjAndCpf, description, typeUser, alteredPassword) VALUES ('$name', '$fone', '$email', '$password', '$cep', '$street', '$neighborhood', '$city', '$uf', '$ibge', '$cnpjAndCpf', '$description', '$typeUser', '$alteredPassword')";

		try
		{
			// Registering a User
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

	function forgotPasswordUser($forgotPassword, $cryptedPasssoword)
	{
		require 'connection.php';

		// This function is responsable for update of Password's User form a temporary one

		$alteredPassword =  "true";

		// Database Query
		$forgotQuery = "UPDATE user SET password = '$cryptedPasssoword', alteredPassword = '$alteredPassword' WHERE email = '$forgotPassword'";

		try
		{
			// Update Password on Database
			if(mysqli_query($connectionUser, $forgotQuery))
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
			// Error Update
			$_SESSION['DatabaseError'] = $e;
			return false;
		}
		
	}

	function removeUser($id)
	{
		include('connection.php');

		$removeQuery = "delete from user where id = '$id'";

		try
		{
			if($connectionUser->query($removeQuery))
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
			return $e;
		}
		finally
		{
	    	$connectionUser->close();
		}
	}

	function alterPasswordUser($newPasswordAltered, $emailAlterPassword)
	{
		require 'connection.php';
		session_start();
		// This function is responsable for update of Password's User for a permanet one

		$alteredPassword =  "false";

		// Database Query
		$alterPasswordQuery = "UPDATE user SET password = '$newPasswordAltered', alteredPassword = '$alteredPassword' WHERE email = '$emailAlterPassword'";

		try
		{
			// Update Password on Database
			if(mysqli_query($connectionUser, $alterPasswordQuery))
			{
				$_SESSION['AlterPasswordSuccess'] = "Senha alterada com sucesso!";
				return true;			
			}
			else
			{
				return false;
			}
		}
		catch(Exception $e)
		{
			// Error Update
			$_SESSION['DatabaseError'] = $e;
			return false;
		}
	}

	function alterUser($id, $name, $fone, $email, $password, $cep, $street, $neighborhood, $city, $uf, $ibge, $description)
	{
		include('connection.php');

		// This functions is responsable for alter information's user

		// Database Query
		$alterQuery = "update user set name = '$name', fone = 'fone', email = '$email', password = '$password', cep = '$cep', street = '$street', neighborhood = '$neighborhood', city = '$city', uf = '$uf', ibge = '$ibge', description = '$description' where id = '$id'";

		try
		{
			// Altering datas
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

		// This function is responsable search for information's user and login 

		// Database Query
		$loginQuery = "select * from user where email = '$email' and password = '$password' ";

		try
		{
			// Search for Login User
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