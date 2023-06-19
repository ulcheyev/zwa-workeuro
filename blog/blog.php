<?php 
    // IMPORT nutnych souboru.
	include "../functions/dbconnect.php";
	include "../functions/getBlogData.php";
	include "../components/header.php";
	include "../functions/paginationBlog.php"
?>
<h1 class="blogNapdis">Blog</h1>
<!-- NOVINKY -->
<ul class="newsBlog">
    <?php 
    ///Iterace ziskaneho pole a zobrazeni jednotlivych polozek.
    foreach($newsData as $post):?>
    <li class="postBlog">
        <a href="../news/news.php?post_id=<?=htmlspecialchars($post['id'])?>">
        <img class="imgBlog" src="http://wa.toad.cz/~ulcheyev/newsPublication/<?=htmlspecialchars($post['image'])?>" alt="Picture" >
        <div class="nameBlog"><?=htmlspecialchars($post['title'])?></div>
        </a>
    </li>
    <?php endforeach; ?>
</ul>
<!-- NOVINKYCLOSE -->
<div class="pagenavi">
			<div class="pagenavi_block">
				<?php if(isset($lastPage)){
					  for($p=1; $p <= $lastPage; $p++){
							if($pageNum == $p){
				?>
                <a class="active" href="?page=<?php echo htmlspecialchars($p)?>"><?php echo htmlspecialchars($p)?></a>
				<?php }else{?>
                <a class="pagebtn" href="?page=<?php echo htmlspecialchars($p)?>"><?php echo htmlspecialchars($p)?></a>
				<?php }?>	
				<?php  } }?>
			</div>
		</div>
<?php include "../components/footer.php"?>
<script src="#"></script>
</body>
</html>