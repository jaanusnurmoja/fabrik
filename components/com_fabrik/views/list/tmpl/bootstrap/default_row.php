<?php
/**
 * Fabrik List Template: Admin Row
 *
 * @package     Joomla
 * @subpackage  Fabrik
 * @copyright   Copyright (C) 2005-2016  Media A-Team, Inc. - All rights reserved.
 * @license     GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

// No direct access
defined('_JEXEC') or die('Restricted access');
$tr = $this->_row->id;

$rowintro = $this->rowintro;

if ($rowintro != '' && $this->_row->data->$rowintro != '')
{ ?>
	<tr id="<?php echo $this->_row->id . '_intro';?>" class="<?php echo $this->_row->class;?>">
	<td colspan="<?php echo count($this->headings);?>"><?php echo $this->_row->data->$rowintro;?></td>
	</tr>
<?php } ?>

<tr id="<?php echo $tr;?>" class="<?php echo $this->_row->class;?>">
	<?php 
	echo $this->_row->rtag[0] . $this->_row->rowNum . $this->_row->rtag[1]; 
	foreach ($this->headings as $heading => $label) 
	{
		$v = $this->_row->data->$heading;
		$pkField = empty($this->pkFields->$heading->name) ? '__pk_val' : $this->pkFields->$heading->name . '_raw';
		$pkValue = empty($this->_row->data->$pkField) ? '0' : (string) $this->_row->data->$pkField;
		$showCell = isset($this->rowSpanData) ? $this->rowSpanData[$this->_row->cursor][$heading]['showCell'] : true;
		$rowspan = '';
		if ($showCell == true)
		{
			$rowspans = isset($this->rowSpans) ? $this->rowSpans[$heading][$tr][$pkValue] : array();
			$rowspan = count($rowspans) > 0 ? 'rowspan="' . count($rowspans) . '"' : ''			
		}
		else
		{
			$rowspan = '';
		}
		
		$style = empty($this->cellClass[$heading]['style']) ? '' : 'style="'.$this->cellClass[$heading]['style'].'"';
		
		if ($showCell)
		{
			?>
			<td class="<?php echo $this->cellClass[$heading]['class']?>" <?php echo $rowspan;?><?php echo $style?>>
				<?php echo isset($this->_row->data) ? $v  : '';?>
			</td>
		<?php 
		}	}
	?>
</tr>
