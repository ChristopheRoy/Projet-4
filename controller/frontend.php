<?php // controller

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts()
{
	$postManager = new PostManager();
	$posts = $postManager->getPosts();

	require('view/frontend/listPostsView.php');
}

function post()
{
	$postManager = new PostManager();
	$commentManager = new CommentManager();
	$post = $postManager->getPost($_GET['id']);

	$comments = $commentManager->getComments($_GET['id']);

	require('view/frontend/postView.php');
}