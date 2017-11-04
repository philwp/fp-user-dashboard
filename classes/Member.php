<?php

namespace tcsl\dashboard;

use tcsl\dashboard\Start;
use tcsl\dashboard\Meta;

class Member{

	protected $id;

	public function __construct( $id = 0 ) {
		if ( $id != 0 ) {
			$this->id = $id;
		}
	}

	public function add_to_post_type( $member_data ) {
		$email =  $member_data['email'];
		$first_name = $member_data['first-name'];
		$last_name = $member_data['last-name'];
		$race = $member_data['race'];
		$age = $member_data['age'];
		$school = $member_data['school'];
		$zip = $member_data['zip-code'];

		//Add if member is not already in DB
		if ( ! $this->does_member_email_exist( $email ) ) {

			$meta_arr = array(
			Meta::EMAIL 		=> $email,
			Meta::FIRST_NAME 	=> $first_name,
			Meta::LAST_NAME 	=> $last_name,
			Meta::RACE 			=> $race,
			Meta::AGE 			=> $age,
			Meta::SCHOOL 		=> $school,
			Meta::ZIP 			=> $zip,

			);

			$postarr = array(
				'post_title' 		=> $first_name . ' ' . $last_name,
				'post_status' 		=> 'publish',
				'post_type' 		=> Start::POST_TYPE,
				'comment_status' 	=> 'closed',
				'ping_status' 		=> 'closed',
				'meta_input' 		=> $meta_arr
				);
			$new_member = wp_insert_post( $postarr );
			if ( is_integer( $new_member ) ) {
				$this->id = $new_member;
				$current_user_id = get_current_user_id();
				$this->add_member_to_user( $current_user_id );
			}
		} else {
			//$this->add_member_to_user( $current_user_id );
		}
	}

	/**
	 *
	 *
	 * @return (int)id or false
	 * @author
	 **/
	protected function does_member_email_exist( $email ) {

		$args = array(
		   'post_type' => Start::POST_TYPE,
		   'meta_query' => array(
			    array(
			        'key' => Meta::EMAIL,
			        'value' => $email
			    )
			),
			'fields' => 'ids'
		);
		$email_query = get_posts( $args );
		return !empty( $email_query ) ? $email_query : false ;
	}

	protected function add_member_to_user( $user_id ) {
		$user_members = get_user_meta( $user_id, Meta::USER_MEMBERS, false );

		if ( empty( $user_members ) ) {
			add_user_meta( $user_id, Meta::USER_MEMBERS, $this->id );
		} else {
			if ( ! in_array( $this->id, $user_members ) ) {
				add_user_meta( $user_id, Meta::USER_MEMBERS, $this->id );
			}
		}
	}

	public function get_first_name() {
		return get_post_meta( $this->id, Meta::FIRST_NAME, true );
	}

	public function first_name() {
		echo $this->get_first_name();
	}

	public function get_last_name() {
		return get_post_meta( $this->id, Meta::LAST_NAME, true );
	}

	public function last_name() {
		echo $this->get_first_name();
	}


}
