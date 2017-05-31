<style>
  .panel-seo-box h3 {
    border-bottom: solid 2px #ddd;
    padding-bottom: 10px;
    width: 30%;
    margin: 1em 0;
  }
  .panel-seo-box h4 {
    margin: 1em 0 0.5em 0;
  }
  .panel-seo-box ul {
    list-style: none;
  }
</style>

<div class="panel-seo-box">
<!--
	<?php echo '<pre>';
	print_r($data);
	echo '</pre>'; ?>
-->

<?php if(empty($data)): ?>
  <div class="text">No pages</div>
<?php else: ?>
  <h3>Site</h3>
  <div class="dashboard-box">
    <ul class="dashboard-items">
    <?php foreach($data['site'] as $item_key => $site_item): ?>
        <?php $item_key  = str_replace('_', ' ', $item_key ); ?>
        <li class="dashboard-item">
          <?php if($site_item === true): ?>
            <figure>
              <span class="dashboard-item-icon dashboard-item-icon-with-border"><i class="icon icon-left fa fa-check"></i></span>
              <figcaption class="dashboard-item-text"><?= ucfirst($item_key); ?></figcaption>
            </figure>
          <?php else: ?>
            <figure>
              <span class="dashboard-item-icon dashboard-item-icon-with-border"><i class="icon icon-left fa fa-times"></i></span>
              <figcaption class="dashboard-item-text">No <?= $item_key; ?> <a href="<?= $site_item ?>" target="_blank">(solve this issue)</a></figcaption>
            </figure>
          <?php endif; ?>
        </li>
      <?php endforeach ?>
    </ul>
  </div>
  <h3>Pages</h3>
    <?php foreach($data['pages'] as $page_key => $page): ?>
      <h4><?= ucfirst($page_key) ?></h4>
      <div class="dashboard-box">
    <ul class="dashboard-items">
      <?php foreach($page as $page_item_key => $page_item): ?>
        <?php $page_item_key  = str_replace('_', ' ', $page_item_key ); ?>
        <li class="dashboard-item">
          <?php if($page_item == false): ?>
            <figure>
              <span class="dashboard-item-icon dashboard-item-icon-with-border"><i class="icon icon-left fa fa-times"></i></span>
              <figcaption class="dashboard-item-text">No <?= $page_item_key; ?></figcaption>
            </figure>
          <?php else: ?>
            <figure>
              <span class="dashboard-item-icon dashboard-item-icon-with-border"><i class="icon icon-left fa fa-check"></i></span>
              <figcaption class="dashboard-item-text"><?= $page_item.' '.$page_item_key; ?></figcaption>
            </figure>
          <?php endif; ?>
        </li>
        <?php endforeach ?>
        </ul>
      </div>
    <?php endforeach ?>
    
<?php endif ?>
</div>
