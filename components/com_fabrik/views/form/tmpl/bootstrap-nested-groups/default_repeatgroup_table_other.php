<?php
/**
 * Default Form Template: Repeat group rendered as a table
 *
 * @package     Joomla
 * @subpackage  Fabrik
 * @copyright   Copyright (C) 2005-2016  Media A-Team, Inc. - All rights reserved.
 * @license     GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * @since       3.0.7
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

$othergroup = $this->group;
?>
<table class="table table-striped repeatGroupTable">
	<thead>
		<tr>
	<?php
	// Add in the table heading
	$firstGroup = $othergroup->subgroups[0];
	foreach ($firstGroup as $el) :
		$style = $el->hidden ? 'style="display:none"' : '';
		?>
		<th <?php echo $style; ?> class="<?php echo $el->containerClass?>">
			<?php echo $el->label_raw?>
		</th>
		<?php
	endforeach;

	// This column will contain the add/delete buttons
	if ($othergroup->editable) : ?>
	<th data-role="fabrik-group-repeaters"></th>
	<?php
	endif;
	?>
	</tr>
	</thead>
	<tbody>
		<?php

		// Load each repeated group in a <tr>
		$this->i = 0;
		foreach ($othergroup->subgroups as $subgroup) :
			$this->elements = $subgroup;
			echo $this->loadTemplate('repeatgroup_row');
			$this->i ++;
		endforeach;
		?>
	</tbody>
</table>
