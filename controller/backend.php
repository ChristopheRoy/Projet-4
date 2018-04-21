<?php // controller back

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');

function adminListPosts()
{
	if(isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['rank']) && $_SESSION['rank'] == 'admin')
	{
		$postManager = new PostManager();
		$posts = $postManager->getPostsPreviews();
		require('view/backend/adminListPostsView.php');
	}
	else
	{
		throw new Exception('Erreur. Vous n\'avez pas accès à cette page.');
	}

	
}

function createNewArticle()
{
	if(isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['rank']) && $_SESSION['rank'] == 'admin')
	{
		require('view/backend/createNewArticleView.php');
	}
	else
	{
		throw new Exception('Erreur. Vous n\'avez pas accès à cette page.');
	}
}

function addPost($postContent)
{
	if(isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['rank']) && $_SESSION['rank'] == 'admin')
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
	else
	{
		throw new Exception('Erreur. Vous n\'avez pas accès à cette page.');
	}
}

function editPost()
{
	if(isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['rank']) && $_SESSION['rank'] == 'admin')
	{
		$postManager = new PostManager();
		$postContent = $postManager->getContentOfEditedPost($_GET['id']);

		require('view/backend/editPostView.php');
	}
	else
	{
		throw new Exception('Erreur. Vous n\'avez pas accès à cette page.');
	}
		
}

function updatePost($postId, $postContent)
{
	if(isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['rank']) && $_SESSION['rank'] == 'admin')
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
	else
	{
		throw new Exception('Erreur. Vous n\'avez pas accès à cette page.');
	}	
}

function removePost($checked_posts_id)
{
	if(isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['rank']) && $_SESSION['rank'] == 'admin')
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
	else
	{
		throw new Exception('Erreur. Vous n\'avez pas accès à cette page.');
	}	
}

function listReportedComments()
{
	if(isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['rank']) && $_SESSION['rank'] == 'admin')
	{
		$commentManager = new CommentManager;
		$query = $commentManager->getReportedComments();

		require('view/backend/listReportedCommentsView.php');
	}	
	else
	{
		throw new Exception('Erreur. Vous n\'avez pas accès à cette page.');
	}	
}

function removeComment($checked_comments_id)
{
	if(isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['rank']) && $_SESSION['rank'] == 'admin')
	{
		$commentManager = new CommentManager();
		foreach ($checked_comments_id as $comment_id)
		 {
			$affectedLines = $commentManager->deleteComment($comment_id);

			if ($affectedLines == false)
			{
				throw new Exception('Erreur lors de la supression du ou des commentaires en base de données.');
			}
			else
			{
				header('Location:index.php?access=admin&page=reported_comments');
			}
		}
	}
	else
	{
		throw new Exception('Erreur. Vous n\'avez pas accès à cette page.');
	}	
}