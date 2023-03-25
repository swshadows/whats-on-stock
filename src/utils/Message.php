<?php

enum MessagePatterns: string
{
		// Mensagens do app
	case Forbidden = "❌ Não é permitido acessar esse endereço diretamente";
	case NotOwnerOfItem = "❌ Você não é dono desse item";
		// Mensagens de usuário
	case NotLogged = "❌ Você ainda não fez login";
	case DiffPasswords = "❌ Senhas não são iguais, tente novamente";
	case WrongPasswordPattern = "❌ A senha deve conter de 8 a 255 caracteres";
	case InvalidEmail = "❌ O email enviado é inválido";
	case EmailExists = "❌ Esse e-mail já está registrado";
	case EmailDontExist = "❌ E-mail não encontrado";
	case PasswordsDontMatch = "❌ Senha incorreta, tente novamente";
	case LoginSuccess = "✅ Login realizado com sucesso";
	case LogoutSuccess = "✅ Você fez logout e foi redirecionado";
	case UserCreated = "✅ Usuário criado com sucesso! Faça login";
	case UserEmailUpdated = "✅ Email atualizado com sucesso!";
	case UserPasswordUpdated = "✅ Senha atualizada com sucesso!";
	case UserDeleted = "✅ Conta deletada com sucesso! Você foi redirecionado";
		// Mensagens de item
	case ItemNameEmpty = "❌ Nome do item está vazio";
	case ItemQtyEmpty = "❌ Quantidade do item está vazio ou é inválida";
	case ItemAdded = "✅ Item adicionado com sucesso";
	case ItemUpdated = "✅ Item atualizado com sucesso";
	case ItemDeleted = "✅ Item deletado com sucesso";
}


class Message
{
	private string $type;
	private string $message;

	public function __construct(MessagePatterns $msg)
	{
		$this->message = $msg->value;
		if (strpos($msg->value, "❌") !== false) {
			$this->type = "error";
		} else $this->type = "success";
	}

	public function get_type()
	{
		return $this->type;
	}

	public function get_message()
	{
		return $this->message;
	}

	public function set_message(MessagePatterns $msg)
	{
		self::__construct($msg);
	}
}
