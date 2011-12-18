<?php 
	if(!empty($instance) && defined('__ELEMENT_NEWS_FEEDS_'.$instance)) {
		extract(unserialize(constant('__ELEMENT_NEWS_FEEDS_'.$instance)));
	} else if (defined('__ELEMENT_NEWS_FEEDS')) {
		extract(unserialize(__ELEMENT_NEWS_FEEDS));
	}
	# set up defaults
	$userId = $this->Session->read('Auth.User.id');
	$divId = !empty($divId) ? $divId : 'loginElement';
	$divClass = !empty($divClass) ? $divClass : 'loginElement';
	$textWelcome = !empty($textWelcome) ? $textWelcome : 'Welcome : ';
 	$feeds = !empty($feedUrls) ? $this->requestAction('/news/news/feeds/'.str_replace('.', '^', str_replace('/', '*', implode(',', $feedUrls)))) : null;
	if (!empty($feeds)) :
																				  
?>

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
<?php else: ?>
	<div class="message">No activity to show.</div>
<?php endif; ?>
</div>