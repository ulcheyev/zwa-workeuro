<?php
	// IMPORT nutnych souboru.
	include "../functions/dbconnect.php";
	include "../functions/getPostById.php";
	include "../functions/advertisementValidate.php";
	include "../functions/scrf-token.php";
	include "../components/header.php";
?>
<div class="lola">	
	<aside class="zajem">
		<form id="applynow77" class="applynow1" action="advertisement.php" method="post">
				<input type="hidden" name="csrf_token" value="<?php if(isset($token)) echo htmlspecialchars($token);?>"/>
				<div id="applynow2">Apply Now!</div>
				<label for="firstname" class="applylabel">First Name:* </label>
				<?php if(isset($firstnameError) && $firstnameError != '') : ?>
				<input id="firstname" name="firstname" class="failAd" type="text" placeholder="Ivan"  value="<?php if(isset($_POST['firstname'])) {echo htmlspecialchars($_POST['firstname']);}?>">
				<?php else :?>
				<input id="firstname" name="firstname" class="inputy" type="text" placeholder="Ivan"  value="<?php if(isset($_POST['firstname'])) {echo htmlspecialchars($_POST['firstname']);}?>">
				<?php endif;?>
				<small class ="ad" ><?php if(isset($firstnameError)) {echo htmlspecialchars($firstnameError);}?></small>

				<label for="lastname" class="applylabel">Last Name:* </label>
				<?php if(isset($lastnameError) && $lastnameError != '') : ?>
				<input id="lastname" name="lastname" class="failAd" type="text" placeholder="Ivanov" value="<?php if(isset($_POST['lastname'])) {echo htmlspecialchars($_POST['lastname']);}?>">
				<?php else :?>
				<input id="lastname" name="lastname" class="inputy" type="text" placeholder="Ivanov" value="<?php if(isset($_POST['lastname'])) {echo htmlspecialchars($_POST['lastname']);}?>">
				<?php endif;?>
				<small class ="ad" ><?php if(isset($lastnameError)) {echo htmlspecialchars($lastnameError);}?></small>
				
				<label for="number" class="applylabel">Phone number:* </label>
				<?php /// Kontrola existence chyb pro zobrazeni
				if(isset($phoneError) && $phoneError != '') : 
				?>
				<input id="number" name="phone" class="failAd" type="tel" placeholder="+420675634567" value="<?php if(isset($_POST['phone'])) {echo htmlspecialchars($_POST['phone']);}?>">
				<?php else :?>
				<input id="number" name="phone" class="inputy" type="tel" placeholder="+420675634567" value="<?php if(isset($_POST['phone'])) {echo htmlspecialchars($_POST['phone']);}?>">
				<?php endif;?>
				<small class ="ad" ><?php if(isset($phoneError)) {echo htmlspecialchars($phoneError);}?></small>
				<input class="submitapply" type="submit" value="Apply!" name="apply">
				<!-- hidden input for databaze -->
				<input name="positiondb" type="hidden" value="<?=$post['vacancy']?>"/>
				<input name="positionidindb" type="hidden" value="<?=$post['id']?>"/> 
		</form>
	</aside>
	<div class="inzerat_jobs">

		<div class="position"><?=htmlspecialchars($post['vacancy'])?></div>
		<div class="time"><?=htmlspecialchars(date('d/m/Y', strtotime($post['date'])))?></div>
		<div class="geo">
				<span class="geodot"><span class="dot"></span><span class="company"><?=htmlspecialchars($post['company'])?></span></span>
				<span class="geodot"><span class="dot"></span><span class="city"><?=htmlspecialchars($post['location'])?></span></span>
				<span class="geodot"><span class="dot"></span><span class="involvement"><?=htmlspecialchars($post['involvement'])?></span></span>
		
		</div>
		<div class="textinzerat"><?=htmlspecialchars($post['vcdes'])?>
		</div>
	</div>
</div>
<?php include "../components/footer.php"?>   
<script src="advertisementFunctions.js"></script>
</body>
</html>