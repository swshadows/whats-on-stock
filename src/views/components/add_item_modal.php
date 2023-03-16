<div id="add-item-modal" class="app-modal hidden">
	<div class="app-modal-block">
		<button class="close-modal" onclick="toggleModal('add-item-modal')">❌</button>
		<form action="/item/add" method="POST">
			<label>Nome do item:</label>
			<input required type="text" name="name" placeholder="Digite o nome do item">
			<label>Quantidade do item:</label>
			<input required type="number" name="qty" placeholder="Digite a quantidade do item">
			<input type="submit" value="Adicionar novo item">
		</form>
	</div>
</div>