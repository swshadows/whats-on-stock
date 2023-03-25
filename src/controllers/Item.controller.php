<?php
require 'App.controller.php';
require __SRC__ . '/models/ItemDAO.php';
require __SRC__ . '/utils/Message.php';

class ItemController
{
	private Item $item;

	public function __construct(Item $item)
	{
		$this->item = $item;
	}

	// Cria um novo item
	public function registerItem()
	{
		// Checa se o nome está vazio
		if (!$this->item->validate_name()) {
			App::set_message(new Message(MessagePatterns::ItemNameEmpty), "/app");
		}

		// Checa se a quantidade está vazio
		if (!$this->item->validate_qty()) {
			App::set_message(new Message(MessagePatterns::ItemQtyEmpty), "/app");
		}

		$item_dao = new ItemDAO();
		$item_dao->create($this->item);

		App::set_message(new Message(MessagePatterns::ItemAdded), "/app");
	}

	// Atualiza nome do item
	public function updateName(int $item_id)
	{
		// Checa se o nome está vazio
		if (!$this->item->validate_name()) {
			App::set_message(new Message(MessagePatterns::ItemNameEmpty), "/app");
		}

		$item_dao = new ItemDAO();

		// Checa se o usuário logado é o dono do item
		if (!$item_dao->check_owner($item_id)) {
			App::set_message(new Message(MessagePatterns::NotOwnerOfItem), "/app");
		}

		$item_dao->update_name($item_id, $this->item->get_name());

		App::set_message(new Message(MessagePatterns::ItemUpdated), "/app");
	}

	// Atualiza quantidade do item
	public function updateQty(int $item_id)
	{
		// Checa se a quantidade está vazio
		if (!$this->item->validate_qty()) {
			App::set_message(new Message(MessagePatterns::ItemQtyEmpty), "/app");
		}

		$item_dao = new ItemDAO();

		// Checa se o usuário logado é o dono do item
		if (!$item_dao->check_owner($item_id)) {
			App::set_message(new Message(MessagePatterns::NotOwnerOfItem), "/app");
		}

		$item_dao->update_qty($item_id, $this->item->get_qty());

		App::set_message(new Message(MessagePatterns::ItemUpdated), "/app");
	}

	// Deleta o item 
	public function deleteItem(int $item_id)
	{
		$item_dao = new ItemDAO();

		// Checa se o usuário logado é o dono do item
		if (!$item_dao->check_owner($item_id)) {
			App::set_message(new Message(MessagePatterns::NotOwnerOfItem), "/app");
		}

		$item_dao->delete($item_id);

		App::set_message(new Message(MessagePatterns::ItemDeleted), "/app");
	}
}
