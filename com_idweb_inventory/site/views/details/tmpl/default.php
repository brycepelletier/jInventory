<?php
/*------------------------------------------------------------------------
# default.php - idWeb Inventory Component
# ------------------------------------------------------------------------
# author    iDWeb Studios
# copyright Copyright (C) 2014. All Rights Reserved
# license   GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
# website   www.idwebstudios.com
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>

<div class='tm-middle uk-grid' data-uk-grid-match="" data-uk-grid-margin="">
	<div class="tm-main uk-width-medium-1-1">
		<section class="tm-main-top uk-grid" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin="">
			<div class="uk-width-1-1">
				<div class="uk-panel uk-panel-header">
					<div class="uk-panel">
						<?php 
							if (isset($this->uvs) && !empty($this->uvs)) {
								echo $this->loadTemplate('data');
							} else {
								echo $this->loadTemplate('nodata');
							} 
						?>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>