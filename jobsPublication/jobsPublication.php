<?php
    // IMPORT nutnych souboru.
	include "../functions/dbconnect.php";
	include "../functions/scrf-token.php";
	include "../functions/postAJobValidate.php";
	include "../components/header.php";
?>
<div class="imgbanner"><img src="../bannerImg.jpg" alt="bannerimg"></div>
<h1 class="jobsNapdis">Post a job</h1>
<div class="containerJobs">
	<form class="formjobs" action="jobsPublication.php" method="post">
	<input type="hidden" name="csrf_token" value="<?php if(isset($token)) echo htmlspecialchars($token);?>"/>
		<div class="inputJobs">
			<label for="vacancy">Vacancy:*</label>
			<?php if(isset($vacancyError) && $vacancyError != '') : ?>
			<input class="fail" type="text" name="vacancy" id="vacancy" placeholder="Software Developer" value="<?php if(isset($_POST['vacancy'])) {echo htmlspecialchars($_POST['vacancy']);}?>"/>
			<?php else :?>
			<input class="box" type="text" name="vacancy" id="vacancy" placeholder="Software Developer" value="<?php if(isset($_POST['vacancy'])) {echo htmlspecialchars($_POST['vacancy']);}?>"/>
			<?php endif;?>
			<small class="invis"><?php if(isset($vacancyError)) {echo htmlspecialchars($vacancyError);}?></small>
		</div>
		<div class="inputJobs">
			<label for="company">Company:*</label>
			<?php if(isset($companyError) && $companyError != '') : ?>
			<input class="fail" type="text" name="company" id="company" placeholder="Microsoft" value="<?php if(isset($_POST['company'])) {echo htmlspecialchars($_POST['company']);}?>"/>
			<?php else :?>
			<input class="box" type="text" name="company" id="company" placeholder="Microsoft" value="<?php if(isset($_POST['company'])) {echo htmlspecialchars($_POST['company']);}?>"/>
			<?php endif;?>
			<small class="invis"><?php if(isset($companyError)) {echo htmlspecialchars($companyError);}?></small>
		</div>
		<div class="inputJobs">
			<label for="location">Location:*</label>
			<?php if(isset($locationError) && $locationError != '') : ?>
			<input class="fail" type="text" name="location" id="location" placeholder="Praha" value="<?php if(isset($_POST['location'])) {echo htmlspecialchars($_POST['location']);}?>"/>
			<?php else :?>
			<input class="box" type="text" name="location" id="location" placeholder="Praha" value="<?php if(isset($_POST['location'])) {echo htmlspecialchars($_POST['location']);}?>"/>
			<?php endif;?>
			<small class="invis"><?php if(isset($locationError)) {echo htmlspecialchars($locationError);}?></small>
		</div>
		<div class="inputJobs">
			<label for="involvement" >Involvement:*</label>
			<?php if(isset($involvementError) && $involvementError != '') : ?>
			<input class="fail" type="text" name="involvement" id="involvement" placeholder="Full Time" value="<?php if(isset($_POST['involvement'])) {echo htmlspecialchars($_POST['involvement']);}?>"/>
			<?php else :?>
			<input class="box" type="text" name="involvement" id="involvement" placeholder="Full Time" value="<?php if(isset($_POST['involvement'])) {echo htmlspecialchars($_POST['involvement']);}?>"/>
			<?php endif;?>
			<small class="invis"><?php /// Kontrola chyb pro zobrazeni
			if(isset($involvementError)) {echo htmlspecialchars($involvementError);}
			?></small>
		</div>
		<div class="inputJobs">
			<label for="vcdes">Vacancy description:*</label>
			<?php if(isset($vcdesError) && $vcdesError != '') : ?>
			<textarea rows="1" class="failText" name="vcdes" id="vcdes" placeholder="Vacancy description"><?php if(isset($_POST['vcdes'])) {echo htmlspecialchars($_POST['vcdes']);}?></textarea>
			<?php else :?>
			<textarea rows="1" class="boxText" name="vcdes" id="vcdes" placeholder="Vacancy description"><?php if(isset($_POST['vcdes'])) {echo htmlspecialchars($_POST['vcdes']);}?></textarea>
			<?php endif;?>
			<small class="invis"><?php if(isset($vcdesError)) {echo htmlspecialchars($vcdesError);}?></small>
		</div>
		<div class="count">Total characters: <span id="num">Max. 4000</span></div>
		<div class="inputBtn">
			<input class="boxSubmitJobs" type="submit" name="post" value="Post a job" />
		</div>
	</form>
</div>
<?php include "../components/footer.php"?>  
<script src="postAJobFunctions.js"></script>
</body>
</html>