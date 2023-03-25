<?php
require 'App.controller.php';
require __SRC__ . '/models/ItemDAO.php';
require __SRC__ . '/utils/messages.php';

class ItemController
{
	private Message $msg;
	private Item $item;
	private ItemDAO $item_dao;

	public function __construct(Message $msg, Item $item)
	{
		$this->msg = $msg;
		$this->item = $item;
		$this->item_dao = new ItemDAO();
	}

	// Cria um novo item
	public function registerItem()
	{
		// Checa se o nome está vazio
		if (!$this->item->validate_name()) {
			$this->msg->item_name_empty();
			App::set_message($this->msg, "/app");
		}

		// Checa se a quantidade está vazio
		if (!$this->item->validate_qty()) {
			$this->msg->item_qty_empty();
			App::set_message($this->msg, "/app");
		}

		$this->item_dao->create($this->item);

		$this->msg->item_add_success();
		App::set_message($this->msg, "/app");
	}

	// Atualiza nome do item
	public function updateName(int $item_id)
	{
		// Checa se o nome está vazio
		if (!$this->item->validate_name()) {
			$this->msg->item_name_empty();
			App::set_message($this->msg, "/app");
		}

		// Checa se o usuário logado é o dono do item
		if (!$this->item_dao->check_owner($item_id)) {
			$this->msg->user_not_owner();
			App::set_message($this->msg, "/app");
		}

		$this->item_dao->update_name($item_id, $this->item->get_name());

		$this->msg->item_update_success();
		App::set_message($this->msg, "/app");
	}

	// Atualiza quantidade do item
	public function updateQty(int $item_id)
	{
		// Checa se a quantidade está vazio
		if (!$this->item->validate_qty()) {
			$this->msg->item_qty_empty();
			App::set_message($this->msg, "/app");
		}


		// Checa se o usuário logado é o dono do item
		if (!$this->item_dao->check_owner($item_id)) {
			$this->msg->user_not_owner();
			App::set_message($this->msg, "/app");
		}

		$this->item_dao->update_qty($item_id, $this->item->get_qty());

		$this->msg->item_update_success();
		App::set_message($this->msg, "/app");
	}

	// Deleta o item 
	public function deleteItem(int $item_id)
	{
		// Checa se o usuário logado é o dono do item
		if (!$this->item_dao->check_owner($item_id)) {
			$this->msg->user_not_owner();
			App::set_message($this->msg, "/app");
		}

		$this->item_dao->delete($item_id);

		$this->msg->delete_item_success();
		App::set_message($this->msg, "/app");
	}
}
