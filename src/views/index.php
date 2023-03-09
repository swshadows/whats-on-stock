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
				<label>
					<p>Digite seu e-mail:</p>
					<input type="text" placeholder="Digite seu e-mail">
				</label>
				<label>
					<p>Digite sua senha:</p>
					<input type="password" placeholder="Digite sua senha" id="password-login">
				</label>
				<label>
					<input type="checkbox" onclick="switchPasswordInputs('password-login')"> Mostrar senha
				</label>
			</form>
			<p class="switcher">Ainda não tem uma conta? <a href="#" onclick="switchNodes('switch-1', 'switch-2')">Registre-se</a></p>
		</div>
		<div class="--item hidden" id="switch-2">
			<!-- Register form -->
			<form>
				<label>
					<p>Digite seu e-mail:</p>
					<input type="text" placeholder="Digite um email válido (nome@email.com)">
				</label>
				<label>
					<p>Digite sua senha:</p>
					<input type="password" placeholder="Digite uma senha com 8+ caracteres" id="password-reg">
				</label>
				<label>
					<p>Repita sua senha:</p>
					<input type="password" placeholder="Repita sua senha com 8+ caracteres" id="repeat-password-reg">
				</label>
				<label>
					<input type="checkbox" onclick="switchPasswordInputs('password-reg', 'repeat-password-reg')"> Mostrar senhas
				</label>
			</form>
			<p class="switcher">Já tem uma conta? Faça <a href="#" onclick="switchNodes('switch-1', 'switch-2')">login</a></p>
		</div>
	</div>

</main>
<?php
require_once 'templates/footer.php';
