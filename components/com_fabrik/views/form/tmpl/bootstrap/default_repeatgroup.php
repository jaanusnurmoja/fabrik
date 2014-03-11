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

$group = $this->group;
foreach ($group->subgroups as $subgroup) :
	?>
	<div class="fabrikSubGroup">
	<?php
		// Add the add/remove repeat group buttons
		if ($group->editable && ($group->canAddRepeat || $group->canDeleteRepeat)) : ?>
			<div class="fabrikGroupRepeater pull-right btn-group">
				<?php if ($group->canAddRepeat) :?>
					<a class="addGroup btn btn-small btn-success" href="#">
						<i class="icon-plus fabrikTip tip-small" opts="{trigger: 'hover'}" title="<?php echo FText::_('COM_FABRIK_ADD_GROUP'); ?>"></i>
					</a>
				<?php
				endif;
				if ($group->canDeleteRepeat) :?>
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
			<fieldset class="<?php echo 'fabrikChildGroup' ?>" id="group<?php echo $child->id;?>" style="<?php echo $child->css;?>">
			<?php
			if ($child->showLegend) :?>
				<h4><?php echo $child->title;?></h4>
			<?php
			endif;

			$this->elements = $child->elements;
			echo $this->loadTemplate('child_' . $child->tmpl);

			?>
			</fieldset>
		
			<?php 
			endif;
			endif;
		endforeach;	
		?>
	</div><!-- end fabrikSubGroup -->
	<?php
endforeach;
