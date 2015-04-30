<?php if ( Bw::has_average_score() && get_field('score_box') == ('before') ) : ?>
	<div class="score-box">
		<div class="score">
			<?php echo Bw::get_average_score();?>
		</div>
		<?php
		if (get_field('score_note')) {
			echo '<div class="score-note">' . get_field('score_note') . '</div>';
		}
		?>
	</div>
<?php endif; ?>