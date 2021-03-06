<?php // controller front

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('vendor/autoload.php');

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');

function getIndexView()
{
	if(isset($_SESSION['id']) && isset($_SESSION['name']))
	{
		$messageDeBienvenue = "Bienvenue sur mon site,  " . $_SESSION['name'] . " !";
	}
	else
	{
		$messageDeBienvenue = 'Bienvenue sur mon site, Visiteur ! ';
		
	}
	require('view/frontend/indexView.php');
}

function listPosts($pageCourante)
{
	$postsPerPage = 5;
	$depart = ($pageCourante-1)*$postsPerPage;

	$postManager = new PostManager();
	$posts = $postManager->getPostsPreviews($depart, $postsPerPage);
	$numberOfPosts = $postManager->getNumberOfPosts();

	$nombreDePages = ceil($numberOfPosts/$postsPerPage); 

	if(isset($_GET['page']) && $_GET['page'] > $nombreDePages)
	{
		header('Location: index.php?action=listPosts');
	}
	

	$commentManager = new CommentManager(); // using this variable to call a method in the view

	require('view/frontend/listPostsView.php');
}

function post($pageCourante)
{
	$commentsPerPage = 5;
	$depart = ($pageCourante-1)*$commentsPerPage;



	$postManager = new PostManager();
	$commentManager = new CommentManager();
	$post = $postManager->getPost($_GET['id']);

	$comments = $commentManager->getComments($_GET['id'], $depart, $commentsPerPage);
	$numberOfComments = $commentManager->getNumberOfComments($_GET['id']);
	$nombreDePages = ceil($numberOfComments/$commentsPerPage);

	require('view/frontend/postView.php');
}

function comment()
{
	$commentManager = new CommentManager();
	$comment = $commentManager->getComment($_GET['id']);


	require('view/frontend/commentView.php');
}

function addComment()
{
	if(isset($_SESSION['name']) && isset($_POST['comment']) && !empty($_POST['comment']))
	{
		$comment = htmlspecialchars($_POST['comment']);
		$commentManager = new CommentManager();
		$affectedLines = $commentManager->postComment($_GET['id'], $_SESSION['name'], $comment);

		if($affectedLines == false)
		{
			throw new Exception('Impossible d\'ajouter le commentaire !');
		}
		else
		{
			header('Location: index.php?action=post&id=' . $_GET['id']);
		}
	}
	else
	{
		throw new Exception('Erreur : tous les champs ne sont pas remplis !');
	}
}

function reportComment($post_id, $comment_id)
{
	if(isset($_POST['reason']) && !empty($_POST['reason']))
	{
		$reason = htmlspecialchars($_POST['reason']);
		$commentManager = new CommentManager();
		$theCommentStillExists = $commentManager->checkIfTheCommentStillExists($comment_id);

		if($theCommentStillExists)
		{
			$theUserHasAlreadyReportedThisComment = $commentManager->checkIfTheUserHasAlreadyReportedThisComment($_SESSION['name'], $comment_id);
			if($theUserHasAlreadyReportedThisComment)
			{
				throw new Exception("Vous avez déjà signalé ce commentaire ! ");
			}
			else
			{
				$affectedLines = $commentManager->setReportedComment($comment_id, $_SESSION['name'], $reason);
				if($affectedLines == false)
				{
					throw new Exception('Impossible d\'envoyer le commentaire signalé en base de données. Veuillez réessayer plus tard.');
				}
				else
				{
					header('Location: index.php?action=post&id=' . $post_id);
				}
			}		
		}
		else
		{
			throw new Exception("Ce commentaire a déjà été supprimé par un Administrateur ! Merci de votre signalement.");
		}
	}
	else
	{
		throw new Exception("Erreur. Vous devez remplir les champs du formulaire !");
	}
}

function addUser()
{
	if(isset($_POST['name']) && isset($_POST['password1']) && isset($_POST['password2']) && isset($_POST['email']))
		{
			$userName = htmlspecialchars($_POST['name']);
			if(!empty($_POST['name']) && !empty($_POST['password1']) && !empty($_POST['password2']) && !empty($_POST['email']))
			{
				$userManager = new UserManager();
				$theUserAlreadyExists = $userManager->checkIfTheUserAlreadyExists($userName);

				if($theUserAlreadyExists)
				{
					throw new Exception("Erreur : ce pseudo est déjà pris !");
				}
				else
				{
					if($_POST['password1'] == $_POST['password2'])
					{
						$password = password_hash($_POST['password1'], PASSWORD_DEFAULT);
						$email = $_POST['email'];

						$userManager = new UserManager();
						$affectedLines = $userManager->setUser($userName, $password, $email);

						if($affectedLines == false)
						{
							throw new Exception('Impossible d\'ajouter l\'utilisateur en base de données !');
						}
						else
						{
							header('Location: index.php');
						}			
					}
					else
					{
						throw new Exception('Erreur : les mots de passe ne correspondent pas.');
					} 
				}
			}
			else
			{
				throw new Exception('Erreur. Un ou plusieurs champs n\'ont pas été remplis.');
			}
		}
	else
	{
		throw new Exception('Erreur. Un des champs est manquant.');
	}
}

function signIn()
{	

	if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['password']) && !empty($_POST['password']))
	{
		$name = htmlspecialchars($_POST['name']);
		$password = $_POST['password'];

		$userManager = new UserManager();
		$user = $userManager->getUser($name);

		$isPasswordCorrect = password_verify($password, $user['password']);

		if($isPasswordCorrect)
		{
			session_start();
			$_SESSION['id'] = $user['id'];
			$_SESSION['name'] = $name;
			$_SESSION['rank'] = $user['rank'];
			header('Location: index.php');
		}
		else
		{
			throw new Exception('Identifiant ou mot de passe incorrect.');
		}


	}
	else
	{
		throw new Exception('Erreur : Vous devez remplir tous les champs.');
	}
}

