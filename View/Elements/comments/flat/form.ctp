<?php
/**
 * Copyright 2009 - 2010, Cake Development Corporation
 *                        1785 E. Sahara Avenue, Suite 490-423
 *                        Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 */
?>
<?php
	$_url = array_merge($url, array('action' => str_replace(Configure::read('Routing.admin') . '_', '', $this->action)));
	foreach (array('page', 'order', 'sort', 'direction') as $named) {
		if (isset($this->passedArgs[$named])) {
			$_url[$named] = $this->passedArgs[$named];
		}
	}
	if ($target) {
		$_url['action'] = str_replace(Configure::read('Routing.admin') . '_', '', 'comments');
		$ajaxUrl = $this->CommentWidget->prepareUrl(array_merge($_url, array('comment' => $comment, '#' => 'comment' . $comment)));
		echo $this->Form->create(null, array('url' => $ajaxUrl, 'target' => $target));
	} else {
		echo $this->Form->create(null, array('url' => array_merge($_url, array('comment' => $comment, '#' => 'comment' . $comment))));
	}
	echo $this->Form->input('Comment.title');
	echo $this->Form->input('Comment.body', array(
		'type' => 'richtext',
	    'error' => array(
	        'body_required' => __d('comments', 'This field cannot be left blank'),
	        'body_markup' => sprintf(__d('comments', 'You can use only headings from %s to %s'), 4, 7))));
	// Bots will very likely fill this fields
	echo $this->Form->input('Other.title', array('type' => 'hidden'));
	echo $this->Form->input('Other.comment', array('type' => 'hidden'));
	echo $this->Form->input('Other.submit', array('type' => 'hidden'));

	if ($target) {
		echo $js->submit(__('Submit', true), array_merge(array('url' => $ajaxUrl), $this->CommentWidget->globalParams['ajaxOptions']));
	} else {
		echo $this->Form->submit(__('Submit', true));
	}
	echo $this->Form->end();
?>
