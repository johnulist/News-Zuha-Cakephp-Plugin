<?php
/*
 * SimplePie CakePHP Component
 * Copyright (c) 2007 Matt Curry
 * www.PseudoCoder.com
 *
 * Based on the work of Scott Sansoni (http://cakeforge.org/snippet/detail.php?type=snippet&id=53)
 *
 * @author      mattc <matt@pseudocoder.com>
 * @version     1.0
 * @license     MIT
 *
 */

//App::import('Vendor', 'simplepie', array('file' => 'simplepie/simplepie.php')); 
class SimplepieComponent extends Object {
  var $cache;

  function __construct() {
    $this->cache = CACHE . 'rss' . DS;
  }

  function feed($feed_url) {
    //make the cache dir if it doesn't exist
    //pr($this->cache);
  	if (!file_exists($this->cache)) {
      $folder = new Folder();
      //$folder->mkdirr($this->cache);
      //$folder->mkdir($this->cache);
      $folder->create($this->cache); 
    }

    //include the vendor class
    //vendor('simplepie/simplepie');
    App::import('Vendor', 'simplepie/simplepie');

    //setup SimplePie
    $feed = new SimplePie();
    $feed->set_feed_url($feed_url);
    $feed->set_cache_location($this->cache);

    //retrieve the feed
    $feed->init();

    //get the feed items
    $items = $feed->get_items();
	
    //return
    if ($items) {
      return $items;
    } else {
      return false;
    }
  }
}
?> 