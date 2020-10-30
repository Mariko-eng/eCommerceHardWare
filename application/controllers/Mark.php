<?php

/**
 *
 */
class Mark extends CI_Controller {
	public function bio($num) {
		$this->load->library('session');
		$this->load->helper('cookie');
		$this->load->helper('url');

		$this->session->set_userdata('language', 'PHP');
		echo "Number : " . $num;
		echo "Cookie : " . get_cookie('name');
		echo "<br/>Language :" . $this->session->userdata('language');
		echo "<br/>Base URl :" . base_url();
		echo "<br/>Site URL :" . site_url();
		echo "<br/>current URL :" . current_url();
		echo "<br/>URL STRING :" . uri_string();

	}
}