<?php
    // IMPORT nutnych souboru.
    include "../functions/dbconnect.php";
    include "../functions/scrf-token.php";
    include "../functions/registrationValidate.php";
    include "../components/header.php";
    
?>

<div class="container">
	<form class="regForm" action="registration.php" method="post">
		<div class="btnbox">
			<div class="knopki">
				<a href="login.php" class="loginlink">Log In</a>
				<a href="registration.php" class="actual">Sign Up</a>
			</div>
		</div>
		<div class="inputLogin">
            <input type="hidden" name="csrf_token" value="<?php if(isset($token)) echo htmlspecialchars($token);?>"/>
			<label for="username">Username:*</label>
            <?php
            ///Kontrola existence chyb pro zobrazeni
            if(isset($usernameError) && $usernameError != '') : 
            ?>
            <input class="fail" type="text" name="username" id="username" placeholder="username" value="<?php if(isset($_POST['username'])) {echo htmlspecialchars($_POST['username']);} ?>"/>
            <?php else :?>
            <input class="box" type="text" name="username" id="username" placeholder="username" value="<?php if(isset($_POST['username'])) {echo htmlspecialchars($_POST['username']);}  ?>"/>
            <?php endif;?>
            <small class="invis"><?php if(isset($usernameError)) {echo htmlspecialchars($usernameError);}?></small>
        </div>
        <div class="inputLogin">
			<label for="email">Email:*</label>
            <?php if(isset($emailError) && $emailError != '') : ?>
			<input class="fail" type="email" name="email" id="email" placeholder="email" value="<?php if(isset($_POST['email'])) {echo htmlspecialchars($_POST['email']);}?>"/>
            <?php else :?>
            <input class="box" type="email" name="email" id="email" placeholder="email" value="<?php if(isset($_POST['email'])) {echo htmlspecialchars($_POST['email']);}?>"/>
            <?php endif;?>
            <small class="invis"><?php if(isset($emailError)) {echo htmlspecialchars($emailError);}?></small>
        </div>
		<div class="inputLogin">
			<label for="password">Password:*</label>
            <?php if(isset($passwordError) && $passwordError != '') : ?>
            <input class="fail" type="password" name="password" id="password" placeholder="password"/>
            <?php else :?>
			<input class="box" type="password" name="password" id="password" placeholder="password"/>
            <?php endif;?>
            <small class="invis"><?php if(isset($passwordError)) {echo htmlspecialchars($passwordError);}?></small>
        </div>
        <div class="inputLogin">
			<label for="cpassword">Confirm password:*</label>
            <?php if(isset($passwordConfirmError) && $passwordConfirmError != '') : ?>
            <input class="fail" type="password" name="confirmpassword" id="cpassword" placeholder="confirmpassword"/>
            <?php else :?>
			<input class="box" type="password" name="confirmpassword" id="cpassword" placeholder="confirmpassword"/>
            <?php endif;?>
            <small class="invis"><?php if(isset($passwordConfirmError)) {echo htmlspecialchars($passwordConfirmError);}?></small>
            </div>
        <div class="inputBtn">
			<input class="boxSubmit" type="submit" name="register" value="Get started!" />
		</div>
	</form>
	<div class="side">
		<img src="bgImg.png" alt="Background Image">
	</div>
</div>
<?php include "../components/footer.php"?>
<script src="registrationValidate.js"></script>
</body>
</html>