<?php if (isset($_SESSION['MESSAGE'])) : ?>
	<?php
	$message = $_SESSION['MESSAGE'];
	unset($_SESSION['MESSAGE']);
	?>
	<div class="message <?= $message['type'] ?>">
		<?= $message['string'] ?>
	</div>
<?php endif; ?>