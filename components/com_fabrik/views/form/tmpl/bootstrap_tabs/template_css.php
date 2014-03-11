<?php
/**
 * Fabrik Form View Template: Bootstrap Tab CSS
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
display: block;
}

.fabrikChildGroup {
min-width: 48%;
display: table;
float: left;
margin: 5px;
}

.nav-tabs li {
list-style: none;
}
";
?>