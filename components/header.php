<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>WORKEURO</title>
<link rel="stylesheet" href="../style/style.css">
<!-- FAVICON -->
<link rel="apple-touch-icon" sizes="180x180" href="../style/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../style/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../style/favicon/favicon-16x16.png">
<link rel="manifest" href="../style/favicon/site.webmanifest">
<link rel="mask-icon" href="../style/favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
</head>
<body>
<header>
	<a href="../index.php" class="logo">WORKEURO</a>
	<?php 
	/// Kontrola autorizace administratora
	if((isset($_SESSION['username']) && $_SESSION['username'] == "admin")): 
	?>
		<nav>
			<ul class="nav_links"> 
				<li><a href="../jobsPublication/jobsPublication.php" >Post a job</a></li>
				<li><a href="../index.php#findjob" id="find_a_job">Find a job</a></li>
				<li><a href="../blog/blog.php">Blog</a></li>
				<li><a href="../newsPublication/newsPublication.php">Post news</a></li>
			</ul>
		</nav>
		<div class="dotUserNav">
			<span class="dotNav"></span>
			<a class='userlog' href='#'>Hi, <?php echo htmlspecialchars($_SESSION['username'])?>!</a>
		</div>
		<a class="nav_links_right" href="../functions/exit.php">LogOut</a>
	<?php elseif(isset($_SESSION['username'])):?>
		<nav>
			<ul class="nav_links"> 
			<li><a href="../jobsPublication/jobsPublication.php" >Post a job</a></li>
				<li><a href="../index.php#findjob" id="find_a_job">Find a job</a></li>
				<li><a href="../blog/blog.php">Blog</a></li>
			</ul>
		</nav>
		<div class="dotUserNav">
			<span class="dotNav"></span>
			<a class='userlog' href='#'>Hi, <?php echo htmlspecialchars($_SESSION['username'])?>!</a>
		</div>
		<a class="nav_links_right" href="../functions/exit.php">LogOut</a>
	<?php else:?>
		<nav>
			<ul class="nav_links">
				<li></li>
				<li><a href="../index.php#findjob" id="find_a_job">Find a job</a></li>
				<li><a href="../blog/blog.php">Blog</a></li>
			</ul>
		</nav>
		<a class="hidden"></a>
		<a href="../registration/login.php" class="nav_links_right">SignUp/LogIn</a>
	<?php endif;?>
</header>
<main>