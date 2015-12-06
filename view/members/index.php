<div id="Members" class="page-header">
  <h1>Members<br><small>List of our members</small></h1>

</div>
<div class="container">
  <h2>Professors</h2>
  <div class="row" >

    <?php foreach ($professors as $key => $value): ?>


    <div class="col-sm-3 col-md-4">
      <div class="thumbnail">
        <a href="<?php echo Router::url("members/view/idMember:{$value->idMember}/slug:{$value->slug}"); ?>" class="thumbnail">
          <img src="<?php echo Router::webroot('img/'.$imgs['profil_img'.$value->idMember]->file) ?>" alt="Profile" style="width: auto; height: 230px; overflow: auto;">
        </a>
        <div class="caption">
          <a href="#"><h3>Pr. <?php echo $value->last_name.' '.$value->first_name ?></h3></a>
          <p><?php echo $value->email ?></p>
        </div>
      </div>
    </div>
  <?php endforeach ?>
</div>
<h2>PhD Students</h2>
<div class="row">
  <?php foreach ($students as $key => $value): ?>

  <div class="col-sm-3 col-md-4">
    <div class="thumbnail">
      <a href="<?php echo Router::url("members/view/idMember:{$value->idMember}/slug:{$value->slug}"); ?>" class="thumbnail">
        <img src="<?php echo Router::webroot('img/'.$imgs['profil_img'.$value->idMember]->file) ?>" alt="Profile" style="width: auto; height: 230px; overflow: auto;">>
      </a>
      <div class="caption">
        <a href="#"><h3><?php echo $value->last_name.' '.$value->first_name ?></h3></a>
        <p><?php echo $value->email ?></p>
      </div>
    </div>
  </div>
<?php endforeach ?>
</div>
</div>