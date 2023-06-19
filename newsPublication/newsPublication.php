<?php 
	
	// IMPORT nutnych souboru.
	include "../functions/dbconnect.php";
	include "../functions/scrf-token.php";
	include "../functions/newsValidate.php";
	include "../components/header.php";
?>
<div class="imgbanner"><img src="../bannerImg.jpg" alt="bannerimg"></div>
<h1 class="newsNapdis">Post news</h1>
<div class="containernews">
	<form class="formnews" action="newsPublication.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="csrf_token" value="<?php if(isset($token)) echo htmlspecialchars($token);?>"/>
		<div class="inputnews">
			<label for="title">Title:*</label>
			<?php if(isset($titleError) && $titleError != '') : ?>
			<input class="fail" type="text" name="title" id="title" placeholder="Workeuro" value="<?php if(isset($_POST['title'])) {echo htmlspecialchars($_POST['title']);}?>"/>
			<?php else :?>
			<input class="box" type="text" name="title" id="title" placeholder="Workeuro" value="<?php if(isset($_POST['title'])) {echo htmlspecialchars($_POST['title']);}?>"/>
			<?php endif;?>
			<small class="invis"><?php ///Kontrola existence chyb pro zobrazeni
			if(isset($titleError)) 
			{echo htmlspecialchars($titleError);}?></small>
		</div>
		<div class="inputnews">
			<label for="image">Image:*</label>
			<input class="imgbox" type="file" name="image" id="image"/>
			<small class="invis"><?php if(isset($imageError)) {echo htmlspecialchars($imageError);}?></small>
		</div>
		<div class="inputnews">
			<label for="newstext">News text:*</label>
			<?php if(isset($textError) && $textError != '') : ?>
			<textarea rows="1" class="failText" name="newstext" id="newstext" placeholder="News text"><?php if(isset($_POST['newstext'])) {echo htmlspecialchars($_POST['newstext']);}?></textarea>
			<?php else :?>
			<textarea rows="1" class="boxText" name="newstext" id="newstext" placeholder="News text"><?php if(isset($_POST['newstext'])) {echo htmlspecialchars($_POST['newstext']);}?></textarea>
			<?php endif;?>
			<small class="invis"><?php if(isset($textError)) {echo htmlspecialchars($textError);}?></small>
		</div>
		<div class="count">Total characters: <span id="num">Max. 4000</span></div>
		<div class="inputBtn">
			<input class="boxSubmitnews" type="submit" name="post" value="Post news" />
		</div>
	</form>
</div>
<?php include "../components/footer.php"?>  	
<script src="newsFunction.js"></script>
</body>
</html>