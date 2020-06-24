<?php
function afficher(){
echo "bonjour!";
}
?>

<?php ob_start(); ?>

<table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Start</th>
      <th scope="col">Titre</th>
      <th scope="col">Type</th>
      <th scope="col">X</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($historiqueContent as $history ): ?>
  	<?php $getMedia = Historique::transformID($history['media_id']); ?>

    <tr>
      <td><?= $history['id']; ?></td>
      <td><?= $history['start_date']; ?></td>
      <td><?= strtoupper($getMedia['title']); ?></td>      
      <td><?= strtoupper($getMedia['type']); ?></td>

      <td><button onclick="afficher();">DELETE</button></td>

    </tr>
    <?php endforeach; ?> 
  </tbody>
</table>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
