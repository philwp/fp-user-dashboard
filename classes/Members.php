<?php

namespace tcsl\dashboard;

use tcsl\dashboard\Member;

class Members{

	public function add_from_order( $order_id ) {
		$events_from_order = get_post_meta( $order_id, '_tribe_tickets_meta', true );

		 foreach ($events_from_order as $event_from_order ) {

		 	foreach( $event_from_order as $event_data ) {

		 		$member = new Member();
		 		$member->add_to_post_type( $event_data );

		 	}
		}
	}
}
