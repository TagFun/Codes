<?php
	require("config.php");
	session_start();
	$action = isset($_GET['action']) ? $_GET['action'] : "";
	$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";

	if($action != "login" && $action != "logout" && !$username)
	{
		login();
		exit;
	}

	switch($action)
	{
		case 'login':
			login();
			break;
		case 'logout':
			logout();
			break;
		case 'newArticle':
			newArticle();
			break;
		case 'editArticle':
			editArticle();
			break;
		case 'deleteArticle':
			//deleteArticle();
			break;
		default:
			listArticles();
	}

	function login()
	{
		$results = array();
		$results['pageTitle'] = "Admin Login | TagFun";

		if(isset($_POST['login']))
		{
			// User has posted login form: attempt to log the user in
			if($_POST['username'] == ADMIN_USERNAME && $_POST['password'] == ADMIN_PASSWORD)
			{
				// Login successful: Create a session and redirect to the admin homepage
				$_SESSION['username'] = ADMIN_USERNAME;
				header("Location: admin.php");
			}

			else
			{
				// Login failed: Display an error message to the user
				$results['errorMessage'] = "Incorrect username or password. Please try again";
				require(TEMPLATE_PATH . "/admin/loginForm.php");
			}
		}
	
		else
		{
			// User has not posted the login form yet: Display the form
			require(TEMPLATE_PATH . "/admin/loginForm.php");
		}
	}


	function logout()
	{
		unset($_SESSION['username']);
		header("Location: admin.php");
	}

	function newArticle()
	{
		$results = array();
		$results['pageTitle'] = "Uusi Artikkeli";
		$results['formAction'] = "newArticle";
		
		if(isset($_POST['saveChanges'] ))
		{
			// User has posted the article edit form: Save the new article
			$article = new Article;
			$article->storeFormValues($_POST);
			$article->insert();
			header("Location: admin.php?status=changesSaved");
		}

		elseif(isset($_POST['cancel']))
		{
			//User has cancelled theri edits: Return to the article list
			header("Location: admin.php");
		}

		else
		{
			// User has not posted the article edit form yet: Display the form
			$results['article'] = new Article;
			require(TEMPLATE_PATH . "/admin/editArticle.php");
		}
	}

	function editArticle()
	{
		$results = array();
		$results['pageTitle'] = "Muokkaa artikkelia";
		$results['formAction'] = "editArticle";
		
		if(isset($_POST['saveChanges']))
		{
			// User has posted the article edit form: save the article changes
			if(!$article = Article::getById((int)$_POST['articleId']))
			{
				header("Location: admin.php?error=articleNotFound");
				return;
			}

			$article->storeFormValues($_POST);
			$article->update();
			header("Location: admin.php?status=changesSaved");
		}
		
		elseif(isset($_POST['cancel']))
		{
			// User has cancelled their edits: Return to the article list
			header("Locaton: admin.php");
		}

		else
		{
			// User has not posted the article edit form yet: Display the form
			$results['article'] = Article::getById((int)$_GET['articleId']);
			require(TEMPLATE_PATH. "/admin/editArticle.php");
		}
	}

	function deleteArticle()
	{
		if(!$article = Article::getById((int)$_GET['articleId'] ))
		{
			header("Location: admin.php?error=articleNotFound");
			return;
		}

		$article->delete();
		header("Location: admin.php?status=articleDeleted");
	}

	function listArticles()
	{
		$results = array();
		$data = Article::getList();
		$results['articles'] = $data['results'];
		$results['totalRows'] = $data['totalRows'];
		$results['pageTitles'] = "Kaikki artikkelit";

		if(isset($_GET['error'] ))
		{
			if($_GET['error'] == "articleNotFound" ) $results['errorMessage'] = "Error: Artikkelia ei l�ydy";
		}

		if(isset($_GET['status']))
		{
			if($_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Muutokset tallennettu";
			if($_GET['status'] == "articleDeleted") $results['statusMessage'] = "Artikkeli poistettu";
		}

		require(TEMPLATE_PATH . "/admin/listArticles.php");
	}

?>
			
			