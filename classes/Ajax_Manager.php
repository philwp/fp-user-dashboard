<?php

namespace tcsl\dashboard;

class Ajax_Manager{

	public function register( $object, $method ) {
		add_action( "wp_ajax_$method", array( $object, $method ) );
	}

}
