<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
setlocale(LC_MONETARY, 'en_US');
$count = count($this->uvs->images);
$hasMsrp = intval($this->uvs->msrp, 10) > 0 ? true : false;
$hasCashPrice = intval($this->uvs->cashprice, 10) > 0 ? true : false;
jFactory::getDocument()->addScriptDeclaration("jQuery(document).ready(function () {
            jQuery('.fancybox').fancybox();
            var galleries = jQuery('.ad-gallery').adGallery();

            //build array image list
            var ophotos = [];
            jQuery('.ad-thumb-list li a').parent('li:first').addClass('active');

            //add remove active class in ad-gallrey thumb list
            jQuery('.ad-thumb-list a').click(function () {
                jQuery(this).removeClass('ad-active');
                jQuery('.ad-thumb-list li').removeClass('active');
                jQuery('.ad-thumb-list li').parent('li:first').addClass('active');
                jQuery(this).parent().addClass('active');
            });

            //get attribute of each anchor from array item
            jQuery('.ad-thumb-list').find('a').each(function (i) {
                ophotos[i] = { 'href': this.href, 'title': this.title };
            });

            jQuery(document).on('click', '.fancyLink', function (e) {
                // find index of corresponding thumbnail
                var opopUpImgIndex = jQuery('.ad-thumb-list').find('li.active').index();

                // open fancybox gallery starting from corresponding index
                jQuery.fancybox(ophotos, {
                    // fancybox options
                    //'cyclic': true, // optional for fancybox v1.3.4 ONLY, use 'loop' for v2.x
                    'index': opopUpImgIndex, // start with the corresponding thumb index
                    'transitionIn': 'elastic',
                    'easingIn': 'easeOutBack',
                    'transitionOut': 'elastic',
                    'easingOut': 'easeInBack',
                    'opacity': false,
                    'titleShow': true,
                    'titlePosition': 'over',
                    'type': 'image',
                    'titleFromAlt': true
                });
								// prevent default and stop propagation
                e.preventDefault();
                return false; 
            });
        });");
?>
<div class='inv-details'>
	<h4><?php echo $this->uvs->year . ' ' . $this->uvs->make . ' ' . $this->uvs->model; ?></h4>
	<div class="inv-item uk-grid">
		<ul class='inv-info-wrapper uk-width-large-1-2'>		
			<li><span for='stock-num'><?php echo JText::_('Stock#:'); ?></span><span name='stock-num'> <?php echo $this->uvs->numb; ?></span></li>
			<li><span for='color'><?php echo JText::_('Color:'); ?></span><span name='color'> <?php echo $this->uvs->color; ?></span></li>
			<li><span for='year'><?php echo JText::_('Year:'); ?></span><span name='year'> <?php echo $this->uvs->year; ?></span></li>
			<li><span for='length'><?php echo JText::_('Length:'); ?></span><span name='length'> <?php echo $this->uvs->length; ?></span></li>
			<li><span for='make'><?php echo JText::_('Make:'); ?></span><span name='make'> <?php echo $this->uvs->make; ?></span></li>
			<li><span for='class'><?php echo JText::_('Class:'); ?></span><span name='class'> <?php echo $this->uvs->class; ?></span></li>
			<li><span for='model'><?php echo JText::_('Model:'); ?></span><span name='model'> <?php echo $this->uvs->model; ?></span></li>
			<?php if($hasMsrp): ?>
			<li class='red strikethrough'><span for='msrp'><?php echo JText::_('MSRP:'); ?></span><span name='msrp'> <?php echo money_format('%.2n',intval ($this->uvs->msrp)); ?></span></li>
			<?php endif; ?>
			<li><span for='price'><?php echo JText::_('Sale Price:'); ?></span><span name='price'> <?php echo money_format('%.2n',intval ($this->uvs->price)); ?></span></li>
			<li><span for='style'><?php echo JText::_('Style:'); ?></span><span name='style'> <?php echo $this->uvs->style; ?></span></li>
<!--			<li><span for='options'>--><?php //echo JText::_('Options:'); ?><!--</span><span name='options'> --><?php //echo $this->uvs->optnotes; ?><!--</span></li>-->
			<li><span for='description'><?php echo JText::_('Description:'); ?></span><span name='description'> <?php echo $this->uvs->picture_fi; ?></span></li>
		</ul>
		
		<div class="slideGallery inv-image-wrapper uk-width-large-1-2 uk-align-center">
			<div id="gallery" class="ad-gallery uk-grid uk-grid-preserve">
				<div class="ad-image-wrapper uk-width-1-1">
					<div class="ad-image">
						<a href="<?php echo $this->uvs->image; ?>" target="_blank" class="fancyLink" rel="gallery">
							<img src="<?php echo $this->uvs->image; ?>" class='uk-responsive-height'>
						</a>
					</div>
					<img class="ad-loader" src="media/images/loader.gif" style="display: none;">
				</div>
				<div class="ad-controls uk-hidden uk-width-1-1">
			    <p class="ad-info">1 / <?php echo $count; ?></p>
			    <div class="ad-slideshow-controls">
			    	<span class="ad-slideshow-start">Start</span>
			    	<span class="ad-slideshow-stop">Stop</span>
			    	<span class="ad-slideshow-countdown" style="display: none;"></span>
			    </div>
			   </div>	
				<div class="ad-nav uk-width-1-1">
					<div class='ad-thumbs'>
						<ul class='ad-thumb-list' class='uk-grid'>
							<?php 
								if ($count > 0) : 
									$i = 0;
									foreach ($this->uvs->images as $image):
									$class =	'ad-thumb' . $i++;
							?>
								<li>
									<a href="<?php echo $image; ?>" class="<?php echo $class; ?>">
										<img src="<?php echo $image; ?>" title="<?php echo $this->uvs->year . ' ' . $this->uvs->make . ' ' . $this->uvs->model; ?>" class="<?php echo $class; ?> uk-width-medium-1-<?php echo $count; ?> uk-responsive-height" />
									</a>
								</li>
							<?php 
									endforeach;
								endif; 
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class='call-to-action uk-width-1-1'>
		<a href="<?php echo $this->goBack; ?>" title="<?php echo JText::_('Go Back') ?>">
			<?php echo JText::_('Go Back') ?>
		</a>
		<?php if($hasCashPrice): ?>
		<span class='call'><?php echo JText::_('Call for Best Price'); ?></span>
		<?php endif; ?>
	</div>
</div>