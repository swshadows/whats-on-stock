<?php
require_once 'templates/header.php';
?>

<main class="app">
	<div class="__divider">
		<div class="--item">
			<p>Bem-vindo a <b>📦 <?= __NAME__ ?></b>.</p>
			<p>Uma aplicação de gerenciamento de estoque individual</p>
			<p>Desenvolvida para projeto de Desenvolvimento de Sistemas</p>
		</div>
		<div class="--item" id="switch-1">
			<!-- Login form -->
			<form>
				<label for="email-login"> Digite seu e-mail: </label>
				<input type="text" id="email-login" placeholder="Digite seu e-mail">
				<label for="password-login">Digite sua senha: </label>
				<input type="password" id="password-login" placeholder="Digite sua senha">
				<label>
					<input type="checkbox" onclick="switchPasswordInputs('password-login')"> Mostrar senha
				</label>
			</form>
			<p class="switcher">Ainda não tem uma conta? <a href="#" onclick="switchNodes('switch-1', 'switch-2')">Registre-se</a></p>
		</div>
		<div class="--item hidden" id="switch-2">
			<!-- Register form -->
			<form action="/user/create" method="POST">
				<label for="email-reg">Digite seu e-mail:</label>
				<input type="text" id="email-reg" name="email" placeholder="Digite um email válido (nome@email.com)">
				<label for="password-reg"> Digite sua senha:</label>
				<input type="password" id="password-reg" name="password" placeholder="Digite uma senha com 8+ caracteres">
				<label for="repeat-password-reg">Repita sua senha:</label>
				<input type="password" id="repeat-password-reg" name="password-repeat" placeholder="Repita sua senha com 8+ caracteres">
				<label>
					<input type="checkbox" onclick="switchPasswordInputs('password-reg', 'repeat-password-reg')"> Mostrar senhas
				</label>
				<input type="submit" value="Criar conta">
			</form>
			<p class="switcher">Já tem uma conta? Faça <a href="#" onclick="switchNodes('switch-1', 'switch-2')">login</a></p>
		</div>
	</div>
	<?php require_once 'components/message.php' ?>
</main>
<?php
require_once 'templates/footer.php';