function disconnect()
{
	session_start();

	if(isset($_SESSION['id']) && isset($_SESSION['name']))
	{
		// Suppression des variables de session et de la session
		$_SESSION = array();
		session_destroy();

		// Suppression des cookies de connexion automatique
		setcookie('login', '');
		setcookie('pass_hash', '');

		header('Location: index.php');
	}
	else
	{
		throw new Exception('Erreur : vous êtes déjà déconnecté.');
	}
}

function getForgottenPasswordView()
{
	require('view/frontend/forgottenPasswordView.php');
}

function sendEmail()
{

	if(isset($_POST['email']) && !empty($_POST['email']))
	{
		$userManager = new UserManager();
		$emailExists = $userManager->checkEmail($_POST['email']);
		$userId = $emailExists['id'];

		if($emailExists)
		{
			$token = md5(uniqid(rand()));
			$affectedLines = $userManager->setToken($userId, $token);

			if($affectedLines == false)
			{
				throw new Exception("Impossible d'ajouter le token en base de données !");
			}
			else
			{
		
				$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
				try
				{
					require('private/smtp_password.php');
					
					//Server settings
					// $mail->SMTPDebug = 2;                                 // Enable verbose debug output
					$mail->isSMTP();                                      // Set mailer to use SMTP
					$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
					$mail->SMTPAuth = true;                               // Enable SMTP authentication
					$mail->Username = 'projet4.test@gmail.com';                 // SMTP username
					$mail->Password = getMailPassword();                          // SMTP password
					$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
					$mail->Host = 'smtp.gmail.com'; 
					$mail->Port = 465;                                    // TCP port to connect to
					$mail->CharSet = 'UTF-8';
					//Recipients
					$mail->setFrom('no-reply@krevisscorp.com', 'no-reply@krevisscorp.com');
					$mail->addAddress($_POST['email'], 'Joe User');     // Add a recipient

					//Content
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = 'Demande de réinitilisation de mot de passe';
					ob_start(); ?>
					<p>Vous avez fait une demande de réinitilisation de mot de passe. <br/> Vous pouvez redéfinir votre mot de passe en cliquant sur <a href="http://localhost/projet4/index.php?action=reset_password&token=<?=$token?>">ce lien</a></p>
					<p>Ce lien expirera automatiquement dans 3 jours.</p>
					<p>Si vous n'êtes pas à l'origine de cette demande, veuillez ignorer ce mail.</p>
					<?php
					$mail->Body    = ob_get_clean();
					$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

					$mail->send();
					echo "<p>Si votre email existe dans notre base de données, vous allez recevoir un mail d'ici quelques instants.<br/>Si le mail n'apparaît pas dans votre boîte de réception, veuillez regardez dans vos courriers indésirables.</p>";
					echo '<br/><a href="index.php">Retourner à l\'accueil</a>';
				}
				catch (Exception $e)
				{
				    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
				}
			}
		}
		else
		{
			// throw new Exception("L'email n'existe pas");
			echo "<p>Si votre email existe dans notre base de données, vous allez recevoir un mail d'ici quelques instants.<br/>Si le mail n'apparaît pas dans votre boîte de réception, veuillez regardez dans vos courriers indésirables.</p>";
			echo '<br/><a href="index.php">Retourner à l\'accueil</a>';
		}
	}
	else
	{
		throw new Exception("Erreur. Le champ n'a pas été rempli.");
	}	
}

function getResetPasswordView()
{
	$token = $_GET['token'];
	$userManager = new UserManager();
	$tokenExists = $userManager->checkToken($token);

	if($tokenExists)
	{
		require('view/frontend/resetPasswordView.php');
	}
	else
	{
		throw new Exception("Erreur. Ce token n'existe pas.");
	}
}

function updatePassword()
{
	if (isset($_POST['email']) && !empty($_POST['email']))
	{
		$userManager = new UserManager();
		$emailMatchesWithToken = $userManager->checkIfEmailMatchesWithToken($_POST['email'], $_GET['token']);

		if($emailMatchesWithToken)
		{
			if(isset($_POST['newPassword1']) && isset($_POST['newPassword2']) && !empty($_POST['newPassword1']) && !empty($_POST['newPassword2']))
			{
				if($_POST['newPassword1'] == $_POST['newPassword2'])
				{
					$password = password_hash($_POST['newPassword1'], PASSWORD_DEFAULT);
					$user = $userManager->checkEmail($_POST['email']); // I'm using this method to return the user id I need afterwards. Might change in the future.
					$userId = $user['id'];
					$affectedLines = $userManager->updatePassword($userId, $password);

					if($affectedLines == false)
					{
						throw new Exception('Impossible d\'insérer les mots de passe en base de données.');
					}
					else
					{
						echo "Vous avez redéfini votre mot de passe avec succès.";
						echo '<br/><a href="index.php">Retourner à l\'accueil</a>';

						$tokenHasBeenDeleted = $userManager->deleteTokenFromDB($_GET['token']);
					}
				}
				else
				{
					throw new Exception("Erreur. Les mots de passe ne correspondent pas.");
				}
			}
			else
			{
				throw new Exception("Erreur. Vous n'avez pas rempli tous les champs.");
			}
		}
		else
		{
			throw new Exception('Email and token do not match.');
		}
	}
	else
	{
		throw new Exception("Erreur inconnue.");
	}
}