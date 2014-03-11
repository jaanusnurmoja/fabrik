<?php
/**
 * Bootstrap Form Template - Group
 *
 * @package     Joomla
 * @subpackage  Fabrik
 * @copyright   Copyright (C) 2005-2013 fabrikar.com - All rights reserved.
 * @license     GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * @since       3.1
 */

// No direct access
defined('_JEXEC') or die('Restricted access');
$group = $this->group;
$rowStarted = false;
foreach ($this->elements as $element) :
	$this->element = $element;
	$this->class = 'fabrikErrorMessage';

	// Don't display hidden element's as otherwise they wreck multi-column layouts
	if (trim($element->error) !== '') :
		$element->error = $this->errorIcon . ' ' . $element->error;
		$element->containerClass .= ' error';
		$this->class .= ' help-inline';
	endif;

	if ($element->startRow) : ?>
		<div class="row-fluid">
	<?php
		$rowStarted = true;
	endif;
	$style = $element->hidden ? 'style="display:none"' : '';
	$span = $element->hidden ? '' : ' ' . $element->span;
	?>
			<div class="control-group <?php echo $element->containerClass . $span; ?>" <?php echo $style?>>
	<?php
	$labels_above = (!$group->labels || $group->labels == -1) ? $this->params->get('labels_above', 0) : $group->labels;
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
	?> </div><!-- end control-group --><?php
	if ($element->endRow) :?>
		</div><!-- end row-fluid -->
	<?php
		$rowStarted = false;
	endif;
endforeach;
// If the last element was not closing the row add an additional div
if ($rowStarted === true) :?>
	</div><!-- end row-fluid for open row -->
<?php endif;
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
