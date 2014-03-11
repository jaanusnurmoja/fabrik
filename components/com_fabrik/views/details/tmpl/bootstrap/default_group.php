<?php
/**
 * Bootstrap Details Template
 *
 * @package     Joomla
 * @subpackage  Fabrik
 * @copyright   Copyright (C) 2005-2013 fabrikar.com - All rights reserved.
 * @license     GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * @since       3.1
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

?>
<div class="row-striped">
<?php
$group = $this->group;
$rowStarted = false;
foreach ($this->elements as $element) :
	$this->element = $element;
	$this->element->single = $single = $element->startRow && $element->endRow;

	if ($single)
	{
		$this->element->containerClass = str_replace('fabrikElementContainer', '', $this->element->containerClass);
	}

	$element->fullWidth = $element->span == 'span12' || $element->span == '';
	$style = $element->hidden ? 'style="display:none"' : '';

	if ($element->startRow) : ?>
			<div class="row-fluid <?php echo $single ? 'fabrikElementContainer' : ''; ?>" <?php echo $style?>><!-- start element row -->
	<?php
		$rowStarted = true;
	endif;
	$style = $element->hidden ? 'style="display:none"' : '';
		$labels_above = (!$group->dlabels || (int) $group->dlabels == -1) ? $this->params->get('labels_above_details', 0) : (int) $group->dlabels;

	if ($labels_above == 1)
	{
		echo $this->loadTemplate('group_labels_above');
	}
	elseif ($labels_above == 2)
	{
		echo $this->loadTemplate('group_labels_none');
	}
	elseif ($element->span == 'span12' || $element->span == '' || $labels_above == 0)
	{
		echo $this->loadTemplate('group_labels_side');
	}
	else
	{
		// Multi columns - best to use simplified layout with labels above field
		echo $this->loadTemplate('group_labels_above');
	}
	if ($element->endRow) :?>
		</div><!-- end row-fluid -->
	<?php
		$rowStarted = false;
	endif;
endforeach;
 ?>
</div>

<?php
foreach ($this->groups as $child):
	if ($child->is_child):
		if ((!$child->is_join && $child->parentgroup == $this->group->id) || ($child->is_join && $child->join_from_table == $this->group->table_join)):
		
		//		&& (($this->group->canRepeat && !$child->canRepeat) || (!$this->group->canRepeat && $child->canRepeat) || (!$this->group->canRepeat && !$child->canRepeat))):
			
			$this->child = $child;
?>
			<div class="fabrikChildGroup" id="group<?php echo $child->id;?>" style="<?php echo $child->css;?>">
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
<div style="clear: both;"></div>