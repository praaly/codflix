<?php ob_start(); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Start</th>
      <th scope="col">Titre</th>
      <th scope="col">Type</th>
      <th scope="col"></th>
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

      <!--  NOTE : POSSIBILITE DE CONTOURNER SECURITE A VOIR SI MODIF -->
      <td><center>      	
      	            
           <a href="?action=historiquePage&delete=<?= $history['id']; ?>"><i class="fa fa-trash-o" style="font-size:24px"></i></a>  
         </form>
      </center></td>
    </tr>
    <?php endforeach; ?> 
  </tbody>
</table>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
