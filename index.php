<?php
	// IMPORT nutnych souboru.
	require "functions/dbconnect.php";
	include "functions/getLatestBlogPost.php";
	include "functions/pagination.php";
	include "functions/scrf-token.php";
	include "functions/indexFilterFormValidate.php";
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>WORKEURO</title>
	<!-- FAVICON -->
	<link rel="stylesheet" href="style/style.css">
	<link rel="apple-touch-icon" sizes="180x180" href="style/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="style/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="style/favicon/favicon-16x16.png">
	<link rel="manifest" href="style/favicon/site.webmanifest">
	<link rel="mask-icon" href="style/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
</head>
<body>
	<header>
		<a href="index.php" class="logo">WORKEURO</a>
		<?php 
		/// Kontrola autorizace administratora
		if((isset($_SESSION['username']) && $_SESSION['username'] == "admin")): 
		?>
			<nav>
				<ul class="nav_links"> 
					<li><a href="jobsPublication/jobsPublication.php" >Post a job</a></li>
					<li><a href="#findjob" id="find_a_job">Find a job</a></li>
					<li><a href="blog/blog.php">Blog</a></li>
					<li><a href="newsPublication/newsPublication.php">Post news</a></li>
				</ul>
			</nav>
			<div class="dotUserNav">
				<span class="dotNav"></span>
				<a class='userlog' href='#'>Hi, <?php echo htmlspecialchars($_SESSION['username'])?>!</a>
			</div>
			<a class="nav_links_right" href="functions/exit.php">LogOut</a>
		<?php elseif(isset($_SESSION['username'])):?>
			<nav>
				<ul class="nav_links"> 
				<li><a href="jobsPublication/jobsPublication.php" >Post a job</a></li>
					<li><a href="#findjob" id="find_a_job">Find a job</a></li>
					<li><a href="blog/blog.php">Blog</a></li>
				</ul>
			</nav>
			<div class="dotUserNav">
				<span class="dotNav"></span>
				<a class='userlog' href='#'>Hi, <?php echo htmlspecialchars($_SESSION['username'])?>!</a>
			</div>
			<a class="nav_links_right" href="functions/exit.php">LogOut</a>
		<?php else:?>
			<nav>
				<ul class="nav_links">
					<li></li>
					<li><a href="#findjob" id="find_a_job">Find a job</a></li>
					<li><a href="blog/blog.php">Blog</a></li>
				</ul>
			</nav>
			<a class="hidden"></a>
			<a href="registration/login.php" class="nav_links_right">SignUp/LogIn</a>
		<?php endif;?>
	</header>
	<main>
		<div class="imgbanner"><img src="bannerImg.jpg" alt="bannerimg"></div>
		<!-- NOVINKY -->
		<aside class="blogAside">
			<?php
				$to = getMaxId($mysql); ///< Ziskani zpravy z nejvestsim id, ktera je pro zobrazeni Latest Blog Post.
			?>
			<div class="divpronovinky">
				<a href="news/news.php?post_id=<?=htmlspecialchars($to['id'])?>">
				<ul class="novinky">
					<li id="LatestBlogPosts">Latest Blog Post</li>
					<li class="zprava">
						<img class="obrazek" src="http://wa.toad.cz/~ulcheyev/newsPublication/<?=htmlspecialchars($to['image'])?>" alt="obrazek">
						<div class="nazev"><?=htmlspecialchars($to['title'])?></div>
					</li>
				</ul>
				</a>
			</div>
		</aside>
		<!-- NOVINKYCLOSE -->
		<!-- FILTRACE -->
		<form class="filterProJobs" method="get" action="index.php">
			<input type="hidden" name="csrf_token" value="<?php if(isset($token)) echo htmlspecialchars($token);?>"/>
			<div class="jobsFilter">
				<label for="vacancy">Vacancy: </label>
				<?php if(isset($errorVacancy) && $errorVacancy != '') : ?>
				<input class="failFilter" type="text" name="vacancy" id="vacancy" placeholder="vacancy" value="<?php if(isset($_GET['vacancy'])) {echo htmlspecialchars($_GET['vacancy']);}?>"/>
				<?php else :?>
				<input class="inputFilter" type="text" name="vacancy" id="vacancy" placeholder="vacancy" value="<?php if(isset($_GET['vacancy'])) {echo htmlspecialchars($_GET['vacancy']);}?>"/>
				<?php endif;?>
			</div>
			<div class="jobsFilter">
				<label for="company">Company: </label>
				<?php 
				/// Kontrola existence chyb pro zobrazeni
				if(isset($errorCompany) && $errorCompany != '') : 
				?>
				<input class="failFilter" type="text" name="company" id="company" placeholder="company" value="<?php if(isset($_GET['company'])) {echo htmlspecialchars($_GET['company']);}?>"/>
				<?php else :?>
				<input class="inputFilter" type="text" name="company" id="company" placeholder="company" value="<?php if(isset($_GET['company'])) {echo htmlspecialchars($_GET['company']);}?>"/>
				<?php endif;?>
			</div>
			<div class="jobsFilterSubmit">
				<input class="filterSubmit" type="submit" name="filterSub" id="filterSub" value="Search!"/>
			</div>
		</form>
		<!-- FILTRACECLOSE -->
		<!-- PRACE -->
		<?php
		/*!
		Iterace pole a zobrazeni prace
		*/
		if(isset($newsData) && $newsData != []){
		?>
		<ul class="jobs_tabule" id="findjob">
			<?php foreach($newsData as $oneNews){?>
				<?php if(isset($oneNews)){?>
			<li class="inzerat">
				<a href="advertisement/advertisement.php?post_id=<?php echo htmlspecialchars($oneNews['id'])?>">
					<div class = "post">
						<div class="dotcomp">
							<span class="dot"></span>
							<span class="position"><?=htmlspecialchars($oneNews['vacancy'])?></span>
						</div>
						<div class="company"><?=htmlspecialchars($oneNews['company'])?></div>
					</div>

					<div class = "meta">
						<div class="city"><?=htmlspecialchars($oneNews['location'])?></div>
						<div class="involvement"><?=htmlspecialchars($oneNews['involvement'])?></div>
						<div class="time"><?=htmlspecialchars(date('d/m/Y', strtotime($oneNews['date'])))?></div>
					</div>
				</a>		
			</li>
				<?php }?>
			<?php } ?>
		</ul>
		<?php }else{ ?>
		<div class="emptyJobs"><h1>Nothing found for this request :(<h1><div>
		<?php } ?>
		<!-- PRACECLOSE -->
		<!-- STRANKOVANI -->
		<div class="pagenavi">
			<div class="pagenavi_block">
				<!-- Vypocet poctu slozek pro zobrazeni -->
				<!-- Pokud je zadan filtr, je potreba to ukazat v url pro strankovani  -->
				<?php	if(isset($lastPage)){
					for($p=1; $p <= $lastPage; $p++){
						if(isset($company) || isset($vacancy)){ // Pokud je zadan nejaky parametr GET
							if($pageNum == $p){
				?>
					<a  class="active" href="?page=<?php echo htmlspecialchars($p)?>&amp;vacancy=<?php echo htmlspecialchars($vacancy)?>&amp;company=<?php echo htmlspecialchars($company)?>&amp;filterSub=Search%21"><?php echo htmlspecialchars($p)?></a>
				<?php }else{?>
					<a class="pagebtn" href="?page=<?php echo htmlspecialchars($p)?>&amp;vacancy=<?php echo htmlspecialchars($vacancy)?>&amp;company=<?php echo htmlspecialchars($company)?>&amp;filterSub=Search%21"><?php echo htmlspecialchars($p)?></a>
				<?php }?>
				<?php }else{ if($pageNum == $p){ ?>		
					<a class="active" href="?page=<?php echo htmlspecialchars($p)?>"><?php echo htmlspecialchars($p)?></a>
				<?php }else{ ?>
						<a class="pagebtn" href="?page=<?php echo htmlspecialchars($p)?>"><?php echo htmlspecialchars($p)?></a>
				<?php } } } }?>
			</div>
		</div>
		<!-- STRANKOVANICLOSE -->
		</main>
		<footer>
			<a href="index.php" class="logofooter">WORKEURO</a>
			<div class="linksdolu">
				<?php if((isset($_SESSION['username']) && $_SESSION['username'] == "admin")): ?>
					<ul class="footer_links">
					<li><p class="quicklinks">Quick Links</p></li>
					<li><a href="jobsPublication/jobsPublication.php">Post a job</a></li>
					<li><a href="index.php#findjob">Find a job</a></li>
					<li><a href="blog/blog.php">Blog</a></li>
					<li><a href="newsPublication/newsPublication.php">Post news</a></li>
				</ul>
				<ul class="footer_links2">
					<li><p class="quicklinks">Info</p></li>
					<li><a href="info/about.php">About</a></li>
					<li><a href="info/faq.php">FAQ</a></li>
				</ul>
				<?php elseif(isset($_SESSION['username'])):?>
					<ul class="footer_links">
					<li><p class="quicklinks">Quick Links</p></li>
					<li><a href="jobsPublication/jobsPublication.php">Post a job</a></li>
					<li><a href="index.php#findjob">Find a job</a></li>
					<li><a href="blog/blog.php">Blog</a></li>
				</ul>
				<ul class="footer_links2">
					<li><p class="quicklinks">Info</p></li>
					<li><a href="info/about.php">About</a></li>
					<li><a href="info/faq.php">FAQ</a></li>
				</ul>
				<?php else:?>
				<ul class="footer_links">
					<li><p class="quicklinks">Quick Links</p></li>
					<li><a href="index.php#findjob">Find a job</a></li>
					<li><a href="blog/blog.php">Blog</a></li>
					<li><a href="registration/login.php" >Sign Up/Log In</a></li>
				</ul>
				<ul class="footer_links2">
					<li><p class="quicklinks">Info</p></li>
					<li><a href="info/about.php">About</a></li>
					<li><a href="info/faq.php">FAQ</a></li>
				</ul>
			<?php endif;?>
			</div>
			<div class="copyright">
				<p>&copy;WORKEURO 2022</p>
			</div>
		</footer>
		<script src="app.js"></script>
	</body>
</html>	
