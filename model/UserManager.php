<?php

class UserManager extends Manager
{
	public function setUser($name, $password, $email)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('INSERT INTO users(name, password, email, sign_up_date) VALUES(:name, :password, :email, NOW())');
		$query->bindValue(':name', $name, PDO::PARAM_STR);
		$query->bindValue(':password', $password, PDO::PARAM_STR);
		$query->bindValue(':email', $email, PDO::PARAM_STR);
		$affectedLines = $query->execute();

		return $affectedLines;
	}

	public function checkIfTheUserAlreadyExists($name)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT * FROM users WHERE name = :name');
		$query->bindValue(':name', $name, PDO::PARAM_STR);
		$query->execute();

		$theUserAlreadyExists = $query->fetch();

		return $theUserAlreadyExists;
	}

	public function getUser($name)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT id, rank, password FROM users WHERE name = :name');
		$query->bindValue(':name', $name, PDO::PARAM_STR);
		$query->execute();
		$user = $query->fetch();

		return $user;
	}

	public function checkEmail($email)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT id, email FROM users WHERE email = :email');
		$query->bindValue(':email', $email, PDO::PARAM_STR);
		$query->execute();
		$emailExists = $query->fetch();

		return $emailExists;
	}

	public function setToken($userId, $token)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('INSERT INTO forgotten_password(user_id, token) VALUES(:userId, :token)');
		$query->bindValue(':userId', $userId, PDO::PARAM_STR);
		$query->bindValue(':token', $token, PDO::PARAM_STR);
		$affectedLines = $query->execute();

		return $affectedLines;
	}

	public function checkToken($token)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT token FROM forgotten_password WHERE token = :token');
		$query->bindValue(':token', $token, PDO::PARAM_STR);
		$query->execute();
		$tokenExists = $query->fetch();
		return $tokenExists;
	}

	public function checkIfEmailMatchesWithToken($email, $token)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT * FROM forgotten_password INNER JOIN users ON forgotten_password.user_id = users.id WHERE forgotten_password.token = :token AND users.email = :email');
		$query->bindValue(':token', $token, PDO::PARAM_STR);
		$query->bindValue(':email', $email, PDO::PARAM_STR);
		$query->execute();

		$emailMatchesWithToken = $query->fetch();

		return $emailMatchesWithToken;
	}

	public function updatePassword($userId, $password)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('UPDATE users SET password = :password WHERE id = :userId');
		$query->bindValue(':password', $password, PDO::PARAM_STR);
		$query->bindValue(':userId', $userId, PDO::PARAM_STR);

		$affectedLines = $query->execute();

		return $affectedLines;
	}

	public function deleteTokenFromDB($token)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('DELETE FROM forgotten_password WHERE token = :token');
		$query->bindValue(':token', $token, PDO::PARAM_STR);
		$affectedLines = $query->execute();

		return $affectedLines;
	}
}