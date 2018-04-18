<?php // controller back

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function adminListPosts()
{
	$postManager = new PostManager();
	$posts = $postManager->getPostsPreviews();

	require('view/backend/adminListPostsView.php');
}

function createNewArticle()
{
	require('view/backend/createNewArticleView.php');
}

function addPost($postContent)
{
	$postManager = new PostManager();
	$affectedLines = $postManager->postPost($postContent);

	if($affectedLines == false)
	{
		throw new Exception('Impossible d\'ajouter le post en base de données.');
	}
	else
	{
		header('Location: index.php?access=admin&page=dashboard');
	}
}

function editPost()
{
	$postManager = new PostManager();
	$postContent = $postManager->getContentOfEditedPost($_GET['id']);

	require('view/backend/editPostView.php');
}

function updatePost($postId, $postContent)
{
	$postManager = new PostManager();
	$affectedLines = $postManager->PostUpdatedPost($postId, $postContent);

	if ($affectedLines == false)
	{
		throw new Exception('Erreur lors de la mise à jour du post en base de données.');
	}
	else
	{
		header('Location:index.php?access=admin&page=dashboard');
	}
}

function removePost($checked_posts_id)
{
	$postManager = new PostManager();
	foreach ($checked_posts_id as $postId)
	 {
		$affectedLines = $postManager->deletePost($postId);

		if ($affectedLines == false)
		{
			throw new Exception('Erreur lors de la supression du ou des posts en base de données.');
		}
		else
		{
			header('Location:index.php?access=admin&page=dashboard');
		}
	}
}