<?php
require_once "templates/header.php";
require_once 'components/message.php';

require_once __SRC__ . "/controllers/App.controller.php";
require_once __SRC__ . "/utils/messages.php";

$msg = new Message();

if (!App::check_auth()) {
	$msg->not_auth();
	App::set_message($msg, "/");
}
?>

<main class="app">
	<h1 class="app-title">Meu estoque</h1>
	<div class="app-stock">
		<?php
		require_once __SRC__ . "/views/components/add_item_modal.php";
		require_once __SRC__ . "/views/components/stock_items.php";
		?>
	</div>
</main>
<?php
require_once "templates/footer.php";
