<?php
/**
 * Template used to display the pixproof gallery
 * Available vars:
 * string       $client_name
 * string       $event_date
 * int          $number_of_images
 * string       $file
 */
?>
<div id="pixproof_data" class="pixproof-data">
	<div class="grid">
    <div><!--
		<?php if ( ! empty( $client_name )) { ?>
			-->
		<div class="grid__item">
			<div class="entry__meta-box">
				<h6><?php esc_attr_e('Client', 'themedo-core');?></h6>
				<span><?php echo $client_name; ?></span>
			</div>
		</div>
		<!--
		<?php
		}
		if ( ! empty( $event_date )) {
		?>
		-->
		<div class="grid__item">
			<div class="entry__meta-box">
				<h6><?php esc_html_e('Event date', 'themedo-core');?></h6>
				<span><?php echo $event_date; ?></span>
			</div>
		</div>
		<!--
		<?php
		}
		if ( ! empty( $number_of_images )) {
		?>
		-->
		<div class="grid__item">
			<div class="entry__meta-box">
				<h6><?php esc_html_e('Images', 'themedo-core');?></h6>
				<span><?php echo $number_of_images; ?></span>
			</div>
		</div>
		<!--
		<?php
		}
		if ( ! empty( $file )) { ?>
			-->
		<div class="grid__item last">
			<div class="entry__meta-box">
				<button class="button-download button js-download" onclick="window.open('<?php echo $file; ?>')"><?php esc_html_e('Download', 'themedo-core');?></button>
			</div>
		</div>
		<!--
		<?php } ?>-->
	</div>
</div>
</div>
<?php
