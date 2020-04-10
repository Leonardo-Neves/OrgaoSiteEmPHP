<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
	<?php include('shared/header.php'); ?>	

	<div class="container">

		<div class="card p-5 m-5">
			<?php include('ValidationMessages.php'); ?>
			<form class="form-group" action="UserController.php" method="POST">
				<div class="row">
					<div class="col-md-6">
						<label>Nome:</label>
						<input class="form-control" type="text" name="name">
					</div>
					<div class="col-md-6 p-4">
						<div class="row">
							<div class="col-md-6">
								<div class="form-check">
								  	<input class="form-check-input" type="radio" value="O" name="type">
								  	<label class="form-check-label">Organização</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-check">
								  	<input class="form-check-input" type="radio" value="U" name="type">
								  	<label class="form-check-label">Usuário</label>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label>CNPJ/CPF</label>
						<input class="form-control" type="text" name="cnpjAndCpf">
					</div>
					<div class="col-md-6">
						<label>Telefone:</label>
						<input class="form-control" type="text" name="fone">
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label>Email:</label>
						<input class="form-control" type="text" name="email">
					</div>
					<div class="col-md-6">
						<label>Senha:</label>
						<input class="form-control" type="text" name="password">
					</div>
					
				</div>

				<div class="row">
					<div class="col-md-4">
						<label>CEP:</label>
						<input class="form-control" type="text" id="cep" name="cep">
					</div>
					<div class="col-md-4">
						<label>Rua:</label>
						<input class="form-control" type="text" id="rua" name="street">
					</div>
					<div class="col-md-4">
						<label>Bairro:</label>
						<input class="form-control" type="text" id="bairro" name="neighborhood">
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label>Cidade:</label>
						<input class="form-control" type="text" id="cidade" name="city">
					</div>
					<div class="col-md-4">
						<label>UF</label>
						<input class="form-control" type="text" id="uf" name="uf">
					</div>
					<div class="col-md-4">
						<label>IBGE:</label>
						<input class="form-control" type="text" id="ibge" name="ibge">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label>Descrição:</label>
						<textarea class="form-control" name="description"></textarea>
					</div>
				</div>
				
				<input class="form-control" type="hidden" value="FULL" name="register">

				<button type="submit" class="btn btn-primary mt-3">Enviar</button>
			</form>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<script src="assets/js/autoCompleteCEP.js"></script>
</body>
</html>