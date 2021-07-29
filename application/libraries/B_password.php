<?php
defined('BASEPATH') or exit('No direct script access allowed');

class B_password
{

	private $hash_prefix = '$2y$10$';

	public function bcrypt_hash($password, $round = 10)
	{
		$config = array(
			'cost' => $round
		);

		return password_hash($password, PASSWORD_BCRYPT, $config);
	}

	public function create_hash($password)
	{
		return substr(password_hash(
			$password,
			PASSWORD_BCRYPT,
			array(
				'cost' => 10
			)
		), 7);
	}

	public function verify($password, $hash)
	{
		return password_verify($password, $this->hash_prefix . $hash);
	}

	public function hash_check($password, $hashed_password)
	{
		return password_verify($password, $hashed_password);
	}
}
