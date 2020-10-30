<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Customer extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->library('calendar');
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->helper('string');
		$this->load->model('User_Admin_Model', 'customer');
	}

	public function index() {
		// GETTING ALL PRODUCTS
		$data = array();
		$data['title'] = 'Product | eZimba';
		$config['base_url'] = base_url() . 'customer/index/';
		$this->customer->setStatus(1);
		$rows = $this->customer->getAllProductCount();
		$config['total_rows'] = $rows;

		$config['per_page'] = 2;
		$config['ur1_segment'] = 3;

		if (empty($this->uri->segment(3))) {
			$page_number = 0;
		} else {
			$page_number = $this->uri->segment(3);
		}
		$offset = ($page_number - 1) * $this->pagination->per_page;
		$this->customer->setPageNumber($config['per_page']);
		$this->customer->setOffset($page_number);
		$this->pagination->initialize($config);

		$data['page_links'] = $this->pagination->create_links();
		$data['results'] = $this->customer->getAllProducts();
		// echo var_dump($data['results']);
		$this->load->view('header');
		$this->load->view('productlist', $data);
		$this->load->view('footer');
	}

	public function home() {
		if ($this->session->has_userdata('userinfo')) {
			$data['loginDetails'] = $this->session->userdata('userinfo');
			$this->load->view('home', $data);
		} else {
			$this->load->view('home');
		}
	}

	public function login() {
		if ($this->input->post('loginSubmit')) {
			$user = $this->input->post('username');
			$passwrd = $this->input->post('passwrd');
			echo $user;
			echo $passwrd;
			$this->customer->setName($user);
			$this->customer->setPass($passwrd);

			$_user = $this->customer->getUser();
			echo var_dump($user);
			if (!empty($_user)) {
				$loginDetailSession = array('fname' => $_user['firstname'], 'lname' => $_user['lastname'],
					'mail' => $_user['email'], 'telephone' => $_user['phone'],
					'customerID' => $_user['customer_id']);
				$this->session->set_userdata('userinfo', $loginDetailSession);
				redirect('products');
			} else {
				$data['loginDetailSession'] = array('error' => 'Incorrect UserName And Password');
				$this->load->view('login', $data);
			}
		} else {
			$this->load->view('login');
		}
	}

	public function logout() {
		if ($this->session->has_userdata('userinfo')) {
			$this->session->sess_destroy();
			echo "Just Logged out";
			redirect('products');
		}
	}

	public function ajax_request() {
		$ans = $this->input->post('textbox');
		if ($ans != "") {
			$this->customer->setSearch($ans);
			$likes = $this->customer->search_like();
			echo "<ul style='padding-left: 0;
    				text-align: center;margin-top: 0;
    				margin-bottom: 0;'>";
			foreach ($likes as $like) {
				echo "<li style='border-bottom: 1px solid blue;
				color:black;
				list-style:none;'>";
				echo $like->name;
				echo "</li>";
			}
			echo "</ul>";
		}
	}

	public function singleproduct($attr) {
		$this->customer->setProductID($attr);
		$__item = $this->customer->get_singleproduct();
		$data['item'] = $__item;
		$this->load->view('header');
		$this->load->view('productdetail', $data);
		$this->load->view('footer');

	}

	public function add_cart_item() {
		$pID = $this->input->post('p_id');
		$this->customer->setProductID($pID);
		$__item = $this->customer->get_singleproduct();
		$item = $__item['name'];

		$cartArray = array(
			$item => array(
				"Name" => $__item['name'],
				"Price" => $__item['price'],
				"Category" => $__item['category'],
				"Image" => $__item['image'],
				"ProductID" => $__item['product_id'],
				"Quantity" => 1),
		);

		$_cartData = $this->session->userdata('cart_data');
		if (empty($_cartData)) {
			$this->session->set_userdata('cart_data', $cartArray);
			$this->session->set_userdata('cartstatus', "Product Is Added");
			redirect('products');
		} else {
			$arr_keys = array_keys($_cartData);
			if (in_array($item, $arr_keys)) {
				$this->session->set_userdata('cartstatus', "Product Already Exists");
				redirect('products');
			} else {
				$this->session->set_userdata('cart_data', array_merge($_SESSION['cart_data'], $cartArray));
				$this->session->set_userdata('cartstatus', "Product Cart Is Updated");
				redirect('products');
			}
		}

	}

	public function update_cart_item() {
		$item = $this->input->post('pID');
		$qty = $this->input->post('qty');

		$this->customer->setProductID($item);
		$__item = $this->customer->get_singleproduct();
		$itempID = $__item['name'];

		$cartArray = array(
			$itempID => array(
				"Name" => $__item['name'],
				"Price" => $__item['price'],
				"Category" => $__item['category'],
				"Image" => $__item['image'],
				"ProductID" => $__item['product_id'],
				"Quantity" => $qty),
		);

		$this->session->set_userdata('cart_data', array_merge($_SESSION['cart_data'], $cartArray));
		echo "<pre>";
		echo var_dump($_SESSION['cart_data']);
		echo "</pre>";
		$this->load->view('header');
		$this->load->view('productcart');
		$this->load->view('footer');
	}

	public function remove_cart_item($attr_index) {
		unset($_SESSION['cart_data'][$attr_index]);
		redirect('displaycartitems');
	}

	public function display_cart() {
		$this->load->view('header');
		$this->load->view('productcart');
		$this->load->view('footer');
	}

	public function checkout() {
		echo "SUBMISSION";
	}

	public function make_order() {
		$data['totalInvoice'] = $this->input->post('totalInvoice');
		$this->load->view('header');
		$this->load->view('markorder', $data);
		$this->load->view('footer');
	}

	public function confirmation_order() {
		$Ordered_items = $_SESSION["cart_data"];
		$orderProductID = random_string('alnum', 32);
		$this->customer->setOrderProductID($orderProductID);

		foreach ($Ordered_items as $k) {
			// Orders Product Data
			$this->customer->setProductID($k['ProductID']);
			$this->customer->setPDName($k['Name']);
			$this->customer->setPDCategory($k['Category']);
			$this->customer->setPPrice($k['Price']);
			$this->customer->setPQuantity($k['Quantity']);

			$this->customer->updateOPTable();
		}
		// Orders Data
		$totalInvoice = $this->input->post('totalInvoice');
		$paymentMethod = $this->input->post('paymentMethod');
		$location_district = $this->input->post('location_district');
		$location_town = $this->input->post('location_town');
		$location_village = $this->input->post('location_village');
		$location = $location_district . $location_town . $location_village;
		$datestring = 'Year: %Y Month: %m Day: %d - %h:%i %a';
		$time = time();
		$dateTime = mdate($datestring, $time);
		$orderDate = (string) $dateTime;

		$iNo = random_string('alnum', 16);
		$this->customer->setInvoiceNo($iNo);
		$this->customer->setCustomerID($_SESSION['userinfo']['customerID']);
		$this->customer->setFirstName($_SESSION['userinfo']['fname']);
		$this->customer->setLastName($_SESSION['userinfo']['lname']);
		$this->customer->setEmail($_SESSION['userinfo']['mail']);
		$this->customer->setPhone($_SESSION['userinfo']['telephone']);
		$this->customer->setPaymentAddr($location);
		$this->customer->setPaymentMthd($paymentMethod);
		$this->customer->setTotalOrder($totalInvoice);
		$this->customer->setDateAdded($orderDate);

		$this->customer->updateOrdersTable();

		$this->load->view('header');
		$this->load->view('orderSuccess');
		$this->load->view('footer');}
}