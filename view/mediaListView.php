<?php ob_start(); ?>

<div class="row">
    <div class="col-md-4 offset-md-8">
        <form method="get">
            <div class="form-group has-btn">
                <input type="search" id="search" name="title" value="<?= $search; ?>" class="form-control"
                       placeholder="Rechercher un film ou une série">

                <button type="submit" class="btn btn-block bg-red">Valider</button>
            </div>
        </form>
    </div>
</div>

<h2 class="h1-responsive font-weight-bold text-center my-4">CODFLIX : SERIES </h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">Vous pouvez voir les derniers séries proposés par notre site internet</p>

<div class="media-list">
    <?php foreach( $medias as $media ): ?>

        <a class="item" href="index.php?media=<?= $media['id']; ?>">
            <div class="video">
                <div>
                    <iframe allowfullscreen="" frameborder="0" src="<?= $media['trailer_url']; ?>" ></iframe>
                </div>
            </div>
            <div class="title"><?= $media['title'];?></div>
                
            <span class="text-muted"><?= $string = substr($media['summary'],0,60).'...';   ?></span><br/><br/>
         
            <span class="badge badge-secondary">Tag : </span> <span class="badge badge-secondary"><?= $media['type']; ?></span>
            
        </a>
    <?php endforeach; ?>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
