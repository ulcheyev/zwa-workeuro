</main>
	<footer>
		<a href="../index.php" class="logofooter">WORKEURO</a>
		<div class="linksdolu">
			<?php if((isset($_SESSION['username']) && $_SESSION['username'] == "admin")): ?>
			<ul class="footer_links">
				<li><p class="quicklinks">Quick Links</p></li>
				<li><a href="../jobsPublication/jobsPublication.php">Post a job</a></li>
				<li><a href="../index.php#findjob">Find a job</a></li>
				<li><a href="../blog/blog.php">Blog</a></li>
				<li><a href="../newsPublication/newsPublication.php">Post news</a></li>
			</ul>
			<ul class="footer_links2">
				<li><p class="quicklinks">Info</p></li>
				<li><a href="../info/about.php">About</a></li>
				<li><a href="../info/faq.php">FAQ</a></li>
			</ul>
			<?php elseif(isset($_SESSION['username'])):?>
			<ul class="footer_links"> 
				<li><p class="quicklinks">Quick Links</p></li>
				<li><a href="../jobsPublication/jobsPublication.php">Post a job</a></li>
				<li><a href="../index.php#findjob">Find a job</a></li>
				<li><a href="../blog/blog.php">Blog</a></li>
			</ul>
			<ul class="footer_links2">
				<li><p class="quicklinks">Info</p></li>
				<li><a href="../info/about.php">About</a></li>
				<li><a href="../info/faq.php">FAQ</a></li>
			</ul>
			<?php else:?>
			<ul class="footer_links"> 
				<li><p class="quicklinks">Quick Links</p></li>
				<li><a href="../index.php#findjob">Find a job</a></li>
				<li><a href="../blog/blog.php">Blog</a></li>
				<li><a href="../registration/login.php" >Sign Up/Log In</a></li>
			</ul>
			<ul class="footer_links2">
				<li><p class="quicklinks">Info</p></li>
				<li><a href="../info/about.php">About</a></li>
				<li><a href="../info/faq.php">FAQ</a></li>
			</ul>
			<?php endif;?>
		</div>
		<div class="copyright">
				<p>&copy;WORKEURO 2021-2022</p>
		</div>
	</footer>