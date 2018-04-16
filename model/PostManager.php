<?php // model

require_once('Manager.php');

class PostManager extends Manager
{
	public function getPosts()
	{
		$db = $this->dbConnect();
		$query = $db->query('SELECT * FROM posts');
		return $query;
	}

	public function getPost($postId)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT * FROM posts WHERE id = :postId');
		$query->bindValue(':postId', $postId, PDO::PARAM_INT);
		$query->execute();
		$post = $query->fetch();
		return $post;
	}

	public function getPostsPreviews()
	{
		$db = $this->dbConnect();
		$query = $db->query('SELECT * FROM posts');
		return $query;
	}

	public function getContentOfEditedPost($postId)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT * FROM posts WHERE id = :postId');
		$query->bindValue(':postId', $postId, PDO::PARAM_STR);
		$query->execute();
		$postContent = $query->fetch();
		return $postContent;
	}

	public function PostUpdatedPost($postId, $postContent)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('UPDATE posts SET content = :postContent WHERE id = :postId');
		$query->bindValue(':postContent', $postContent, PDO::PARAM_STR);
		$query->bindValue(':postId', $postId, PDO::PARAM_INT);
		$query->execute();

		return $query;
	}
}