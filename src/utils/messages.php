<?php

class Message
{
	private array $type_arr = ['error', 'success'];
	private string $type;
	private string $message;

	// Getters
	public function get_type()
	{
		return $this->type;
	}

	public function get_message()
	{
		return $this->message;
	}

	// Forbidden
	public function forbidden()
	{
		$this->type = $this->type_arr[0];
		$this->message = "❌ Não é permitido acessar esse endereço diretamente";
	}

	// Usuário não logado
	public function not_auth()
	{
		$this->type = $this->type_arr[0];
		$this->message = "❌ Você ainda não fez login";
	}

	// Senhas diferentes
	public function diff_passwords()
	{
		$this->type = $this->type_arr[0];
		$this->message = "❌ Senhas não são iguais, tente novamente";
	}

	// Padrão de senha incorreto (8 <= Senha <= 255)
	public function password_pattern_wrong()
	{
		$this->type = $this->type_arr[0];
		$this->message = "❌ A senha deve conter de 8 a 255 caracteres";
	}

	// Email inválido
	public function email_invalid()
	{
		$this->type = $this->type_arr[0];
		$this->message = "❌ O email enviado é inválido";
	}

	// Email já registrado
	public function email_already_exists()
	{
		$this->type = $this->type_arr[0];
		$this->message = "❌ Esse e-mail já está registrado";
	}
	// Email não registrado
	public function email_dont_exist()
	{
		$this->type = $this->type_arr[0];
		$this->message = "❌ E-mail não encontrado";
	}

	// Senhas não são iguais
	public function passwords_dont_match()
	{
		$this->type = $this->type_arr[0];
		$this->message = "❌ Senha incorreta, tente novamente";
	}

	// Nome do item vazio
	public function item_name_empty()
	{
		$this->type = $this->type_arr[0];
		$this->message = "❌ Nome do item está vazio";
	}

	// Quantidade do item vazio ou inválido
	public function item_qty_empty()
	{
		$this->type = $this->type_arr[0];
		$this->message = "❌ Quantidade do item está vazio ou é inválida";
	}

	// Item adicionado com sucesso
	public function item_add_success()
	{
		$this->type = $this->type_arr[1];
		$this->message = "✅ Item adicionado com sucesso";
	}

	// Item atualizado com sucesso
	public function item_update_success()
	{
		$this->type = $this->type_arr[1];
		$this->message = "✅ Item atualizado com sucesso";
	}

	// Item deletado com sucesso
	public function delete_item_success()
	{
		$this->type = $this->type_arr[1];
		$this->message = "✅ Item deletado com sucesso";
	}

	// Item não pertence ao usuário logado
	public function user_not_owner()
	{
		$this->type = $this->type_arr[0];
		$this->message = "❌ Você não é dono desse item";
	}

	// Login bem sucedido
	public function login_success()
	{
		$this->type = $this->type_arr[1];
		$this->message = "✅ Login realizado com sucesso";
	}

	// Login bem sucedido
	public function logout_success()
	{
		$this->type = $this->type_arr[1];
		$this->message = "✅ Você fez logout e foi redirecionado";
	}

	// Registro bem sucedido
	public function register_success()
	{
		$this->type = $this->type_arr[1];
		$this->message = "✅ Usuário criado com sucesso! Faça login";
	}

	// Página inexistente: 404
	public function page_dont_exist()
	{
		$this->type = $this->type_arr[0];
		$this->message = "❌ A página acessada não existe, você foi redirecionado";
	}

	// Atualização de email bem sucedida
	public function email_update_success()
	{
		$this->type = $this->type_arr[1];
		$this->message = "✅ Email atualizado com sucesso!";
	}

	// Atualização de senha bem sucedida
	public function password_update_success()
	{
		$this->type = $this->type_arr[1];
		$this->message = "✅ Senha atualizada com sucesso!";
	}

	// Deleção de conta bem sucedida
	public function user_delete_success()
	{
		$this->type = $this->type_arr[1];
		$this->message = "✅ Conta deletada com sucesso! Você foi redirecionado";
	}
}
