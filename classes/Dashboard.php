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
		$html = '<div class="container" >';
			$html .= '<h1>Dashboard</h1>';
			$html .= $this->get_members_for_user();
		$html .= '</div>';
		echo $html;
	}

	 public function get_members_for_user() {
		$member_ids = get_user_meta( $this->user_id, Meta::USER_MEMBERS, false );
		$html = '';
		foreach ( $member_ids as $member_id ) {
			$member = new Member( $member_id );
			$html .= '<div class="tcsl-member" id="tcsl-member-' . $member_id . '">';
				$html .= '<h3>' . $member->get_first_name() ." " . $member->get_last_name() . '</h3>';
				$html .= '<p>Member ID: ' . $member_id . '</p>';
				$html .= '<a href="'. add_query_arg( ['member_id' => $member_id], '/my-account/edit-member') .'">Edit ' . $member->get_first_name(). '</a>';

			$html .= '</div>';
			$html .= '<hr>';
		}
		return $html;
	 }
}


