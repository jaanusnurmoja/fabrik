<?php
/**
 * Bootstrap Form Template - group details
 *
 * @package     Joomla
 * @subpackage  Fabrik
 * @copyright   Copyright (C) 2005-2013 fabrikar.com - All rights reserved.
 * @license     GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * @since       3.1
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

foreach ($this->elements as $element) :
    if (!$element->hidden)
    {
        if ($element->startRow) :?>
            <div class="row-fluid">
        <?php
        endif;
        ?>

        <div class="<?php
        echo $element->span; ?>">
            <div class="row-fluid">
                <div class="span4"><em><?php
                        echo $element->label_raw ?></em></div>
                <div class="span8"><?php
                    echo $element->element; ?></div>
            </div>
        </div>

        <?php
        if ($element->endRow) :
            ?>
            </div>
        <?php
        endif;
    }
endforeach; ?>
