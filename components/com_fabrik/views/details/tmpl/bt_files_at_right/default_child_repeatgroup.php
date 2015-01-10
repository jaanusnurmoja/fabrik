<?php
/**
 * Bootstrap Form Template: Repeat group rendered as standard form
 *
 * @package     Joomla
 * @subpackage  Fabrik
 * @copyright   Copyright (C) 2005-2013 fabrikar.com - All rights reserved.
 * @license     GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * @since       3.0
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

$child = $this->child;
foreach ($child->subgroups as $subgroup) :
	?>
	<div class="fabrikSubGroup">
	<?php
		// Add the add/remove repeat group buttons
		if ($child->editable && ($child->canAddRepeat || $child->canDeleteRepeat)) : ?>
			<div class="fabrikGroupRepeater pull-right btn-group">
				<?php if ($child->canAddRepeat) :?>
					<a class="addGroup btn btn-small btn-success" href="#">
						<i class="icon-plus fabrikTip tip-small" opts="{trigger: 'hover'}" title="<?php echo FText::_('COM_FABRIK_ADD_GROUP'); ?>"></i>
					</a>
				<?php
				endif;
				if ($child->canDeleteRepeat) :?>
					<a class="deleteGroup btn btn-small btn-danger" href="#">
						<i class="icon-minus fabrikTip tip-small" opts="{trigger: 'hover'}" title="<?php echo FText::_('COM_FABRIK_DELETE_GROUP'); ?>"></i>
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
			echo $this->loadTemplate('child_group');
			?>
		</div><!-- end fabrikSubGroupElements -->
		<?php
foreach ($this->groups as $group):
	if ($group->is_child):
		if ((!$group->is_join && $group->parentgroup == $this->child->id) || ($group->is_join && $group->join_from_table == $this->child->table_join)):
		
		//		&& (($this->child->canRepeat && !$group->canRepeat) || (!$this->child->canRepeat && $group->canRepeat) || (!$this->child->canRepeat && !$group->canRepeat))):
		
			$this->child = $child;
		?>
			<div class="fabrikChildGroup" id="group<?php echo $group->id;?>" style="<?php echo $group->css;?>">
			<?php
			if ($group->showLegend) :?>
				<h4><?php echo $group->title;?></h4>
			<?php
			endif;
			/*
			if ($group->is_join && $group->join_from_table == $this->child->table_join)
			{
		?>
			<div><?php echo '<pre>';
			var_dump($group->is_child, $group->list_table, $group->is_join, $group->join_id, $group->join_from_table, $group->table_join, $group->table_key, $group->table_join_key, $group->pk, $group->fk);
			echo '</pre>';?></div>
		<?php
			}
			*/

			/* Load the group template - this can be :
			*  * default_group.php - standard group non-repeating rendered as an unordered list
			*  * default_repeatgroup.php - repeat group rendered as an unordered list
			*  * default_repeatgroup_table.php - repeat group rendered in a table.
			*/
			$this->elements = $group->elements;
			echo $this->loadTemplate('child_' . $group->tmpl);
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
