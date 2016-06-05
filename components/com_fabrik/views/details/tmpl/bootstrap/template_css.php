<?php
/**
 * Fabrik Details Template: Bootstrap CSS
 *
 * @package     Joomla
 * @subpackage  Fabrik
 * @copyright   Copyright (C) 2005-2013 fabrikar.com - All rights reserved.
 * @license     GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

header('Content-type: text/css');
$c = (int) $_REQUEST['c'];
$view = isset($_REQUEST['view']) ? $_REQUEST['view'] : 'form';
echo "
.fabrikGroup {
clear: left;
}
div .fabrikChildGroup {
float: left;
min-width: 40%;
margin: 5px;
display: table;
}
";
?>