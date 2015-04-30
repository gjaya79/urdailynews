
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<h1><?php the_title(); ?></h1>
	
	<ul>
	<?php foreach(Bw::gallerize_by_id( Bw::get_meta('bw_gallery') ) as $image): ?>
		<li>
			<img src="<?php echo $image['thumb'][0] ?>" alt="<?php echo $image['title'] ?>">
		</li>
	<?php endforeach; ?>
	</ul>
	
</div>