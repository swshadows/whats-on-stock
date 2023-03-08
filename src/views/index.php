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
		<div class="--item">
			<form>
				<label>
					<p>Digite seu e-mail:</p>
					<input type="text" placeholder="nome@email.com">
				</label>
				<label>
					<p>Digite sua senha:</p>
					<input type="password" placeholder="Senha">
				</label>
			</form>
		</div>
	</div>

</main>

<?php
require_once 'templates/footer.php';
