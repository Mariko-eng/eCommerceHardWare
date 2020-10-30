<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('googlemaps');
		$this->load->helper('url');
	}

	public function index() {
		// $config['geocodeCaching'] = TRUE;
		$config['center'] = '0.347596, 32.582520';
		$config['zoom'] = 'auto';
		$config['places'] = TRUE;
		$config['placesAutocompleteInputID'] = 'myPlaceTextBox';
		$config['placesAutocompleteOnChange'] = 'alert(\'You selected a place\');';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = '0.347596, 32.582520';
		$marker['draggable'] = true;

		$this->googlemaps->add_marker($marker);

		$data['map'] = $this->googlemaps->create_map();

		$this->load->view('g_maps', $data);
	}
}
