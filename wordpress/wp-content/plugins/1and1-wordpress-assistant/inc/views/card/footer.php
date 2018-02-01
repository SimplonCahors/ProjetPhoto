<div class="card-footer">
	<?php
		if ( isset( $card_actions ) && is_array( $card_actions ) ) {

			foreach ( $card_actions as $id => $params ) {
				$label = isset( $params[ 'label' ] ) ? esc_html__( $params[ 'label' ] ) : '';

				$href = isset( $params[ 'href' ] ) ? esc_url( $params[ 'href' ] ) : '#';

				$class = isset( $params[ 'class' ] ) ? esc_attr( $params[ 'class' ] ) : '';
				$class .= isset( $params[ 'align' ] ) && $params[ 'align' ] == 'left' ? ' float-left' : '';

				$class = ! empty( $class ) ? ' class="' . $class . '"' : '';

				echo '<a href="' . $href . '" id="' . $id . '"' . $class . '>' . $label . '</a>';
			}
		}
	?>
</div>