<?php
/**
 * Shortcode template file
 *
 * @var array $proteo_testimonials_id_array Array with post IDs.
 * @var string $proteo_testimonials_layout Shortcode layout.
 * @var string $proteo_testimonials_elements_to_show Shortcode elements to display.
 *
 * @since 1.1.0
 * @package YITH_Proteo_tookit
 */

if ( 'all' === $proteo_testimonials_elements_to_show || '' === $proteo_testimonials_elements_to_show ) {
	$proteo_testimonials_elements_to_show = 'picture,name,review,quote,rating,website,facebook,twitter,youtube,instagram,tiktok,linkedin,skype,categories';
}

$proteo_testimonials_elements_to_show = explode( ',', $proteo_testimonials_elements_to_show );
?>
<div class="yith-proteo-testimonials <?php echo esc_attr( $proteo_testimonials_layout ); ?>">
	<?php
	foreach ( $proteo_testimonials_id_array as $testimonial_id ) {
		$testimonial = array(
			'id'         => $testimonial_id,
			'name'       => get_the_title( $testimonial_id ),
			'review'     => get_post_meta( $testimonial_id, 'proteo_testimonial_review', true ),
			'quote'      => get_post_meta( $testimonial_id, 'proteo_testimonial_small_quote', true ),
			'rating'     => get_post_meta( $testimonial_id, 'proteo_testimonial_rating', true ),
			'website'    => get_post_meta( $testimonial_id, 'proteo_testimonial_website', true ),
			'facebook'   => get_post_meta( $testimonial_id, 'proteo_testimonial_social_facebook', true ),
			'twitter'    => get_post_meta( $testimonial_id, 'proteo_testimonial_social_twitter', true ),
			'youtube'    => get_post_meta( $testimonial_id, 'proteo_testimonial_social_youtube', true ),
			'instagram'  => get_post_meta( $testimonial_id, 'proteo_testimonial_social_instagram', true ),
			'tiktok'     => get_post_meta( $testimonial_id, 'proteo_testimonial_social_tiktok', true ),
			'linkedin'   => get_post_meta( $testimonial_id, 'proteo_testimonial_social_linkedin', true ),
			'skype'      => get_post_meta( $testimonial_id, 'proteo_testimonial_social_skype', true ),
			'categories' => get_the_terms( $testimonial_id, 'proteo_testimonials_tax' ),
		);

		?>
		<div class="yith-proteo-testimonial" data-testimonial_id="<?php echo esc_attr( $testimonial['id'] ); ?>">
			<?php
			if ( in_array( 'picture', $proteo_testimonials_elements_to_show, true ) && has_post_thumbnail( $testimonial_id ) ) {
				echo '<div class="testimonial-picture">' . get_the_post_thumbnail( $testimonial_id, array( 300, 300 ) ) . '</div>';
			}
			if ( in_array( 'name', $proteo_testimonials_elements_to_show, true ) ) {
				echo '<div class="testimonial-name">' . esc_html( $testimonial['name'] ) . '</div>';
			}
			if ( in_array( 'review', $proteo_testimonials_elements_to_show, true ) ) {
				echo '<div class="testimonial-review">' . wp_kses_post( $testimonial['review'] ) . '</div>';
			}
			if ( in_array( 'quote', $proteo_testimonials_elements_to_show, true ) ) {
				echo '<div class="testimonial-quote">' . wp_kses_post( $testimonial['quote'] ) . '</div>';
			}
			if ( in_array( 'rating', $proteo_testimonials_elements_to_show, true ) ) {
				echo '<div class="testimonial-quote">' . esc_html( $testimonial['rating'] ) . '</div>';
			}
			if ( in_array( 'website', $proteo_testimonials_elements_to_show, true ) ) {
				echo '<div class="testimonial-quote">' . esc_url( $testimonial['website'] ) . '</div>';
			}
			if ( in_array( 'facebook', $proteo_testimonials_elements_to_show, true ) ) {
				$social_networks['facebook'] = $testimonial['facebook'];
			}
			if ( in_array( 'twitter', $proteo_testimonials_elements_to_show, true ) ) {
				$social_networks['twitter'] = $testimonial['twitter'];

			}
			if ( in_array( 'youtube', $proteo_testimonials_elements_to_show, true ) ) {
				$social_networks['youtube'] = $testimonial['youtube'];
			}
			if ( in_array( 'instagram', $proteo_testimonials_elements_to_show, true ) ) {
				$social_networks['instagram'] = $testimonial['instagram'];
			}
			if ( in_array( 'tiktok', $proteo_testimonials_elements_to_show, true ) ) {
				$social_networks['tiktok'] = $testimonial['tiktok'];
			}
			if ( in_array( 'linkedin', $proteo_testimonials_elements_to_show, true ) ) {
				$social_networks['linkedin'] = $testimonial['linkedin'];
			}
			if ( in_array( 'skype', $proteo_testimonials_elements_to_show, true ) ) {
				$social_networks['skype'] = $testimonial['skype'];
			}
			if ( in_array( 'categories', $proteo_testimonials_elements_to_show, true ) ) {
				if ( ! empty( $testimonial['categories'] ) && ! is_wp_error( $testimonial['categories'] ) ) {
					$categories = wp_list_pluck( $testimonial['categories'], 'name' );
					echo esc_html( implode( ', ', $categories ) );
				}
			}


			the_widget( 'YITH_Proteo_Social_Icons', $social_networks );
			?>
		</div>
		<?php
	}
	?>
</div>
<?php
