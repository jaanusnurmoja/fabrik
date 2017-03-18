<?php
/**
 * Bootstrap Form Template
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
$groupTmpl = $model->editable ? 'group' : 'group_details';
$active = ($form->error != '') ? '' : ' fabrikHide';

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
?>
<form method="post" <?php echo $form->attribs?>>
<?php
echo $this->plugintop;
?>

<div class="fabrikMainError alert alert-error fabrikError<?php echo $active?>">
	<button class="close" data-dismiss="alert">×</button>
	<?php echo $form->error; ?>
</div>

<div class="row-fluid nav">
	<div class="span6 pull-right">
		<?php
		echo $this->loadTemplate('buttons');
		?>
	</div>
	<div class="span6">
		<?php
		echo $this->loadTemplate('relateddata');
		?>
	</div>
</div>

<?php
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

		<fieldset class="<?php echo $group->class; ?>" id="group<?php echo $group->id;?>" style="<?php echo $group->css;?>">
			<?php
			if ($group->showLegend) :?>
				<legend class="legend"><?php echo $group->title;?></legend>
			<?php
			endif;

			if (!empty($group->intro)) : ?>
				<div class="groupintro"><?php echo $group->intro ?></div>
			<?php
			endif;

			/* Load the group template - this can be :
			 *  * default_group.php - standard group non-repeating rendered as an unordered list
			 *  * default_repeatgroup.php - repeat group rendered as an unordered list
			 *  * default_repeatgroup_table.php - repeat group rendered in a table.
			 */
			$this->elements = $group->elements;
			echo $this->loadTemplate($group->tmpl);

			if (!empty($group->outro)) : ?>
				<div class="groupoutro"><?php echo $group->outro ?></div>
			<?php
			endif;
		?>
		</fieldset>
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
					
					if ($group->editable)
					{
						$editable[$mgType] = $group->editable;
					}
					
					if ($group->canAddRepeat)
					{
						$canAddRepeat[$mgType] = $group->canAddRepeat;
					}
					if ($group->canDeleteRepeat)
					{
						$canDeleteRepeat[$mgType] = $group->canDeleteRepeat;
					}
				}
			}
		}
				
		$this->group = $mgKey;
				?>
		<fieldset id="group<?php echo $mgKey;?>">
		<?php
		if (!empty($legend)) :?>
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
				<?php
					// Add the add/remove repeat group buttons
					if (!empty($editable) && (!empty($canAddRepeat) || !empty($canDeleteRepeat))) : ?>
						<div class="fabrikGroupRepeater pull-right btn-group">
							<?php if (!empty($canAddRepeat)) :
								echo $this->addRepeatGroupButton;
							endif;
							if (!empty($canDeleteRepeat)) :
								echo $this->removeRepeatGroupButton;
							endif;?>
						</div>
					<?php
					endif;
					?>
					<div class="fabrikSubGroupElements">
						<?php
						foreach ($mergedSubGroups[$i] as $subgroup)
						{
							$this->elements = $subgroup;
							//echo '<pre>';
							//var_dump($subgroup);
							//echo '</pre>';
							echo $this->loadTemplate('group');
						}
						?>
					</div>
				</div>
				<?php
		}
					if (!empty($outros)) : ?>
						<div class="groupoutro"><?php echo implode('<br />', $outros) ?></div>
					<?php
					endif;
				?>
				</fieldset>
				<?php
	}

if ($model->editable) : ?>
<div class="fabrikHiddenFields">
	<?php echo $this->hiddenFields; ?>
</div>
<?php
endif;

echo $this->pluginbottom;
echo $this->loadTemplate('actions');
?>
</form>
<?php
echo $form->outro;
echo $this->pluginend;
echo FabrikHelperHTML::keepalive();
