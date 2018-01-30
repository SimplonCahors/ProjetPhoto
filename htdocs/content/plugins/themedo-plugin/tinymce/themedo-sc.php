<?php

// loads the shortcodes class, wordpress is loaded with it
require_once( 'shortcodes.class.php' );

// get popup type
$popup = trim( $_GET['popup'] );
$shortcode = new avalon_td_shortcodes( $popup );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<div id="themedo-popup">

	<div id="themedo-shortcode-wrap">

		<div id="themedo-sc-form-wrap">

			<?php
			$select_shortcode = array(
				'select' 				=> 'Choose a Shortcode',
				'accordion' 			=> 'Accordion',
				'brochure' 				=> 'Brochure',
				'tdcontent' 			=> 'Content',
				'countersbox' 			=> 'Counters Box',
				'coverbox' 				=> 'Cover Box',
				'customtitle' 			=> 'Custom Title',
				'expandable' 			=> 'Expandable',
				'fullwidth' 			=> 'Full Width Container',
				'flowgallery' 			=> 'Flow Gallery',
				'galleryblock'  		=> 'Gallery Block',
				'kenburns'  			=> 'Kenburns',
				'person' 				=> 'Person',
				'progressbar'			=> 'Progress Bar',
				'supersized'			=> 'Supersized Slider',
				'tabs' 					=> 'Tabs',
				'testimonials' 			=> 'Testimonials',
				'workstep' 				=> 'Work Step',

				//'alert' 					=> 'Alert',
				//'blog' 					=> 'Blog',
				//'button' 					=> 'Button',
				//'checklist' 				=> 'Checklist',
				//'columns' 				=> 'Columns',
				//'contentboxes' 			=> 'Content Boxes',
				//'countersbox' 			=> 'Counters Box',					
				//'counterscircle' 			=> 'Counters Circle',
				//'dropcap' 				=> 'Dropcap',
				//'flipboxes' 				=> 'Flip Boxes',
				//'fontawesome' 			=> 'Font Awesome',
				//'themedoslider' 			=> 'themedo Slider',
				//'googlemap' 				=> 'Google Map',
				//'highlight' 				=> 'Highlight',
				//'imagecarousel' 			=> 'Image Carousel',
				//'imageframe' 				=> 'Image Frame',
				//'lightbox' 				=> 'Lightbox',
				//'menuanchor' 				=> 'Menu Anchor',
				//'modaltextlink' 			=> 'Modal Text Link',
				//'onepagetextlink' 		=> 'One Page Text Link',
				//'popover' 				=> 'Popover',
				//'postslider' 				=> 'Post Slider',
				//'pricingtable' 			=> 'Pricing Table',
				//'sectionseparator' 		=> 'Section Separator',
				//'separator' 				=> 'Separator',
				//'sharingbox' 				=> 'Sharing Box',
				//'slider' 					=> 'Slider',
				//'sociallinks' 			=> 'Social Links',
				//'soundcloud' 				=> 'SoundCloud',
				//'table' 					=> 'Table',
				//'taglinebox' 				=> 'Tagline Box',
				//'comparison' 				=> 'Comparison',
				//'countdown' 				=> 'Countdown',
				//'gallery' 				=> 'Gallery',
				//'hotspot' 				=> 'Hotspot',
				//'intro' 					=> 'Intro',
				//'modal' 					=> 'Modal',
				//'recentposts' 			=> 'Recent Posts',
				//'service' 				=> 'Service',
				//'servicepack' 			=> 'Service Pack',
				//'servicetabs' 			=> 'Service Tabs',
				//'toggle' 					=> 'Toggles',
				//'tooltip' 				=> 'Tooltip',
				//'vimeo' 					=> 'Vimeo',
				//'woofeatured' 			=> 'Woocommerce Featured Products Slider',
				//'wooproducts' 			=> 'Woocommerce Products Slider',
				//'youtube' 				=> 'Youtube'
			);
			?>
			<table id="themedo-sc-form-table" class="themedo-shortcode-selector">
				<tbody>
					<tr class="form-row">
						<td class="label">Choose Shortcode</td>
						<td class="field">
							<div class="themedo-form-select-field">
							<div class="themedo-shortcodes-arrow">&#xf107;</div>
								<select name="avalon_td_select_shortcode" id="avalon_td_select_shortcode" class="themedo-form-select themedo-input">
									<?php foreach($select_shortcode as $shortcode_key => $shortcode_value): ?>
									<?php if($shortcode_key == $popup): $selected = 'selected="selected"'; else: $selected = ''; endif; ?>
									<option value="<?php echo $shortcode_key; ?>" <?php echo $selected; ?>><?php echo $shortcode_value; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<form method="post" id="themedo-sc-form">

				<table id="themedo-sc-form-table">

					<?php echo $shortcode->output; ?>

					<tbody class="themedo-sc-form-button">
						<tr class="form-row">
							<td class="field"><a href="#" class="themedo-insert">Insert Shortcode</a></td>
						</tr>
					</tbody>

				</table>
				<!-- /#themedo-sc-form-table -->

			</form>
			<!-- /#themedo-sc-form -->

		</div>
		<!-- /#themedo-sc-form-wrap -->

		<div class="clear"></div>

	</div>
	<!-- /#themedo-shortcode-wrap -->

</div>
<!-- /#themedo-popup -->

</body>
</html>