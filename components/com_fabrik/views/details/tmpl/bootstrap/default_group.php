<?php
/**
 * Bootstrap Details Template
 *
 * @package     Joomla
 * @subpackage  Fabrik
 * @copyright   Copyright (C) 2005-2015 fabrikar.com - All rights reserved.
 * @license     GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * @since       3.1
 */

// No direct access
defined('_JEXEC') or die('Restricted access');
$file = array();
foreach ($this->elements as $e)
{
  if (isset($e->plugin) && ($e->plugin == 'fileupload' || $e->plugin == 'image') && $e->element_raw != '')
  {
   $file[] = $e->value;
  }
}
?>
<?php 
if ($file)
{
?>
  <div class="row-striped right" style="width:25%; float:right;margin-right:23px;text-align:center;clear:both;">
	<?php	
	$rowStarted = false;
  foreach ($this->elements as $element) :
    if (isset($element->plugin) && ($element->plugin == 'fileupload' || $element->plugin == 'image') && $element->element_raw != '') :
    $this->element = $element;
    if ($element->startRow) : ?>
			<div class="row-fluid <?php echo $single ? 'fabrikElementContainer' : ''; ?>" <?php echo $style?>><!-- start element row -->
	<?php
		$rowStarted = true;
	endif;
	$style = $element->hidden ? 'style="display:none"' : '';
	echo $this->loadTemplate('group_labels_none');
	if ($element->endRow) :?>
		</div><!-- end row-fluid -->
	<?php
		$rowStarted = false;
	endif;
	endif;
	endforeach;
?>
<?php if ($rowStarted === true) :?>
</div><!-- end row-fluid for open row -->
<?php endif;?>
  </div>
<?php 
}
?>
<?php 
if ($file)
{
?>
<div class="row-striped" style="width:70%; float:left;clear:left;">
<?php } 
else
{ ?>
<div class="row-striped">
<?php
}
$rowStarted = false;
foreach ($this->elements as $element) :
    if (isset($element->plugin) && $element->plugin != 'fileupload' && $element->plugin != 'image') :
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
	$labels_above = $element->dlabels;

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
	endif;
endforeach;
// If the last element was not closing the row add an additional div
if ($rowStarted === true) :?>
</div><!-- end row-fluid for open row -->
<?php endif;?>
</div>
<div style="clear:both;"></div>
