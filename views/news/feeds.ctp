<div class="feeds index">
<?php
function cmp($a, $b) {
    return strcmp(strtotime($b["datetime"]), strtotime($a["datetime"]));
}
usort($feeds, "cmp");

foreach($feeds as $feed) { ?>
  <div class="feedItem">
	<div class="metaData">
    	<ul>
	        <li><span class="metaLabel"><?php echo 'From :'; ?></span><span class="metaValue"><?php echo $feed['name']; ?></span></li>
           	<li><span class="metaLabel"><?php echo 'Time :'; ?></span><span class="metaValue"><?php echo $feed['datetime']; ?></span></li>
        </ul>
    </div>
    <div class="feedBody">
    	<div class="feedItemTitle"><?php echo $this->Html->link($feed['title'], $feed['permalink']); ?></div>
        <div class="feedItemContent"><?php echo $feed['description']; ?></div>
    </div>
  </div>
<?php
}
?>
</div>