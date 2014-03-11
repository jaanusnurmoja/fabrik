<?php
/**
 * Bootstrap Details Template: Repeat group rendered as a table
 *
 * @package     Joomla
 * @subpackage  Fabrik
 * @copyright   Copyright (C) 2005-2013 fabrikar.com - All rights reserved.
 * @license     GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * @since       3.0.7
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

$group = $this->group;
?>
<table class="table table-striped repeatGroupTable">
	<thead>
		<tr>
	<?php
	// Add in the table heading
	$firstGroup = $group->subgroups[0];
	foreach ($firstGroup as $el) :
		$style = $el->hidden ? 'style="display:none"' : '';
		?>
		<th <?php echo $style; ?> class="<?php echo $el->containerClass?>">
			<?php echo $el->label_raw?>
		</th>
		<?php
	endforeach;

// maybe there is some nested group
	foreach ($this->groups as $child):
	if ($child->parentgroup == $this->group->id):
	$this->child = $child;
	?>
	<th id="group<?php echo $child->id;?>" style="display: none;"></th>
		<?php

		/* Load the group template - this can be :
		 *  * default_group.php - standard group non-repeating rendered as an unordered list
		 *  * default_repeatgroup.php - repeat group rendered as an unordered list
		 *  * default_repeatgroup_table.php - repeat group rendered in a table.
		 */
		$this->elements = $child->elements;
		foreach ($this->elements as $element):
			$style = $element->hidden ? 'style="display:none"' : '';
			?>
			<th <?php echo $style; ?> class="<?php echo $element->containerClass?>">
			<?php echo $element->label_raw;?>
			</th>
			<?php 
		endforeach;
		endif;
	endforeach; 

	// This column will contain the add/delete buttons
	if ($group->editable) : ?>
	<th></th>
	<?php
	endif;
	?>
	</tr>
	</thead>
	<tbody>
		<?php

		// Load each repeated group in a <tr>
		$this->i = 0;
		foreach ($group->subgroups as $subgroup) :
			$this->elements = $subgroup;
			echo $this->loadTemplate('repeatgroup_row');
			$this->i ++;
		endforeach;
		?>
	</tbody>
</table>
