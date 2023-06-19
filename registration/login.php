<?php
	// IMPORT nutnych souboru.
	include "../functions/dbconnect.php";
	include "../functions/scrf-token.php";
	include "../functions/loginValidate.php";
	include "../components/header.php";

?>
<div class="container">
	<form class="loginForm" action="login.php" method="post">
		<div class="btnbox">
			<div class="knopki">
				<a href="login.php" class="actual">Log In</a>
				<a href="registration.php" class="loginlink">Sign Up</a>
			</div>
		</div>
			<?php // Pokud se uzivatel zaregistroval a dostal se na stranku login
				// Zobrazi se text, ze registrace je uspesna
			if(isset($_SESSION['success']) && $_SESSION['success'] != "" ):?>
			<div class="successRegister">
				<p>Successful registration! Now you can log in!<p>
			</div>
			<?php else:?>
			<div class="hiddenRegister">
			</div>	
			<?php endif;?>
		<div class="inputLogin">
			<input type="hidden" name="csrf_token" value="<?php if(isset($token)) echo htmlspecialchars($token);?>"/>
			<label for="username">Username:*</label>
			<?php 
			/// Kontrola existence chyb pro zobrazeni
			if(isset($usernameError) && $usernameError != '') : 
			?>
			<input class="fail" type="text" name="usernamelog" id="username" placeholder="username" value="<?php if(isset($_POST['usernamelog'])) {echo htmlspecialchars($_POST['usernamelog']);}?>">
			<?php else :?>
			<input class="box" type="text" name="usernamelog" id="username" placeholder="username" value="<?php if(isset($_POST['usernamelog'])) {echo htmlspecialchars($_POST['usernamelog']);}?>">
			<?php endif;?>
			<small class="invis"><?php if(isset($usernameError)) {echo htmlspecialchars($usernameError);}?></small>
		</div>
		<div class="inputLogin">
			<label for="password">Password:*</label>
			<?php if(isset($usernameError) && $usernameError != '') : ?>
			<input class="fail" type="password" name="password" id="password" placeholder="password"/>
			<?php else :?>
			<input class="box" type="password" name="password" id="password" placeholder="password"/>
			<?php endif;?>
			<small class="invis"><?php if(isset($passwordError)) {echo htmlspecialchars($passwordError);}?></small>
		</div>
		<div class="inputBtn">
			<input class="boxSubmit" type="submit" name="login" value="Initialize!" />
		</div>
	</form>
	<div class="side">
		<img src="bgImg2.jpg" alt="Background Image" width=758 height=630>
	</div>
</div>
<?php include "../components/footer.php"?>
<script src="loginValidate.js"></script>
</body>
</html>