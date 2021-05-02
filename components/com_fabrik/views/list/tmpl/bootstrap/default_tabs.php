<?php

// No direct access
defined('_JEXEC') or die('Restricted access');

if (!empty($this->tabs)) :
    ?>
    <div>
        <?php
        echo $this->getModel()->getLayout('fabrik-tabs')->render((object)['tabs' => $this->tabs]);
        ?>
    </div>
<?php
endif; ?>
