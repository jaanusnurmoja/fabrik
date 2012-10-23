<?php
/**
 * Labels Above Form Template: Group
 *
 * @package     Joomla
 * @subpackage  Fabrik
 * @copyright   Copyright (C) 2005 Fabrik. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @since       3.0
 */
 ?>
<?php foreach ( $this->elements as $element) {
	?>
	<td class="<?php echo $element->containerClass;?>">
		<?php //echo $element->label;?>
		<?php echo $element->errorTag; ?>
		<?php echo $element->element;?>
		<div class="fabrikErrorMessage">
				<?php echo $element->error;?>
			</div>
	</td>
	<?php }?>
