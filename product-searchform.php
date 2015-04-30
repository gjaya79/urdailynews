<span class="page">
	<form role="search" method="get" id="searchform" class="search-form" action="<?php echo home_url( '/' ); ?>">
		<div><label class="screen-reader-text" for="s">Search for:</label>
			<input type="text" class="search-field" value="" placeholder="<?php echo __('Search for products ..', BW_THEME); ?>" name="s" id="s" />
			<button type="submit" id="searchsubmit" class="search-submit"><i class="fa fa-search"></i></button>
			<input type="hidden" name="post_type" value="product" />
		</div>
	</form>
</span>