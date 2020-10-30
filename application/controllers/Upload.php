<?php

class Upload extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	public function index() {
		$this->load->view('upload_form', array('error' => ' '));
	}

	public function do_upload() {
		$a = $this->input->post('asd');
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 1000;
		$config['max_width'] = 10240;
		$config['max_height'] = 7680;
		echo "Input is text :" . $a;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('userfile')) {
			$error = array('error' => $this->upload->display_errors());

			$s = $this->upload->data('file_name');
			$this->load->view('upload_form', $error);
		} else {
			// $a = $this->upload->data('file_name');
			// $data['photo'] = $this->upload->data('file_name');
			$t = $this->upload->data('file_type');
			$x = $this->upload->data('file_path');

			$a = base_url();
			$b = 'uploads/';
			$c = $this->upload->data('file_name');
			$d = $a . "" . $b . "" . $c;

			$data['loc1'] = $c;
			$data['loc'] = $d;
			//echo "URL :" . $d;

			// echo var_dump($data) . "<br/>";
			// echo $t . "<br/>";
			// echo $x;
			#$data = array('upload_data' => $this->upload->data());
			$this->load->view('upload_success', $data);
		}
	}
}
?>