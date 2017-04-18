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

?>
<tr id="<?php echo $tr;?>" class="<?php echo $this->_row->class;?>">
	<?php foreach ($this->headings as $heading => $label) {
		$v = $this->_row->data->$heading;
		$showCell = $this->rowSpanData[$this->_row->cursor][$heading]['showCell'];
		$rowspan = '';
		if ($showCell == true)
		{
			$rowspans = isset($this->rowSpans) ? $this->rowSpans[$heading][$tr][$v] : array();
			$rowspan = 'rowspan="' . count($rowspans) . '"';			
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