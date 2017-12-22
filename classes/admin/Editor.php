<?php
namespace tcsl\dashboard\admin;

use tcsl\dashboard\Start;
use tcsl\dashboard\Meta;

class Editor {
	/**
	 * @var \CMB2
	 */
	protected $cmb2;

	/**
	 * Run system
	 *
	 * @since 0.0.1
	 */
	public function run(){
		$this->make_box();
		$this->add_fields();
		add_filter( 'manage_' . Start::POST_TYPE . '_posts_columns', [ $this, 'remove_post_columns' ], 10, 2 );
	}

	public function remove_post_columns( $columns ) {
		unset( $columns['title'], $columns['date'] );
		return $columns;

	}


	/**
	 * Create metabox object
	 *
	 * @since 0.0.1
	 */
	protected function make_box(){
		$this->cmb2= new_cmb2_box( [
			'id'            => Meta::BOX_ID,
			'title'         => 'Member Data',
			'object_types'  => array( Start::POST_TYPE ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
		]);
	}

	protected function add_fields() {
		$this->cmb2->add_field( [
			'name' => 'First Name',
			'id'   => Meta::FIRST_NAME,
			'type' => 'text_medium',
			'column' => [
				'position' => 1,
				'name'     => 'First Name',
			],
		] );
		$this->cmb2->add_field( [
			'name' => 'Last Name',
			'id'   => Meta::LAST_NAME,
			'type' => 'text_medium',
			'column' => [
				'position' => 1,
				'name'     => 'Last Name',
			],
		] );
		$this->cmb2->add_field( [
			'name' => 'Email',
			'id'   => Meta::EMAIL,
			'type' => 'text_email',
			'column' => [
				'position' => 3,
				'name'     => 'email',
			],
		] );
		$this->cmb2->add_field( [
			'name' => 'Race',
			'id'   => Meta::RACE,
			'type' => 'select',
			'options' => [
				'African American' 	=> 'African American',
				'Native American'	=> 'Native American',
				'Latino' 			=> 'Latino',
				'Asian' 			=> 'Asian',
				'Indian' 			=> 'Indian',
				'Caucasian' 		=> 'Caucasian',
				'European'			=> 'European',
				'Other'				=> 'Other'
				],
		] );
		$this->cmb2->add_field( [
			'name' => 'Age',
			'id'   => Meta::AGE,
			'type' => 'text_small',
		] );
		$this->cmb2->add_field( [
			'name' => 'School',
			'id'   => Meta::SCHOOL,
			'type' => 'text_small',
		] );
		$this->cmb2->add_field( [
			'name' => 'Zip Code',
			'id'   => Meta::ZIP,
			'type' => 'text_small',
		] );
	}
}
