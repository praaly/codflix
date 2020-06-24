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
<img class="card-img-top" src="public/img/home-bg.jpg" height="350px">
<div class="centered"><?= $mediaContent['title']; ?></div>
<div class="card-body">
   <h5 class="card-title"><?= $mediaContent['title']; ?></h5>
   <p class="card-text"><?= $mediaContent['summary']; ?></p>
   <p class="card-text"><small class="text-muted">Last updated <?= $mediaContent['release_date']; ?></small></p>
   <h5 class="card-title">
      <?php  if ($mediaContent['type'] == 'serie') {?> Episode 1
      <?php } if ($mediaContent['type'] == 'film') { ?> Lire le film<?php } ?>    
   </h5>
   <iframe width="100%" height="550px" src="<?= $mediaContent['trailer_url']; ?>"></iframe>
   <div class="video">
   	<hr>
      <?php  if ($mediaContent['type'] == 'serie') { ?>
      <h5 class="card-title">
         <?= $mediaContent['title']; ?>

         <form method="POST">
            <select name="season" onchange="this.form.submit()">
               <option value="">CHOISI UNE SAISON</option>
               <?php foreach($mediaSeasonContent as $season ):?>
               <option value="<?= $season['id']?>"><?= $season['name']?></option>
               <?php endforeach; ?>
            </select>
         </form>
      </h5>
      <div>
         <div class="card-group">
            <?php foreach($mediaEpisodeContent as $episode ):?>
            <div class="card">
               <iframe allowfullscreen="" frameborder="0" src="<?= $episode['url']; ?>" ></iframe>
               <div class="card-body">
                  <h5 class="card-title"><?= $episode['name'];?></h5>
                  <p class="card-text"><?= $episode['summary']; ?></p>
                  <p class="card-text"><small class="text-muted"><?= $episode['release_date']; ?></small></p>
                  <p class="card-text"><small class="text-muted"><?= $episode['duration']; ?></small></p>
               </div>
            </div>
            <?php endforeach; ?>       
         </div>
         <?php } ?>
      </div>
   </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('dashboard.php'); ?>