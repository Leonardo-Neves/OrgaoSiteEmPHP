<?php 
	
	include('UserRepository.php');
	include('Validation.php');
	include('connection.php');

	$name = "";
	$fone = "";
	$email = "";
	$password = "";
	$cep = "";
	$street = "";
	$neighborhood = "";
	$city = "";
	$uf = "";
	$ibge = "";
	$cnpjAndCpf = "";
	$description = "";
	$type = "";

	if(isset($_POST['name']))
	{
		$name = mysqli_real_escape_string($connectionUser, $_POST['name']);
	}

	if(isset($_POST['fone']))
	{
		$fone = mysqli_real_escape_string($connectionUser, $_POST['fone']);
	}

	if(isset($_POST['email']))
	{
		$email = mysqli_real_escape_string($connectionUser, $_POST['email']);
	}

	if(isset($_POST['password']))
	{
		$password = mysqli_real_escape_string($connectionUser, $_POST['password']);
	}

	if(isset($_POST['cep']))
	{
		$cep = mysqli_real_escape_string($connectionUser, $_POST['cep']);
	}

	if(isset($_POST['street']))
	{
		$street = mysqli_real_escape_string($connectionUser, $_POST['street']);
	}

	if(isset($_POST['neighborhood']))
	{
		$neighborhood = mysqli_real_escape_string($connectionUser, $_POST['neighborhood']);	
	}

	if(isset($_POST['city']))
	{
		$city = mysqli_real_escape_string($connectionUser, $_POST['city']);	
	}
	
	if(isset($_POST['uf']))
	{
		$uf = mysqli_real_escape_string($connectionUser, $_POST['uf']);
	}

	if(isset($_POST['ibge']))
	{
		$ibge = mysqli_real_escape_string($connectionUser, $_POST['ibge']);
	}

	if(isset($_POST['cnpjAndCpf']))
	{
		$cnpjAndCpf = mysqli_real_escape_string($connectionUser, $_POST['cnpjAndCpf']);
	}

	if(isset($_POST['description']))
	{
		$description = mysqli_real_escape_string($connectionUser, $_POST['description']);
	}
	if(isset($_POST['type']))
	{
		$type = $_POST['type'];
	}


	// Those variables are about where the request came:

	$register = $_POST['register'];
	$login = $_POST['login'];


	if(!empty($register))
	{
		if($type === 'O' && TypeValidator($type))
		{
			// Validating Data

			if(CNPJValidatorExist($cnpjAndCpf) && CNPJValidator($cnpjAndCpf) && NameValidator($name) && FoneValidator($fone) && EmailValidator($email) && PasswordValidator($password) && StreetValidator($street) && NeighborhoodValidator($neighborhood) && CityValidator($city) && UFValidator($uf) && IBGEValidator($ibge) && DescriptionValidator($description))
			{
				// Crypting a Password
				$cryptedPasssoword = EncryptPasswordValidatorMD5($password);

				// Registing a Data
				if(registerUser($name, $fone, $email, $cryptedPasssoword, $cep, $street, $neighborhood, $city, $uf, $ibge, $description, $cnpjAndCpf, $type))
				{
					// Sucess Register 
					header('Location: index.php');
					exit();
				}
				else
				{
					// Error Register
					header('Location: register.php');
					exit();
				}
			}
			else if(CNPJValidator($cnpjAndCpf) == false)
			{
				// Error Register
				header('Location: register.php');
				exit();
			}
			else
			{
				// Error Register
				header('Location: register.php');
				exit();
			}
		}
		else if($type === 'U' && TypeValidator($type))
		{
			// Validating Data
			if(CPFValidatorExist($cnpjAndCpf) && CPFValidator($cnpjAndCpf) && NameValidator($name) && FoneValidator($fone) && EmailValidator($email) && PasswordValidator($password) && PasswordValidator($password) && StreetValidator($street) && NeighborhoodValidator($neighborhood) && CityValidator($city) && UFValidator($uf) && IBGEValidator($ibge) && DescriptionValidator($description))
			{
				// Crypting Data
				$cryptedPasssoword = EncryptPasswordValidatorMD5($password);

				// Registing a Data
				if(registerUser($name, $fone, $email, $cryptedPasssoword, $cep, $street, $neighborhood, $city, $uf, $ibge, $description, $cnpjAndCpf, $type))
				{
					// Success Register
					header('Location: index.php');
					exit();
				}
				else
				{
					// Error Register
					header('Location: register.php');
					exit();
				}
			}
			else
			{
				// Error Register
				header('Location: register.php');
				exit();
			}
		}
		else
		{
			// Error Register
			TypeValidatorNotSelect();
			header('Location: register.php');
			exit();
		}
	}

	if(!empty($login))
	{

		session_start();

		$decryptedPassword = DecryptPasswordValidatorMD5($password);

		$data = loginUser($email, $decryptedPassword);

		if(!$data)
		{
			header('Location: login.php');
			exit();
		}
		else
		{	
			if($data["typeUser"] === 'U')
			{
				$_SESSION['UserLoged'] = true;

				$_SESSION['UserData'] = $data;

				header('Location: index.php');
				exit();
			}
			else if($data["typeUser"] === 'O')
			{
				$_SESSION['OrganLoged'] = true;

				$_SESSION['OrganData'] = $data;

				header('Location: index.php');
				exit();
			}
			else if($data["typeUser"] === 'G')
			{
				$_SESSION['ManegerLoged'] = true;	

				$_SESSION['ManegerData'] = $data;

				header('Location: dashboard.php');
				exit();
			}
			else
			{
				$_SESSION['UserNotAutheticated'] = true;

				header('Location: login.php');
				exit();	
			}
		}
	}


?>