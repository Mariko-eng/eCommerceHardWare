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

	public function mylogin() {
		if ($this->input->post('loginSubmit')) {
			$user = $this->input->post('username');
			$passwrd = $this->input->post('passwrd');
			// echo $user;
			// echo $passwrd;
			$this->customer->setName($user);
			$this->customer->setPass($passwrd);

			$_user = $this->customer->getUser();
			// echo var_dump($user);
			if (!empty($_user)) {
				$loginDetailSession = array('fname' => $_user['firstname'], 'lname' => $_user['lastname'],
					'mail' => $_user['email'], 'telephone' => $_user['phone'],
					'customerID' => $_user['customer_id']);
				$this->session->set_userdata('userinfo', $loginDetailSession);
				redirect('ezimba/welcome');
			} else {
				$data['loginFailed'] = 'Incorrect UserName And Password';
				$this->load->view('login', $data);
			}
		} else {
			$this->load->view('login');
		}
	}

	public function mylogout() {
		if ($this->session->has_userdata('userinfo')) {
			$this->session->sess_destroy();
			redirect('ezimba/welcome');
		}
	}

	public function myindex() {
		//New Home Page
		$this->customer->setStatus(1);
		$data['results'] = $this->customer->getSampleProductsForHome();

		$this->load->view('customer_views/new', $data);

	}

	public function myproducts() {
		//New All PRoducts Page
		$data = array();
		$data['title'] = 'Product | eZimba';
		$config['base_url'] = base_url() . 'customer/myproducts/';
		$this->customer->setStatus(1);
		$rows = $this->customer->getAllProductCount();
		$config['total_rows'] = $rows;

		$config['per_page'] = 12;
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

		$this->load->view('customer_views/new_products', $data);
	}

	public function myproduct($attr) {
		//New Single PRoducts Page
		$this->customer->setProductID($attr);
		$__item = $this->customer->get_singleproduct();
		$this->customer->setPDCategory($__item['category']);
		$__4_items = $this->customer->getProductsForSingleProduct();
		// echo var_dump($__4_items);
		$data['item'] = $__item;
		$data['items4'] = $__4_items;
		$this->load->view('customer_views/myheader_myproduct');
		$this->load->view('customer_views/commonheader');
		$this->load->view('customer_views/mysingleproduct', $data);
		$this->load->view('customer_views/myfooter_myproduct');
	}

	public function mycartitems() {
		//New Cart Page
		$this->load->view('customer_views/new_carts');
	}

	public function add_new_cart_item() {
		//New Cart Page
		$p = $this->input->post("pID");
		$this->customer->setProductID($p);
		$__item = $this->customer->get_singleproduct();
		$item = $__item['name'];
		$cartArray = array(
			$item => array(
				"Name" => $__item['name'],
				"Price" => $__item['price'],
				"Category" => $__item['category'],
				"Image" => $__item['image'],
				"ProductID" => $__item['product_id'],
				"Quantity" => 1,
				"sub_total" => 1 * $__item['price']),
		);
		$_cartData = $this->session->userdata('cart_data');
		if (empty($_cartData)) {
			$this->session->set_userdata('cart_data', $cartArray);
			$this->session->set_userdata('cartstatus', "ADDED TO CART");
		} else {
			$arr_keys = array_keys($_cartData);
			if (in_array($item, $arr_keys)) {
				$this->session->set_userdata('cartstatus', "ADDED TO CART ALREADY!");
			} else {
				$this->session->set_userdata('cart_data', array_merge($_SESSION['cart_data'], $cartArray));
				$this->session->set_userdata('cartstatus', "ADDED TO CART");
			}
		}
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('status' => $_SESSION['cartstatus'],
				'no_of_cartItems' => count($_SESSION['cart_data']),
			)));
	}

	public function update_cart_item_qty() {
		$item = $this->input->post('PID');
		$qty = $this->input->post('Qty');

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
				"Quantity" => $qty,
				"sub_total" => $qty * $__item['price']),
		);

		$this->session->set_userdata('cart_data', array_merge($_SESSION['cart_data'], $cartArray));
	}

	public function remove_item_from_cart() {
		$product = $this->input->post('prod');
		unset($_SESSION['cart_data'][$product]);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('isdelete' => 'DELETED')));
	}

	public function myproductcheckout() {
		//New PRoduct Checkout Page
		if ($this->session->has_userdata('cart_data')) {
			if (!empty($_SESSION['cart_data'])) {
				if ($this->session->has_userdata('userinfo')) {
					$cart = $_SESSION['cart_data'];
					$total = 0;
					foreach ($cart as $cart_item) {
						$total = $total + $cart_item['sub_total'];
					}
					$data['full_total'] = $total;
					$this->load->view('customer_views/new_checkout', $data);
				} else {
					return redirect('ezimba/login');
				}
			} else {
				return redirect('ezimba/allproducts');
			}
		} else {
			return redirect('ezimba/allproducts');
		}
	}

	public function place_order() {
		$Ordered_items = $_SESSION["cart_data"];
		$orderProductID = random_string('alnum', 32);
		$this->customer->setOrderProductID($orderProductID);

		foreach ($Ordered_items as $k) {
			// Orders Product Data
			$this->customer->setProductID($k['ProductID']);
			$this->customer->setPDName($k['Name']);
			$this->customer->setPPrice($k['Price']);
			$this->customer->setPDCategory($k['Category']);
			$this->customer->setPQuantity($k['Quantity']);

			$this->customer->updateOPTable();
		}
		// Orders Data
		$total_of_invoice = $this->input->post('full_total');
		$paymentMethod = $this->input->post('radio_payment');
		$checkout_city = $this->input->post('checkout_city');
		$checkout_address = $this->input->post('checkout_address');
		$checkout_company = $this->input->post('checkout_company');
		$location = $checkout_city . " " . $checkout_address . " " . $checkout_company;

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
		$this->customer->setTotalOrder($total_of_invoice);
		$this->customer->setDateAdded($orderDate);

		$this->customer->updateOrdersTable();

		unset($_SESSION['cart_data']);

		$this->load->view('customer_views/new_order_succeed');
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
}