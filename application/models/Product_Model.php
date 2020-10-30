<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Product_Model extends CI_Model {
	private $_productID;
	private $_productName;
	private $_price;
	private $_qty;
	private $_slug;
	private $_subTotal;
	private $_status;
	private $_limit;
	private $_pageNumber;
	private $_offset;
	private $_orderID;
	private $_invoiceNo;
	private $_customerID;
	private $_firstName;
	private $_lastName;
	private $_email;
	private $_phone;
	private $_paymentMethod;
	private $_paymentAddress;
	private $_total;
	private $_orderStatusID;
	private $_timeStamp;
	private $_batchData;

	public function setProductID($productID) {
		$this->_productID = $productID;
	}

	public function setProductName($productName) {
		$this->_productName = $productName;
	}
	public function setPrice($price) {
		$this->_price = $price;
	}
	public function setQty($qty) {
		$this->_qty = $qty;
	}

	public function setSlug($slug) {
		$this->_slug = $slug;
	}

	public function getSlug() {
		return $this->_slug;
	}

	public function setSubTotal($subTotal) {
		$this->_subTotal = $subTotal;
	}
	public function setStatus($status) {
		$this->_status = $status;
	}

	/////
	public function getStatus() {
		return $this->_status;
	}
	////

	public function setLimit($limit) {
		$this->_limit = $limit;
	}
	public function setPageNumber($pageNumber) {
		$this->_pageNumber = $pageNumber;
	}
	public function setOffset($offset) {
		$this->_offset = $offset;
	}
	public function setOrderID($orderID) {
		$this->_orderID = $orderID;
	}
	public function setInvoiceNo($invoiceNo) {
		$this->_invoiceNo = $invoiceNo;
	}
	public function setCustomerID($customerID) {
		$this->_customerID = $customerID;
	}
	public function setFirstName($firstName) {
		$this->_firstName = $firstName;
	}
	public function setLastName($lastName) {
		$this->_lastName = $lastName;
	}
	public function setEmail($email) {
		$this->_email = $email;
	}
	public function setPhone($phone) {
		$this->_phone = $phone;
	}
	public function setPaymentMethod($paymentMethod) {
		$this->_paymentMethod = $paymentMethod;
	}
	public function setPaymentAddress($paymentAddress) {
		$this->_paymentAddress = $paymentAddress;
	}
	public function setTotal($total) {
		$this->_total = $total;
	}
	public function setOrderStatusID($orderStatusID) {
		$this->_orderStatusID = $orderStatusID;
	}
	public function setTimeStamp($timeStamp) {
		$this->_timeStamp = $timeStamp;
	}
	public function setBatchData($batchData) {
		$this->_batchData = $batchData;
	}

	// count all product
	public function getAllProductCount() {
		// $query = $this->db->where('status', $this->_status)
		// 	->from('products')
		// 	->count_all_results();
		// return $query;
		$x = $this->_status;
		$this->db->where('status', $x);
		$this->db->from('products');
		return $this->db->count_all_results();
		// $query = $this->db->get('products');
		// return $query->num_rows();
	}

	// Get all details ehich store in "products" table in database.
	public function getProductList_bind() {
		$query = $this->db->select(array('p.product_id', 'pd.name', 'pd.slug', 'p.sku',
			'p.price', 'pd.description', 'p.image'))
			->from('products as p')
			->join('product_desc as pd', 'pd.product_id = p.product_id', 'inner')
			->where('p.status', $this->_status)
			->limit($this->_pageNumber, $this->_offset)
			->get();
		return $query->result_array();
	}

	// get resource centre items
	public function getProduct() {
		$this->db->select(array('p.product_id', 'pd.name', 'p.sku', 'p.price', 'pd.description', 'p.image'));
		$this->db->from('products as p');
		$this->db->join('product_desc as pd', 'pd.product_id = p.product_id', 'left');
		if (!empty($this->_productID)) {
			$this->db->where('p.product_id', $this->_productID);
		}
		if (!empty($this->_slug)) {
			$this->db->where('pd.slug', $this->_slug);
		}
		$query = $this->db->get();
		return $query->row_array();
	}

	// order now
	public function createOrder() {
		$data = array(
			'invoice_no' => $this->_invoiceNo,
			'customer_id' => $this->_customerID,
			'firstname' => $this->_firstName,
			'lastname' => $this->_lastName,
			'email' => $this->_email,
			'phone' => $this->_phone,
			'payment_address' => $this->_paymentAddress,
			'payment_method' => $this->_paymentMethod,
			'total' => $this->_total,
			'order_status_id' => $this->_orderStatusID,
			'date_added' => $this->_timeStamp,
			'date_modified' => $this->_timeStamp,
		);
		$this->db->insert('orders', $data);
		return $this->db->insert_id();
	}
	// count Invoice
	public function countInvoice() {
		$this->db->from('orders');
		return $this->db->count_all_results();
	}
	// add order product item
	public function addOrderItem() {
		$data = $this->_batchData;
		$this->db->insert_batch('orders_product', $data);
	}
	// create customer
	public function createCustomer() {
		$data = array(
			'firstname' => $this->_firstName,
			'lastname' => $this->_lastName,
			'email' => $this->_email,
			'phone' => $this->_phone,
			'status' => 1,
			'date_added' => $this->_timeStamp,
		);
		$this->db->insert('customer', $data);
		return $this->db->insert_id();
	}

	// email validation
	public function validateEmail($email) {
		return preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email) ? TRUE : FALSE;
	}

	// mobile validation
	public function validateMobile($mobile) {
		return preg_match('/^[0-9]{10}+$/', $mobile) ? TRUE : FALSE;
	}

}