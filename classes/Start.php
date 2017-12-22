<?php
namespace tcsl\dashboard;

use tcsl\dashboard\admin\Editor;
use tcsl\dashboard\Members;
use tcsl\dashboard\Dashboard;

class Start {

	const POST_TYPE = 'tcsl_member';

	public function __construct() {
		add_action( 'woocommerce_thankyou', [ $this , 'add_members' ] );
		add_action( 'woocommerce_after_my_account', [ $this, 'run_dashboard' ] );
		$this->add_cmb2();
		if ( is_admin() ) {
			add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue' ] );
		}
	}

	protected function start_admin() {
		$this->add_cmb2();
	}

	protected function add_cmb2(){
		$editor = new Editor();
		add_action( 'cmb2_init', [ $editor, 'run' ] );
	}

	public function add_members( $order_id ) {
		$members = new Members();
		$members->add_from_order( $order_id );

	}

	public function run_dashboard() {
		new Dashboard();
	}

	public function admin_enqueue() {

		wp_enqueue_script( 'tcsl-js', FP_USER_DASHBOARD_URL . '/dist/bundle.js', [], true );
		
	}
}
