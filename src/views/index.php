<?php
require_once 'templates/header.php';
?>

<main class="app">
	<?php require_once 'components/message.php'; ?>
	<div class="app__divider">
		<div class="divider__item">
			<p>Bem-vindo a <b>📦 <?= __NAME__ ?></b>.</p>
			<p>Uma aplicação de gerenciamento de estoque individual</p>
			<p>Desenvolvida para projeto de Desenvolvimento de Sistemas</p>
		</div>
		<?php if (!isset($_SESSION['LOGIN_INFO'])) : ?>
			<div class="divider__item" id="switch-1">
				<!-- Login form -->
				<form action="/user/login" method="POST">
					<label for="email-login"> Digite seu e-mail: </label>
					<input required type="email" id="email-login" name="email" placeholder="Digite seu e-mail">
					<label for="password-login">Digite sua senha: </label>
					<input required type="password" id="password-login" name="password" placeholder="Digite sua senha">
					<label>
						<input type="checkbox" onclick="switchPasswordInputs('password-login')"> Mostrar senha
					</label>
					<input type="submit" value="Fazer login">
				</form>
				<p class="switcher">Ainda não tem uma conta? <a href="#" onclick="switchNodes('switch-1', 'switch-2')">Registre-se</a></p>
			</div>
			<div class="divider__item hidden" id="switch-2">
				<!-- Register form -->
				<form action="/user/create" method="POST">
					<label for="email-reg">Digite seu e-mail:</label>
					<input required type="email" id="email-reg" name="email" placeholder="Digite um email válido (nome@email.com)">
					<label for="password-reg"> Digite sua senha:</label>
					<input required type="password" id="password-reg" name="password" placeholder="Digite uma senha com 8+ caracteres">
					<label for="password-repeat-reg">Repita sua senha:</label>
					<input required type="password" id="password-repeat-reg" name="password-repeat" placeholder="Repita sua senha com 8+ caracteres">
					<label>
						<input type="checkbox" onclick="switchPasswordInputs('password-reg', 'password-repeat-reg')"> Mostrar senhas
					</label>
					<input type="submit" value="Criar conta">
				</form>
				<p class="switcher">Já tem uma conta? Faça <a href="#" onclick="switchNodes('switch-1', 'switch-2')">login</a></p>
			</div>
		<?php else : ?>
			<div class="divider__item">Você está logado, acesse a <a href="/app">clicando aqui</a></div>
		<?php endif; ?>
	</div>
</main>
<?php
require_once 'templates/footer.php';
