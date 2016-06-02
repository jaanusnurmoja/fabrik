<?php
/**
 * Fabrik List Template: Admin Row
 *
 * @package     Joomla
 * @subpackage  Fabrik
 * @copyright   Copyright (C) 2005-2013 fabrikar.com - All rights reserved.
 * @license     GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

?>
<tr id="<?php echo $this->_row->id;?>">
	<?php foreach ($this->headings as $heading => $label) {
		?>
		<td>
			<?php echo @$this->_row->data->$heading;?>
		</td>
	<?php }?>
</tr>