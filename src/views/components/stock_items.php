<?php
require_once __SRC__ . "/models/ItemDAO.php";
$item_dao = new ItemDAO();
$arr = $item_dao->find_all();
?>

<?php if ($arr && sizeof($arr) > 0) : ?>
	<div class="stock-item stock-header">
		<p>📦 Nome</p>
		<p>📦 Quantidade</p>
		<p>🧩 Editar</p>
		<p>🧨 Apagar</p>
	</div>
	<?php foreach ($arr as $i) : ?>
		<div class="stock-item">
			<p><?= $i['name'] ?></p>
			<p><?= $i['qty'] ?></p>
			<p>
				<button class="edit-button" onclick="toggleModal('modal-<?= $i['id'] ?>')">🧩</i></button>
			</p>
			<p>
				<button class="del-button" onclick="toggleModal('modal-del-<?= $i['id'] ?>')">🧨</button>
			</p>
		</div>
		<div class="modal hidden" id="modal-del-<?= $i['id'] ?>">
			<div class="modal-block">
				<button class="close-modal" onclick="toggleModal('modal-del-<?= $i['id'] ?>')">❌</button>
				<p>Deseja realmente apagar o item <?= $i['name'] ?>?</p>
				<p>Essa ação é irreversivel!</p>
				<form action="/item/delete" method="POST">
					<input type="hidden" name="id" value="<?= $i['id'] ?>">
					<input type="submit" class="item-delete-button" value="Deletar item">
				</form>
			</div>
		</div>
		<div class="modal hidden" id="modal-<?= $i['id'] ?>">
			<div class="modal-block">
				<button class="close-modal" onclick="toggleModal('modal-<?= $i['id'] ?>')">❌</button>
				<form action="/item/update_name" method="POST">
					<label>Editar nome:</label>
					<input type="text" name="name" value="<?= $i['name'] ?>" placeholder="Digite um novo nome">
					<input type="hidden" name="id" value="<?= $i['id'] ?>">
					<input type="submit" value="Atualizar nome">
				</form>
				<form action="/item/update_qty" method="POST">
					<label>Editar quantidade:</label>
					<input type="number" name="qty" value="<?= $i['qty'] ?>" placeholder="Digite uma nova quantidade">
					<input type="hidden" name="id" value="<?= $i['id'] ?>">
					<input type="submit" value="Atualizar quantidade">
				</form>
			</div>
		</div>
	<?php endforeach; ?>
	<div class="exports">
		<a target="_blank" href="/export/json">Exportar JSON</a>
		<a target="_blank" href="/export/pdf">Imprimir/Exportar PDF</a>
	</div>
<?php else : ?>
	<div class="no-item">Não existem itens registrados</div>
<?php endif; ?>