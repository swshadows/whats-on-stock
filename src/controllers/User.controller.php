<?php
require 'App.controller.php';
require __SRC__ . '/models/UserDAO.php';
require __SRC__ . '/utils/Message.php';

class UserController
{
	private User $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	// Realiza o login
	public function login()
	{
		// Valida o formato do email
		if (!$this->user->validate_email()) {
			App::set_message(new Message(MessagePatterns::InvalidEmail), "/");
		}

		$user_dao = new UserDAO();

		// Confere se o email está registrado
		$user_saved = $user_dao->find_by_email($this->user->get_email());
		if (!$user_saved) {
			App::set_message(new Message(MessagePatterns::EmailDontExist), "/");
		}

		// Checa se a senha enviada é segura
		$password_status = $this->user->check_password_safe();
		if ($password_status !== true) {
			App::set_message(new Message($password_status), "/");
		}

		// Confere se a senha digitada e a salva são iguais
		if (!$this->user->dehash_password($user_saved['password'])) {
			App::set_message(new Message(MessagePatterns::PasswordsDontMatch), "/");
		}

		$user_formatted = $user_dao->find_by_email($this->user->get_email());
		$_SESSION['LOGIN'] = ['id' => $user_formatted['id'], 'email' => $user_formatted['email']];

		App::set_message(new Message(MessagePatterns::LoginSuccess), "/app");
	}

	// Realiza o logoout
	public function logout()
	{
		unset($_SESSION['LOGIN']);
		App::set_message(new Message(MessagePatterns::LogoutSuccess), "/");
	}

	// Cria um usuário no banco de dados
	public function registerUser(string $password_repeat)
	{
		// Compara se as senhas enviadas são iguais
		if (!$this->user->compare_passwords($password_repeat)) {
			App::set_message(new Message(MessagePatterns::DiffPasswords), "/");
		}

		// Checa se a senha enviada é segura
		$password_status = $this->user->check_password_safe();
		if ($password_status !== true) {
			App::set_message(new Message($password_status), "/");
		}

		// Valida o formato do email
		if (!$this->user->validate_email()) {
			App::set_message(new Message(MessagePatterns::InvalidEmail), "/");
		}

		$user_dao = new UserDAO();

		// Checa se o usuário já está registrado
		if ($user_dao->find_by_email($this->user->get_email())) {
			App::set_message(new Message(MessagePatterns::EmailExists), "/");
		}

		// Aplica hash na senha
		$this->user->set_password_hash();

		// Cria usuário no banco de dados
		$user_dao->create($this->user);

		App::set_message(new Message(MessagePatterns::UserCreated), "/");
	}

	// Atualiza somente o email
	public function updateEmail()
	{

		// Valida o formato do email
		if (!$this->user->validate_email()) {
			App::set_message(new Message(MessagePatterns::InvalidEmail), "/me");
		}

		$user_dao = new UserDAO();

		// Checa se o email já está em uso
		if ($user_dao->find_by_email($this->user->get_email())) {
			App::set_message(new Message(MessagePatterns::EmailExists), "/me");
		}

		$user_dao->update_email($_SESSION['LOGIN']['email'], $this->user->get_email());
		$_SESSION['LOGIN']['email'] = $this->user->get_email();

		App::set_message(new Message(MessagePatterns::UserEmailUpdated), "/me");
	}

	// Atualiza somente a senha
	public function updatePassword(User $usr_w_new_pass, string $password_new_repeat)
	{
		// Compara se as senhas enviadas são iguais
		if (!$usr_w_new_pass->compare_passwords($password_new_repeat)) {
			App::set_message(new Message(MessagePatterns::DiffPasswords), "/me");
		}

		// Checa se a senha enviada é segura
		$password_status = $this->user->check_password_safe();
		if ($password_status !== true) {
			App::set_message(new Message($password_status), "/");
		}

		$user_dao = new UserDAO();

		$user_saved = $user_dao->find_by_email($this->user->get_email());

		// Confere se a senha digitada e a salva são iguais
		if (!$this->user->dehash_password($user_saved['password'])) {
			App::set_message(new Message(MessagePatterns::PasswordsDontMatch), "/me");
		}

		// Aplica hash na senha
		$usr_w_new_pass->set_password_hash();
		$user_dao->update_password($this->user->get_email(), $usr_w_new_pass->get_password());

		App::set_message(new Message(MessagePatterns::UserPasswordUpdated), "/me");
	}

	// Apaga o usuário e relações do banco
	public function deleteUser()
	{
		$user_dao = new UserDAO();

		$user_dao->delete($this->user->get_email());
		unset($_SESSION['LOGIN']);

		App::set_message(new Message(MessagePatterns::UserDeleted), "/");
	}
}
