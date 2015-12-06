<div class="page-header">
  <h1>Partners<br><small>List of our partners</small></h1>

</div>
<div class="container">
  <div class="row" >

    <?php foreach ($partners as $key => $value): ?>

    <div class="col-sm-3 col-md-4">
      <div class="thumbnail">
        <a href="<?php echo isset($value->website)? $value->website : '#'; ?>" class="thumbnail">
          <img src="<?php echo Router::webroot('img/'.$imgs['logo_img'.$value->idMember]->file) ?>" alt="Logo" style="width: auto; height: 230px; overflow: auto;">
        </a>
        <div class="caption">
          <h3>Pr. <?php echo $value->name ?></h3>
        </div>
      </div>
    </div>
  <?php endforeach ?>
</div>
</div>