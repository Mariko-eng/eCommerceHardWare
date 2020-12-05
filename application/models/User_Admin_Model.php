<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class User_Admin_Model extends CI_Model {
	private $_name;
	private $_password;
	private $_productID;
	private $_status;
	private $_pageNumber;
	private $_offset;
	private $_search;
	private $_p_sku;
	private $_p_quantity;
	private $_p_image;
	private $_p_price;
	private $_p_dateUpdated;
	private $_pd_name;
	private $_pd_category;
	private $_pd_description;

	private $__order_id;
	private $__invoice_no;
	private $__customer_id;
	private $__firstname;
	private $__lastname;
	private $__email;
	private $__phone;
	private $__paymentAddr;
	private $__paymentMthd;
	private $__total_Order;
	private $__dateAdded;
	private $__order_productID;
	private $__pd_id;
	private $__orderStatus = 'DELIVERED';

	public function setOrderID($attr) {
		$this->__order_id = $attr;
	}
	public function setInvoiceNo($attr) {
		$this->__invoice_no = $attr;
	}
	public function setFirstName($attr) {
		$this->__firstname = $attr;
	}
	public function setLastName($attr) {
		$this->__lastname = $attr;
	}
	public function setEmail($attr) {
		$this->__email = $attr;
	}
	public function setPhone($attr) {
		$this->__phone = $attr;
	}
	public function setCustomerID($attr) {
		$this->__customer_id = $attr;
	}
	public function setPaymentAddr($attr) {
		$this->__paymentAddr = $attr;
	}
	public function setPaymentMthd($attr) {
		$this->__paymentMthd = $attr;
	}
	public function setTotalOrder($attr) {
		$this->__total_Order = $attr;
	}
	public function setDateAdded($attr) {
		$this->__dateAdded = $attr;
	}
	public function setOrderProductID($attr) {
		$this->__order_productID = $attr;
	}
	public function setName($attr) {
		$this->_name = $attr;
	}
	public function setPass($attr) {
		$this->_password = $attr;
	}
	public function setProductID($attr) {
		$this->_productID = $attr;
	}
	public function setSearch($attr) {
		$this->_search = $attr;
	}
	public function setPageNumber($attr) {
		$this->_pageNumber = $attr;
	}
	public function setOffset($offset) {
		$this->_offset = $offset;
	}
	public function setPDCategory($attr) {
		$this->_pd_category = $attr;
	}

	public function getUser() {
		$query = $this->db->where('firstname', $this->_name)
			->where('password', $this->_password)
			->from('customer')
			->get();
		return $query->row_array();
	}
	// count all products
	public function getAllProductCount() {
		$query = $this->db->select(array('pd.name'))
			->from('products as p')
			->join('product_desc as pd', 'pd.product_id = p.product_id', 'inner')
		// ->where('p.status', $this->_status)
			->where('p.status >=', 0)
			->get();
		return $query->num_rows();

	}
	public function getSampleProductsForHome() {
		$query = $this->db->select(array('pd.name', 'pd.category', 'p.image', 'p.product_id', 'p.SKU', 'p.price'))
			->from('products as p')
			->join('product_desc as pd', 'p.product_id = pd.product_id', 'inner')
		// ->where('p.status', $this->_status)
		//	->where('p.status >=', 0)
			->limit(8)
			->get();
		return $query->result_object();
	}

	public function getAllProducts() {
		$query = $this->db->select(array('pd.name', 'pd.category', 'p.image', 'p.product_id', 'p.SKU', 'p.price'))
			->from('products as p')
			->join('product_desc as pd', 'p.product_id = pd.product_id', 'inner')
		// ->where('p.status', $this->_status)
		//	->where('p.status >=', 0)
			->limit($this->_pageNumber, $this->_offset)
			->get();
		return $query->result_object();
	}

	public function getProductsForSingleProduct() {
		$query = $this->db->select(array('pd.name', 'pd.category', 'p.image', 'p.product_id', 'p.SKU', 'p.price'))
			->from('products as p')
			->join('product_desc as pd', 'p.product_id = pd.product_id', 'inner')
			->where('pd.category', $this->_pd_category)
			->get();
		return $query->result_object();
	}

	public function get_singleproduct() {
		$query = $this->db->select(array('pd.name', 'pd.description', 'pd.category',
			'p.image', 'p.product_id', 'p.SKU', 'p.price', 'p.quantity', 'p.status'))
			->from('products as p')
			->join('product_desc as pd', 'pd.product_id = p.product_id', 'inner')
			->where('pd.product_id', $this->_productID)
			->get();
		return $query->row_array();
	}

	public function search_like() {
		$result = $this->db->select(array('pd.name'))
			->from('products as p')
			->join('product_desc as pd', 'pd.product_id = p.product_id', 'inner')
			->like('pd.name', $this->_search)
			->get();
		return $result->result_object();
	}

	// ADMINISTRATION WORK
	// GET ADMIN DETAILS

	public function setStatus($attr) {
		$this->_status = $attr;
	}

	public function setPSku($attr) {
		$this->_p_sku = $attr;
	}

	public function setPQuantity($attr) {
		$this->_p_quantity = $attr;
	}

	public function setPImage($attr) {
		$this->_p_image = $attr;
	}

	public function setPPrice($attr) {
		$this->_p_price = $attr;
	}

	public function setPDateUpdated($attr) {
		$this->_p_dateUpdated = $attr;
	}

	public function setPDName($attr) {
		$this->_pd_name = $attr;
	}

	public function setPDDescription($attr) {
		$this->_pd_description = $attr;
	}

	public function getAdmin() {
		$query = $this->db->where('ad_name', $this->_name)
			->where('ad_password', $this->_password)
			->from('admin_accounts')
			->get();
		return $query->row_array();
	}

	// count all products
	public function getAllProductCountAdmin() {
		$query = $this->db->select(array('pd.name'))
			->from('products as p')
			->join('product_desc as pd', 'pd.product_id = p.product_id', 'inner')
			->where('p.status >=', 0)
			->get();
		return $query->num_rows();

	}
	public function getAllProductsAdmin() {
		$query = $this->db->select(array('pd.name', 'pd.category', 'p.image', 'p.product_id', 'p.SKU', 'p.price'))
			->from('products as p')
			->join('product_desc as pd', 'p.product_id = pd.product_id', 'inner')
			->limit($this->_pageNumber, $this->_offset)
			->get();
		return $query->result_object();
	}

	public function get_last_ProductID() {
		$query = $this->db->select('product_id')
			->from('products')
			->get();
		return $query->last_row();
	}

	public function add_NewProduct() {
		$data_P = array(
			'product_id' => $this->_productID,
			'SKU' => $this->_p_sku,
			'quantity' => $this->_p_quantity,
			'image' => $this->_p_image,
			'price' => $this->_p_price,
			'status' => $this->_status,
		);

		$data_PD = array(
			'product_id' => $this->_productID,
			'name' => $this->_pd_name,
			'category' => $this->_pd_category,
			'description' => $this->_pd_description,
		);

		$this->db->insert('products', $data_P);
		$this->db->insert('product_desc', $data_PD);
	}

	public function update_PTable() {
		$data_P = array(
			'SKU' => $this->_p_sku,
			'quantity' => $this->_p_quantity,
			'image' => $this->_p_image,
			'price' => $this->_p_price,
			'status' => $this->_status,
			'date_updated' => $this->_p_dateModified,
		);
		$this->db->where('product_id', $this->_productID);
		$this->db->update('products', $data_P);
	}

	public function update_PDTable() {
		$data_PD = array(
			'name' => $this->_pd_name,
			'category' => $this->_pd_category,
			'description' => $this->_pd_description,
		);
		$this->db->where('product_id', $this->_productID);
		$this->db->update('product_desc', $data_PD);
	}

	public function delete_PTable() {
		$this->db->where('product_id', $this->_productID);
		$this->db->delete('products');
	}

	public function delete_PDTable() {
		$this->db->where('product_id', $this->_productID);
		$this->db->delete('product_desc');
	}

	public function updateOrdersTable() {
		$data_Orders = array(
			'invoice_no' => $this->__invoice_no,
			'customer_id' => $this->__customer_id,
			'firstname' => $this->__firstname,
			'lastname' => $this->__lastname,
			'email' => $this->__email,
			'phone' => $this->__phone,
			'payment_address' => $this->__paymentAddr,
			'payment_method' => $this->__paymentMthd,
			'total' => $this->__total_Order,
			'date_added' => $this->__dateAdded,
			'orders_product_id' => $this->__order_productID,
			'order_status' => 'PENDING',
		);
		$this->db->insert('orders', $data_Orders);

	}

	public function updateOPTable() {
		$data_OProduct = array(
			'orders_product_id' => $this->__order_productID,
			'productID' => $this->_productID,
			'name' => $this->_pd_name,
			'price' => $this->_p_price,
			'category' => $this->_pd_category,
			'quantity' => $this->_p_quantity,
			// 'orders_product_id' => $this->__order_productID,
		);

		$this->db->insert('ordersProduct', $data_OProduct);
	}

	public function get_total_orders_no() {
		$query = $this->db->select(array('o.invoice_no'))
			->from('orders as o')
			->get();
		return $query->num_rows();
	}

	public function get_orders_delivered_no() {
		$query = $this->db->select(array('o.invoice_no'))
			->from('orders as o')
			->where('o.order_status', $this->__orderStatus)
			->get();
		return $query->num_rows();
	}

	public function get_orders_pending_no() {
		$query = $this->db->select(array('o.invoice_no'))
			->from('orders as o')
			->where('o.order_status', 'PENDING')
			->get();
		return $query->num_rows();
	}

	public function get_last_five_customers() {
		$query = $this->db->select(array('c.firstname'))
			->from('customer as c')
			->get();
		$total_customers = $query->num_rows();

		if ($total_customers > 5) {
			$total_customers_minus5 = $total_customers - 5;
		} else {
			$total_customers_minus5 = 0;
		}

		// $query = $this->db->select(array('c.firstname', 'c.lastname', 'c.phone'))
		// 	->from('customer as c')
		// // ->limit($total_customers_minus5, $total_customers)
		// //	->limit(0, 5)
		// 	->get();
		// return $query->result_object();
		$query = $this->db->get('customer', $total_customers_minus5, $total_customers);
		return $query->result_object();
	}

	public function get_all_customers() {
		$query = $this->db->select(array('c.firstname', 'c.lastname', 'c.phone'))
			->from('customer as c')
			->get();
		return $query->result_object();
	}

	public function get_last_five_orders() {
		$total_rws = $this->get_total_orders_no();
		if ($total_rws > 5) {
			$total_rws_minus5 = $total_rws - 5;
		} else {
			$total_rws_minus5 = 0;
		}
		$query = $this->db->get('orders', $total_rws_minus5, $total_rws);
		return $query->result_object();
	}

	public function get_all_orders() {
		$query = $this->db->select(array('op.name', 'o.date_added', 'o.order_status'))
			->from('orders as o')
			->join('ordersProduct as op', 'o.orders_product_id = op.orders_product_id', 'inner')
			->get();
		return $query->result_object();
	}

}