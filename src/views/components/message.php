<?php if (isset($_SESSION['MESSAGE'])) : ?>
	<?php
	$message = $_SESSION['MESSAGE'];
	unset($_SESSION['MESSAGE']);
	?>
	<div class="message <?= $message['type'] ?>">
		<?= $message['string'] ?>
	</div>
	<script>
		setTimeout(() => {
			document.querySelector('.message').classList.add("message-hidden");
		}, 2000);
	</script>
<?php endif; ?>