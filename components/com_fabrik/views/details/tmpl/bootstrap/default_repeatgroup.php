<?php
/**
 * Bootstrap Details Template: Repeat group rendered as standard form
 *
 * @package     Joomla
 * @subpackage  Fabrik
 * @copyright   Copyright (C) 2005-2013 fabrikar.com - All rights reserved.
 * @license     GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * @since       3.0
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

$group = $this->group;
foreach ($group->subgroups as $subgroup) :
	?>
	<div class="fabrikSubGroup">
	<?php
		// Add the add/remove repeat group buttons
		if ($group->editable) : ?>
			<div class="fabrikGroupRepeater pull-right">
				<?php if ($group->canAddRepeat) :?>
				<a class="addGroup" href="#">
					<?php echo FabrikHelperHTML::image('plus.png', 'form', $this->tmpl, array('class' => 'fabrikTip tip-small', 'opts' => '{trigger: "hover"}', 'title' => FText::_('COM_FABRIK_ADD_GROUP')));?>
				</a>
				<?php
				endif;
				if ($group->canDeleteRepeat) :?>
				<a class="deleteGroup" href="#">
					<?php echo FabrikHelperHTML::image('minus.png', 'form', $this->tmpl, array('class' => 'fabrikTip tip-small', 'opts' => '{trigger: "hover"}', 'title' => FText::_('COM_FABRIK_DELETE_GROUP')));?>
				</a>
				<?php endif;?>
			</div>
		<?php
		endif;
		?>
		<div class="fabrikSubGroupElements">
			<?php

			// Load each group in a <ul>
			$this->elements = $subgroup;
			echo $this->loadTemplate('group');
			?>
		</div><!-- end fabrikSubGroupElements -->
		<?php
		foreach ($this->groups as $child):
	if ($child->is_child):
		if ((!$child->is_join && $child->parentgroup == $this->group->id) || ($child->is_join && $child->join_from_table == $this->group->table_join)):
		
		//		&& (($this->group->canRepeat && !$child->canRepeat) || (!$this->group->canRepeat && $child->canRepeat) || (!$this->group->canRepeat && !$child->canRepeat))):
			
			$this->child = $child;
		?>
			<div class="fabrikChildGroup" id="group<?php echo $group->id;?>" style="<?php echo $group->css;?>">
			<?php
			if ($child->showLegend) :?>
				<h4><?php echo $child->title;?></h4>
			<?php
			endif;
			/*
			if ($child->is_join && $child->join_from_table == $this->group->table_join)
			{
		?>
			<div><?php echo '<pre>';
			var_dump($child->is_child, $child->list_table, $child->is_join, $child->join_id, $child->join_from_table, $child->table_join, $child->table_key, $child->table_join_key, $child->pk, $child->fk);
			echo '</pre>';?></div>
		<?php
			}
			*/

			/* Load the group template - this can be :
			*  * default_group.php - standard group non-repeating rendered as an unordered list
			*  * default_repeatgroup.php - repeat group rendered as an unordered list
			*  * default_repeatgroup_table.php - repeat group rendered in a table.
			*/
			$this->elements = $child->elements;
			echo $this->loadTemplate('child_' . $child->tmpl);
			?>
			</div>
<?php
	endif;
	endif;
	endforeach; 
?>
	</div><!-- end fabrikSubGroup -->
	<?php
endforeach;
