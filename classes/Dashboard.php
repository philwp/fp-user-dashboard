<?php

namespace tcsl\dashboard;

use tcsl\dashboard\Meta;
use tcsl\dashboard\Member;

class Dashboard {
	protected $user_id;

	public function __construct() {
		$this->user_id = get_current_user_id();
		$this->create_dashboard();
	}

	public function create_dashboard() {
		echo '<div class="container" >';
			echo '<h1>Dashboard</h1>';
			echo $this->get_members_for_user();
		echo '</div>';
	}

	 public function get_members_for_user() {
		$member_ids = get_user_meta( $this->user_id, Meta::USER_MEMBERS, false );
		$html = '';
		foreach ( $member_ids as $member_id ) {
			$member = new Member( $member_id );
			$html .= '<h3>' . $member->get_first_name() ." " . $member->get_last_name() . '</h3>';

			$html .= '<hr>';
		}
		return $html;
	 }
}


