<?php
class NewsController extends NewsAppController {

	public $name = 'News';
	public $uses = 'News.News';
	public $helpers = array('Text');
	// var $components = array('Simplepie');
	
	
	/**
	 * OKAY I'M GIVING UP FOR TODAY.  THE PROBLEM IS THAT WE HAVE LOST THE SESSION WHEN SIMPLEPIE MAKES THAT REQUEST
	 
	 
	 
	function feeds($urls = null) {
		if (!empty($urls)) :
			$urls = str_replace('^', '.', str_replace('*', '/', (explode(',', $urls))));
		endif;
		 // We need to load the a rss parsing class
		App::import('Component', 'News.Simplepie');
		$Simplepie = new SimplepieComponent();
		
		// this will be deprecated and removed
		$urls = $this->News->find('all', array(
			'conditions' => array('News.user_id' => $this->Auth->user("id"))
			)); 
		
		$feeds = array();
		foreach($urls as $url) :
		
			debug($this->requestAction($url['News']['url']));
			debug($url['News']['url']);
			#foreach($Simplepie->feed('http://razorit.localhost/projects/projects/messages/79.rss') as $feed) :
			foreach($Simplepie->feed($url['News']['url']) as $feed) :
				$data =  array(
					'title' => $feed->get_title(),
					'permalink' =>	$feed->get_permalink(),
					'datetime' => $feed->get_date(),
					'description' => $feed->get_description(),
					'name' => $url['News']['name']);
				array_push($feeds, $data);
			endforeach;
		endforeach;
		$this->set('feeds', $feeds);
	}*/
	
	
	/* original version of this function*/
	function feeds() {
		App::import('Component', 'News.Simplepie');
		 // We need to load the class
		$Simplepie = new SimplepieComponent();
		$urls = $this->News->find('all', array(
						'conditions' =>array('News.user_id' => $this->Auth->user("id"))
						)); 
		$feeds = array();
		foreach($urls as $url) {
			#debug($url['News']['url']);
			# not working
 			$data = $this->requestAction('/projects/projects/messages/79');
			debug($data);
			
			#debug(file_get_contents('http://razorit.localhost/projects/projects/messages/79.rss'));
			#foreach($Simplepie->feed('http://razorit.localhost/projects/projects/messages/79.rss') as $feed) {
			# ORIGINAL
			foreach($Simplepie->feed($url['News']['url']) as $feed) {
				$data =  array('title' => $feed->get_title(),
								'permalink' =>	$feed->get_permalink(),
								'datetime' => $feed->get_date(),
							'description' => $feed->get_description(),
							'name' => $url['News']['name']);
				array_push($feeds, $data);
			}
		}
		$this->set('feeds', $feeds);
	}
	

	function index() {
		$this->News->recursive = 0;
		$this->set('news', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid news', true), array('action' => 'index'));
		}
		$this->set('news', $this->News->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->News->create();
			if ($this->News->save($this->request->data)) {
				$this->flash(__('News saved.', true), array('action' => 'index'));
			} else {
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->flash(sprintf(__('Invalid news', true)), array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->News->save($this->request->data)) {
				$this->flash(__('The news has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->News->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid news', true)), array('action' => 'index'));
		}
		if ($this->News->delete($id)) {
			$this->flash(__('News deleted', true), array('action' => 'index'));
		}
		$this->flash(__('News was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->News->recursive = 0;
		$this->set('news', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid news', true), array('action' => 'index'));
		}
		$this->set('news', $this->News->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->request->data)) {
			$this->News->create();
			if ($this->News->save($this->request->data)) {
				$this->flash(__('News saved.', true), array('action' => 'index'));
			} else {
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->flash(sprintf(__('Invalid news', true)), array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->News->save($this->request->data)) {
				$this->flash(__('The news has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->News->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid news', true)), array('action' => 'index'));
		}
		if ($this->News->delete($id)) {
			$this->flash(__('News deleted', true), array('action' => 'index'));
		}
		$this->flash(__('News was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
?>