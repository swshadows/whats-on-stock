<?php
require 'App.controller.php';
require __SRC__ . '/models/UserDAO.php';
require __SRC__ . '/utils/messages.php';

class UserController
{
	private Message $msg;
	private User $user;
	private UserDAO $user_dao;

	public function __construct(Message $msg, User $user)
	{
		$this->msg = $msg;
		$this->user = $user;
		$this->user_dao = new UserDAO();
	}

	// Realiza o login
	public function login()
	{
		// Valida o formato do email
		if (!$this->user->validate_email()) {
			$this->msg->email_invalid();
			App::set_message($this->msg, "/");
		}

		// Confere se o email está registrado
		$user_saved = $this->user_dao->find_by_email($this->user->get_email());
		if (!$user_saved) {
			$this->msg->email_dont_exist();
			App::set_message($this->msg, "/");
		}

		// Vê se a senha tem mais que 8 caracteres e menos que 255 caracteres
		if (!$this->user->check_password_safe()) {
			$this->msg->password_pattern_wrong();
			App::set_message($this->msg, "/");
		}

		// Confere se a senha digitada e a salva são iguais
		if (!$this->user->dehash_password($user_saved['password'])) {
			$this->msg->passwords_dont_match();
			App::set_message($this->msg, "/");
		}

		$user_formatted = $this->user_dao->find_by_email($this->user->get_email());
		$_SESSION['LOGIN'] = ['id' => $user_formatted['id'], 'email' => $user_formatted['email']];

		$this->msg->login_success();
		App::set_message($this->msg, "/app");
	}

	// Realiza o logoout
	public function logout()
	{
		unset($_SESSION['LOGIN']);
		$this->msg->logout_success();
		App::set_message($this->msg, "/");
	}

	// Cria um usuário no banco de dados
	public function registerUser(string $password_repeat)
	{
		// Compara se as senhas enviadas são iguais
		if (!$this->user->compare_passwords($password_repeat)) {
			$this->msg->diff_passwords();
			App::set_message($this->msg, "/");
		}

		// Vê se a senha tem mais que 8 caracteres e menos que 255 caracteres
		if (!$this->user->check_password_safe()) {
			$this->msg->password_pattern_wrong();
			App::set_message($this->msg, "/");
		}

		// Valida o formato do email
		if (!$this->user->validate_email()) {
			$this->msg->email_invalid();
			App::set_message($this->msg, "/");
		}

		// Checa se o usuário já está registrado
		if ($this->user_dao->find_by_email($this->user->get_email())) {
			$this->msg->email_already_exists();
			App::set_message($this->msg, "/");
		}

		// Aplica hash na senha
		$this->user->set_password_hash();

		// Cria usuário no banco de dados
		$this->user_dao->create($this->user);

		$this->msg->register_success();
		App::set_message($this->msg, "/");
	}

	// Atualiza somente o email
	public function updateEmail()
	{

		// Valida o formato do email
		if (!$this->user->validate_email()) {
			$this->msg->email_invalid();
			App::set_message($this->msg, "/me");
		}

		// Checa se o email já está em uso
		if ($this->user_dao->find_by_email($this->user->get_email())) {
			$this->msg->email_already_exists();
			App::set_message($this->msg, "/me");
		}

		$this->user_dao->update_email($_SESSION['LOGIN']['email'], $this->user->get_email());
		$_SESSION['LOGIN']['email'] = $this->user->get_email();

		$this->msg->email_update_success();
		App::set_message($this->msg, "/me");
	}

	// Atualiza somente a senha
	public function updatePassword(User $usr_w_new_pass, string $password_new_repeat)
	{
		// Compara se as senhas enviadas são iguais
		if (!$usr_w_new_pass->compare_passwords($password_new_repeat)) {
			$this->msg->diff_passwords();
			App::set_message($this->msg, "/me");
		}

		// Vê se a senha tem mais que 8 caracteres e menos que 255 caracteres
		if (!$usr_w_new_pass->check_password_safe()) {
			$this->msg->password_pattern_wrong();
			App::set_message($this->msg, "/me");
		}

		$user_saved = $this->user_dao->find_by_email($this->user->get_email());

		// Confere se a senha digitada e a salva são iguais
		if (!$this->user->dehash_password($user_saved['password'])) {
			$this->msg->passwords_dont_match();
			App::set_message($this->msg, "/me");
		}

		// Aplica hash na senha
		$usr_w_new_pass->set_password_hash();
		$this->user_dao->update_password($this->user->get_email(), $usr_w_new_pass->get_password());

		$this->msg->password_update_success();
		App::set_message($this->msg, "/me");
	}

	// Apaga o usuário e relações do banco
	public function deleteUser()
	{
		$this->user_dao->delete($this->user->get_email());
		unset($_SESSION['LOGIN']);

		$this->msg->user_delete_success();
		App::set_message($this->msg, "/");
	}
}
