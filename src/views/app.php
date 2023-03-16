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

require_once __SRC__ . "/models/ItemDAO.php";

$item_dao = new ItemDAO();

$arr = $item_dao->find_all();

?>

<main class="app">
	<h1 class="app-title">Meu estoque</h1>
	<div class="app-stock">
		<?php require_once __SRC__ . "/views/components/add_item_modal.php"; ?>
		<?php if ($arr && sizeof($arr) > 0) : ?>
			<div class="stock-item stock-header">
				<p>📦 ID</p>
				<p>📦 Nome</p>
				<p>📦 Quantidade</p>
				<p>🧩 Editar</p>
				<p>🧨 Apagar</p>
			</div>
			<?php foreach ($arr as $i) : ?>
				<div class="stock-item">
					<p><?= $i['id'] ?></p>
					<p><?= $i['name'] ?></p>
					<p><?= $i['qty'] ?></p>
					<p>
						<button class="edit-button" onclick="toggleModal('modal-<?= $i['id'] ?>')">🧩</i></button>
					</p>
					<p>
						<button class="del-button" onclick="toggleModal('modal-del-<?= $i['id'] ?>')">🧨</button>
					</p>
				</div>
				<div class="app-modal hidden" id="modal-del-<?= $i['id'] ?>">
					<div class="app-modal-block">
						<button class="close-modal" onclick="toggleModal('modal-del-<?= $i['id'] ?>')">❌</button>
						<p>Deseja realmente apagar o item <?= $i['name'] ?>?</p>
						<p>Essa ação é irreversivel!</p>
						<form action="/item/delete" method="POST">
							<input type="hidden" name="id" value="<?= $i['id'] ?>">
							<input type="submit" class="item-delete-button" value="Deletar item">
						</form>
					</div>
				</div>
				<div class="app-modal hidden" id="modal-<?= $i['id'] ?>">
					<div class="app-modal-block">
						<button class="close-modal" onclick="toggleModal('modal-<?= $i['id'] ?>')">❌</button>
						<form>
							<label>Editar nome:</label>
							<input type="text" name="name" value="<?= $i['name'] ?>" placeholder="Digite um novo nome">
							<input type="submit" value="Atualizar nome">
						</form>
						<form>
							<label>Editar quantidade:</label>
							<input type="number" name="qty" value="<?= $i['qty'] ?>" placeholder="Digite uma nova quantidade">
							<input type="submit" value="Atualizar quantidade">
						</form>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<div class="no-item">Não existem itens registrados</div>
		<?php endif; ?>
	</div>
</main>
<?php
require_once "templates/footer.php";
