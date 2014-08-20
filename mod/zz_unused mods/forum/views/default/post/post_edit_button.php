<?php
	/**
	 * @file views/default/post/post_edit_button.php
	 * @brief Displays the edit button for posts
	 */

	// If the loggedin user can edit the entity then show the edit and delete button
	if ($vars['user']) {
		if ($vars['entity']->canEdit($vars['user']->guid)) { 
?>
			(<a href="<?php echo $vars['url']; ?>pg/post/edit/<?php echo $vars['entity']->guid; ?>"><?php echo elgg_echo('forum:edit'); ?></a>
			/
			<?php echo elgg_view('output/confirmlink',array('text'=>elgg_echo('forum:delete'),'href'=>$vars['url'].'action/forum/delete_entity?entity_guid='.$vars['entity']->guid)); ?>
			)
<?php
		}
	}
?>