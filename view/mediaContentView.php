<?php
   if(isset($_POST["season"])){
       $search_1 = $_POST['season'];
       echo "id saison => ".$search_1;
   }
?>

<?php ob_start();?>
<style>
.centered {
   font-family: 'Arial', sans-serif;
  -webkit-font-smoothing: antialiased;
  position: absolute;
  color : white;
  font-size : 150px;
  top: 10%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>

<div class="card mb-3">
  <img class="card-img-top" src="public/img/home-bg.jpg" height="500px">
  <div class="centered"><?= $mediaContent['title']; ?></div>

  <div class="card-body">
    <h5 class="card-title"><?= $mediaContent['title']; ?></h5>  
    <p class="card-text"><?= $mediaContent['summary']; ?></p>
    <p class="card-text"><small class="text-muted">Last updated <?= $mediaContent['release_date']; ?></small></p>
    
     <h5 class="card-title">
    <?php  if ($mediaContent['type'] == 'serie') {?> Episode 1
    <?php } if ($mediaContent['type'] == 'film') { ?> Lire le film<?php } ?>    
    </h5> 

    <iframe width="100%" height="1050px" src="<?= $mediaContent['trailer_url']; ?>"></iframe>
    
    <div class="video">
    <?php  if ($mediaContent['type'] == 'serie') { ?>
    <h5 class="card-title"><?= $mediaContent['title']; ?>

    <form method="POST">
	    <select name="season" onchange="this.form.submit()">
	    	<option value="">CHOISI LA SAISON</option>
			<?php foreach($mediaSeasonContent as $season ):?>
			<option value="<?= $season['id']?>"><?= $season['name']?></option>
			<?php endforeach; ?>
	 	</select>
	 </form>

    </h5>
    <div>
    <?php foreach($mediaEpisodeContent as $episode ):?>
        <div class="video">
            <div>
                <iframe allowfullscreen="" frameborder="0" src="<?= $episode['url']; ?>" ></iframe>
            </div>
        </div>
        <div class="title"><?= $episode['name'];?></div>
            
        <span class="text-muted"><?= $string = substr($episode['summary'],0,60).'...';   ?></span><br/><br/>
    
        <span class="badge badge-secondary">Release : </span> <span class="badge badge-secondary"><?= $episode['release_date']; ?></span>
	<?php endforeach; ?>       
    </div>
    <?php } ?>
  </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
