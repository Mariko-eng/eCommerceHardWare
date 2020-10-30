<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Admin extends CI_Controller {

	function __construct() {
		# code...
		parent::__construct();
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->library('calendar');
		$this->load->helper('cookie');
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->model('User_Admin_Model', 'admin');
	}

	public function index() {
		if ($this->input->post('admin_loginSubmit')) {
			$user = $this->input->post('admin_name');
			$passwrd = $this->input->post('admin_pass');
			$this->admin->setName($user);
			$this->admin->setPass($passwrd);
			$this->admin->setStatus(1);

			$_user = $this->admin->getAdmin();
			if (!empty($_user)) {
				$adminloginDetails = array('admin' => $_user['ad_name'],
					'email' => $_user['ad_email'], 'telephone' => $_user['ad_number']);
				$this->session->set_userdata('admin_info', $adminloginDetails);

				$data = array();
				$data['title'] = 'Product | eZimba';
				$config['base_url'] = base_url() . 'admin/index/';
				$rows = $this->admin->getAllProductCountAdmin();
				echo $rows;
				echo "<br/>";
				$config['total_rows'] = $rows;

				$config['per_page'] = 2;
				$config['ur1_segment'] = 3;

				if (empty($this->uri->segment(3))) {
					$page_number = 0;
				} else {
					$page_number = $this->uri->segment(3);
				}
				$offset = ($page_number - 1) * $this->pagination->per_page;
				$this->admin->setPageNumber($config['per_page']);
				$this->admin->setOffset($page_number);
				$this->pagination->initialize($config);

				$data['page_links'] = $this->pagination->create_links();
				$data['results'] = $this->admin->getAllProductsAdmin();
				echo var_dump($data['results']);

				$this->load->view('header');
				$this->load->view('productlist', $data);
				$this->load->view('footer');
			} else {
				$data['adminloginDetails'] = array('error' => 'Incorrect UserName And Password');
				echo var_dump($data['adminloginDetails']);
				$this->load->view('adminlogin', $data);
			}
		} else {
			if ($this->session->has_userdata('admin_info')) {
				$config['base_url'] = base_url() . 'admin/index/';
				$rows = $this->admin->getAllProductCountAdmin();
				$config['total_rows'] = $rows;

				$config['per_page'] = 2;
				$config['ur1_segment'] = 3;

				if (empty($this->uri->segment(3))) {
					$page_number = 0;
				} else {
					$page_number = $this->uri->segment(3);
				}
				$offset = ($page_number - 1) * $this->pagination->per_page;
				$this->admin->setPageNumber($config['per_page']);
				$this->admin->setOffset($page_number);
				$this->pagination->initialize($config);

				$data['page_links'] = $this->pagination->create_links();
				$data['results'] = $this->admin->getAllProductsAdmin();

				$this->load->view('header');
				$this->load->view('productlist', $data);
				$this->load->view('footer');
			} else {
				$this->load->view('adminlogin');
			}
		}
	}

	public function logout() {
		if ($this->session->has_userdata('admin_info')) {
			$this->session->sess_destroy();
			redirect('adminlogin');
		}

	}

	public function newproduct() {
		if ($this->session->has_userdata('admin_info')) {
			if ($this->input->post('psubmit')) {
				$nextID = $this->admin->get_last_ProductID();
				$nextID_str = $nextID->product_id;
				$nextID_int = (int) $nextID_str;
				$pID = $nextID_int + 1;

				$input1 = $this->input->post('pname');
				$input2 = $this->input->post('pcategory');
				$input3 = $this->input->post('pdesc');
				$input4 = $this->input->post('pquantity');
				$input5 = $this->input->post('pprice');
				$input6 = $this->input->post('psku');

				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 1000;
				$config['max_width'] = 10240;
				$config['max_height'] = 7680;

				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('uploadimg')) {
					$error = array('error' => $this->upload->display_errors());
					echo "Upload Failed";
					$this->load->view('productadd', $error);
				} else {
					$input7 = $this->upload->data('file_name');
					$this->admin->setPDName($input1);
					$this->admin->setPDCategory($input2);
					$this->admin->setPDDescription($input3);
					$this->admin->setPQuantity($input4);
					$this->admin->setPPrice($input5);
					$this->admin->setPSku($input6);
					$this->admin->setPImage($input7);
					$this->admin->setProductID($nextID_int + 1);
					$this->admin->setStatus(1);

					$this->admin->add_NewProduct();
					$data['status'] = "ADDED";
					$this->load->view('productadd', $data);
				}
			} else {
				$this->load->view('productadd');
			}
		} else {
			redirect('adminlogin');
		}
	}

	public function updateProductDisplay() {
		if ($this->session->has_userdata('admin_info')) {
			$pID = $this->input->post('productID');
			$this->admin->setProductID($pID);
			$data['item'] = $this->admin->get_singleproduct();
			$this->load->view('productupdate', $data);
		} else {
			redirect('adminlogin');
		}
	}

	public function updateProductReal() {
		if ($this->session->has_userdata('admin_info')) {

			$datestring = 'Year: %Y Month: %m Day: %d - %h:%i %a';
			$time = time();
			$dateTime = mdate($datestring, $time);

			$input0 = $this->input->post('pID');
			$input1 = $this->input->post('pname');
			$input2 = $this->input->post('pcategory');
			$input3 = $this->input->post('pdesc');
			$input4 = $this->input->post('pquantity');
			$input5 = $this->input->post('pprice');
			$input6 = $this->input->post('psku');
			$input7 = $this->input->post('pstatus');

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = 1000;
			$config['max_width'] = 10240;
			$config['max_height'] = 7680;

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('uploadimg')) {
				$error = array('error' => $this->upload->display_errors());
				echo "Upload Failed";
				// $this->load->view('productupdate', $error);
			} else {
				$input7 = $this->upload->data('file_name');
				$this->admin->setProductID($input0);
				$this->admin->setPDName($input1);
				$this->admin->setPDCategory($input2);
				$this->admin->setPDDescription($input3);
				$this->admin->setPQuantity($input4);
				$this->admin->setPPrice($input5);
				$this->admin->setPSku($input6);
				$this->admin->setStatus($input7);

				$this->admin->setPImage($input7);
				$this->admin->setPDateUpdated($dateTime);

				$this->admin->update_PTable();
				$this->admin->update_PDTable();

				redirect('index');
			}

		} else {
			redirect('adminlogin');
		}
	}

	public function deleteproduct() {
		if ($this->session->has_userdata('admin_info')) {
			$pID = $this->input->post('p_id');
			$this->admin->setProductID($pID);
			$this->admin->delete_PTable();
			$this->admin->delete_PDTable();
		} else {
			redirect('adminlogin');
		}

	}

	public function adminDashboard() {
		if ($this->session->has_userdata('admin_info')) {
			$data['total_orders_no'] = $this->admin->get_total_orders_no();
			$data['orders_delivered_no'] = $this->admin->get_orders_delivered_no();
			$data['orders_pending_no'] = $this->admin->get_orders_pending_no();
			$data['last_five_customers'] = $this->admin->get_last_five_customers();
			$data['last_five_orders'] = $this->admin->get_last_five_orders();

			$this->load->view('header');
			$this->load->view('admin_dashboard', $data);
			$this->load->view('footer');
		} else {
			redirect('adminlogin');
		}
	}

	public function getorders() {
		if ($this->session->has_userdata('admin_info')) {

		} else {
			redirect('adminlogin');
		}
	}
	public function confirmorder() {
		if ($this->session->has_userdata('admin_info')) {

		} else {
			redirect('adminlogin');
		}
	}
	public function summary() {
		if ($this->session->has_userdata('admin_info')) {

		} else {
			redirect('adminlogin');
		}

	}
	public function inventory() {
		if ($this->session->has_userdata('admin_info')) {

		} else {
			redirect('adminlogin');
		}

	}
}