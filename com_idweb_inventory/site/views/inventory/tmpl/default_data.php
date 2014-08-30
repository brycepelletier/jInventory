<?php
	// No direct access
	defined('_JEXEC') or die('Restricted access');
	setlocale(LC_MONETARY, 'en_US');

	$count = 0;
?>
<div class="inv-list">
<?php
	foreach($this->inventory as $uvs):
	$class = ($count%2 == 0) ?  ' even' : ' odd';
	$hasMsrp = intval($uvs->msrp, 10) > 0 ? true : false;
	$hasCashPrice = intval($uvs->cashprice, 10) > 0 ? true : false;
?>
	<div class="inv-item<?php echo $class;?>">
			<a href="<?php echo JRoute::_('index.php?option=com_idweb_inventory&view=details&itemId=' . $uvs->numb); ?>">
				<h4><?php echo $uvs->year . ' ' . $uvs->make . ' ' . $uvs->model; ?></h4>
			</a>
			<div class='uk-grid'>
				<div class='inv-info-wrapper uk-width-large-1-3 uk-width-medium-1-2'>
					<p><span for='stock-num'><?php echo JText::_('Stock#:'); ?></span><span name='stock-num'> <?php echo $uvs->numb; ?></span></p>
					<p><span for='style'><?php echo JText::_('Style:'); ?></span><span name='style'> <?php echo $uvs->style; ?></span></p>
					<p><span for='color'><?php echo JText::_('Color:'); ?></span><span name='color'> <?php echo $uvs->color; ?></span></p>
					<p><span for='class'><?php echo JText::_('Class:'); ?></span><span name='class'> <?php echo $uvs->class; ?></span></p>
					<?php if($hasMsrp): ?>
					<p class='red strikethrough'><strong><span for='msrp'><?php echo JText::_('MSRP:'); ?></span><span name='price'> <?php echo money_format('%.2n',intval ($uvs->msrp)); ?></span></strong></p>
					<?php endif; ?>
					<p><span for='price'><?php echo JText::_('Sale Price:'); ?></span><span name='price'> <?php echo money_format('%.2n',intval ($uvs->price)); ?></span></p>
					<?php if($hasCashPrice): ?>
					<p class='call red'><?php echo JText::_('Call for Best Price'); ?></p>
					<?php endif; ?>
				</div>
				
				<div class="inv-image-wrapper uk-grid uk-width-large-2-3 uk-width-medium-1-2" data-uk-margin>
				<?php 
					if (count($uvs->images) > 0) : 
						for ($index=0; $index < 3; $index += 1) {
							$image = $uvs->images[$index];
				?>
					<div class='uk-width-small-1-3'><a href="<?php echo JRoute::_('index.php?option=com_idweb_inventory&view=details&itemId=' . $uvs->numb); ?>" title="<?php echo $uvs->year . ' ' . $uvs->make . ' ' . $uvs->model; ?>"><img src="<?php echo $image; ?>"/></a>
					</div>
				<?php 
						}
					endif; 
				?>
				</div>
			</div>
	</div>
<?php 
	$count += 1;
	endforeach; 
?>
</div>