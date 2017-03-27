<?php
/**
 * Bootstrap Details Template
 *
 * @package     Joomla
 * @subpackage  Fabrik
 * @copyright   Copyright (C) 2005-2016  Media A-Team, Inc. - All rights reserved.
 * @license     GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * @since       3.1
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

$form = $this->form;
$model = $this->getModel();

if ($this->params->get('show_page_heading', 1)) : ?>
	<div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</div>
<?php
endif;

if ($this->params->get('show-title', 1)) :?>
<div class="page-header">
	<h1><?php echo $form->label;?></h1>
</div>
<?php
endif;

echo $form->intro;
echo '<div class="fabrikForm fabrikDetails" id="' . $form->formid . '">';
echo $this->plugintop;
echo $this->loadTemplate('buttons');
echo $this->loadTemplate('relateddata');
	$mg = array();
	
	foreach ($form->mergedGroups as $mgKey => $mgVals)
	{
		$mg[] = $mgVals['parent'];
		$mg[] = $mgVals['child'];
	}


foreach ($this->groups as $group) :
	if (!in_array($group->id, $mg))
	{
		$this->group = $group;
		?>

		<div class="<?php echo $group->class; ?>" id="group<?php echo $group->id;?>" style="<?php echo $group->css;?>">

		<?php
		if ($group->showLegend) :?>
			<h3 class="legend">
				<span><?php echo $group->title;?></span>
			</h3>
		<?php endif;

		if (!empty($group->intro)) : ?>
			<div class="groupintro"><?php echo $group->intro ?></div>
		<?php
		endif;

		// Load the group template - this can be :
		//  * default_group.php - standard group non-repeating rendered as an unordered list
		//  * default_repeatgroup.php - repeat group rendered as an unordered list
		//  * default_repeatgroup_table.php - repeat group rendered in a table.

		$this->elements = $group->elements;
		echo $this->loadTemplate($group->tmpl);

		if (!empty($group->outro)) : ?>
			<div class="groupoutro"><?php echo $group->outro ?></div>
		<?php
		endif;
		?>
	</div>
<?php
	}
endforeach;

	foreach ($form->mergedGroups as $mgKey => $mgVals)
	{
		$mergedGroups = array();
		
		echo '<pre>';
		var_dump($mgKey, $mgVals);
		echo '</pre>';

		
        $subgroups = array();
		$titles = array();
		$intros = array();
		$outros = array();
		$legend = array();
		$editable = array();
		$canAddRepeat = array();
		$canDeleteRepeat = array();
		
		foreach ($this->groups as $group)
		{
			foreach ($mgVals as $mgType => $mgVal)
			{
				if ($group->id == $mgVal)
				{
					$subgroups[$mgType] = $group->subgroups;
					
					if ($group->showLegend)
					{
						$titles[$mgType] = $group->title;
					}
					
					$intros[$mgType] = $group->intro;
					$outros[$mgType] = $group->outro;
					
				}
			}
		}
				
		$this->group = $mgKey;
?>
		<div id="id="group<?php echo $mgKey;?>">
		<?php 
		if (!empty($titles)) :?>
			<legend class="legend"><?php echo implode(' | ', $titles);?></legend>
				<?php
		endif;
		if (!empty($intros)) : ?>
			<div class="groupintro"><?php echo implode('<br />', $intros); ?></div>
		<?php
		endif;
		
		$mergedSubGroups = array();
				
		for ($i=0;$i<count($subgroups['parent']);$i++)
		{
			$mergedSubGroups[$i] = array($subgroups['parent'][$i], $subgroups['child'][$i]);
		?>
			<div class="fabrikSubGroup">
			<div class="fabrikSubGroupElements">
				<?php
				foreach ($mergedSubGroups[$i] as $subgroup)
				{

					// Load each group in a <ul>
					$this->elements = $subgroup;
					echo $this->loadTemplate('group');
				}
				?>
			</div><!-- end fabrikSubGroupElements -->
		</div><!-- end fabrikSubGroup -->
		<?php
		}
		
		if (!empty($outros)) : ?>
			<div class="groupoutro"><?php echo implode('<br />', $outros) ?></div>
		<?php
		endif;
			
	?>
	</div>
		<?php

}

echo $this->pluginbottom;
echo $this->loadTemplate('actions');
echo '</div>';
echo $form->outro;
echo $this->pluginend;
