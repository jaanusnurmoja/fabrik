<?php
defined('JPATH_BASE') or die;

$d = $displayData;

if ($d->optsPerRow < 1)
{
	$d->optsPerRow = 1;
}
if ($d->optsPerRow > 12)
{
	$d->optsPerRow = 12;
}
$label = isset($d->option) ? $d->option->text : '';
$value = isset($d->option) ? $d->option->value : '';
$name =  isset($d->colCounter) ? $d->name . '[' . $d->colCounter . ']' : $d->name . '[]';
$multiName =  isset($d->colCounter) ? $d->multiName . '[' . $d->colCounter . ']' : $d->multiName . '[]';
$extraFKName =  isset($d->colCounter) ? $d->extraFKName . '[' . $d->colCounter . ']' : $d->extraFKName . '[]';
$extraPKVal = $d->extraPKVal[0];
$multiNameVal = isset($d->colCounter) && isset($d->multiNameVal[$d->colCounter])? $d->multiNameVal[$d->colCounter] : '';
$colSize    = floor(floatval(12) / $d->optsPerRow);
//$type = isset($d->single) ? 'radio' : 'checkbox';
?>
<td data-role="suboption">
		<input type="hidden" value="<?php echo $value;?>" data-role="fabrikinput" name="<?php echo $name; ?>" class="fabrikinput" />
		<span><?php echo $label;?></span>
</td>
<td class="controls fabrikElement fabrikSubElementContainer" id="<?php echo $multiName ;?>">
<?php if ($d->multiElementType == 'radio') 
{?>
<fieldset class="radio btn-radio btn-group" data-toggle="buttons">
<?php 
foreach ($d->radioSubValues as $k => $subVal)
{ 
	$subLab = $d->radioSubLabels[$k];
	$checked = '';
	$success = '';
	
	if ($multiNameVal == $subVal)
	{
		$checked = 'checked="checked"';
		$success = ' btn-success';
	}
;?>
	<label class="fabrikgrid_<?php echo $k; ?> btn-default btn<?php echo $success;?>">
	<input type="radio" class="fabrikinput " name="<?php echo $multiName;?>" value="<?php echo $subVal;?>" <?php echo $checked;?>><span><?php echo $subLab;?></span></label>
<?php 	
} ?>
</fieldset>
<?php }
else
{	?>
<div class="fabrikElement">
		
<input type="text" id="<?php echo $multiName;?>" name="<?php echo $multiName;?>" size="10" maxlength="255" class="input-medium form-control fabrikinput inputbox text" value="<?php echo $multiNameVal;?>">
	</div>
<?php } ?>
</td>
<td data-role="suboption">
		<input type="text" value="<?php echo $extraPKVal;?>" data-role="fabrikinput" name="<?php echo $extraFKName; ?>" class="fabrikinput" />
</td>
