<?php 

	// IMPORT nutnych souboru.
	include "../functions/dbconnect.php";
	include "../components/header.php";
	include "../functions/getNewsById.php";

	/// Ziskani id prispevku.
	$post_id = $_GET['post_id'];
	/// Ziskani data prispevku podle id.
	$post = get_news_by_id($post_id, $mysql);

?>
<h1 class="blogNapdis">Blog</h1>
<div class="novost">
	<div class="namenovosti"><?=htmlspecialchars($post['title'])?></div>
	<div class="textnovosti"><?=htmlspecialchars($post['text'])?>
	<div class="dateNews"><?=htmlspecialchars(date('d/m/Y', strtotime($post['date'])))?></div>
	</div>
</div>	
<?php include "../components/footer.php"?>
<script src="#"></script>
</body>
</html>