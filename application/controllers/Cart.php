<?php

/**
 * 
 */
class ClassName extends AnotherClass
{
	
	function __construct(argument)
	{
		# code...
	}

	public function index() {
        $data = array();
        $data['page'] = 'shopping-cart';
        $data['title'] = 'My Cart | TechArise'; 
        $data['breadcrumbs'] = array('Home' => site_url(), 'Cart' => '#');
 
        $data['productInfo'] = $this->cart->contents();
        
        
        $this->load->view('cart/index', $data);
    }
 
    public function single() {
        $data = array();
        $data['page'] = 'shopping-cart';
        $data['title'] = 'Shopping Cart | TechArise'; 
        $data['breadcrumbs'] = array('Shopping Cart' => '#', 'List' => '#');
        $this->load->view('cart/single', $data);
    }
 
    // product add to basket    
    function add() {
        $json = array();
        if (!empty($this->input->post('productID'))) {
            $this->basket->setProductID($this->input->post('productID'));
            $qty = $this->input->post('qty');
            $productInfo = $this->basket->getProduct();
            $cartData = array(
                'id' => $productInfo['product_id'],
                'name' => $productInfo['name'],
                'model' => $productInfo['model'],
                'price' => $productInfo['price'],
                'slug' => $productInfo['slug'],
                'qty' => $qty,
                'image' => $productInfo['image'],
            );
            $this->cart->insert($cartData);
            $json['status'] = 1;
            $json['counter'] = count($this->cart->contents());
        } else {
            $json['status'] = 0;
        }
        header('Content-Type: application/json');
        echo json_encode($json);
    }
 
    // remove cart item
    function remove() {
        $json = array();
        if (!empty($this->input->post('productID'))) {
            $rowid = $this->input->post('productID');
            $data = array(
                'rowid' => $rowid,
                'qty' => 0
            );
            $this->cart->update($data);
        }
        header('Content-Type: application/json');
        echo json_encode($json);
    }
 
    // update cart item
    function update() {
        $json = array();
        if (!empty($this->input->post('productID'))) {
            $rowid = $this->input->post('productID');
            $qty = $this->input->post('qty');
            $data = array(
                'rowid' => $rowid,
                'qty' => $qty
            );
            $this->cart->update($data);
        }
        header('Content-Type: application/json');
        echo json_encode($json);
    }
 
    // checkout item
    function checkout() {
        $data = array();
        $data['metaDescription'] = 'Shopping Cart';
        $data['metaKeywords'] = 'Shopping, Cart';
        $data['title'] = "Shopping Cart - TechArise";
        $data['breadcrumbs'] = array('Home' => site_url(), 'Checkout' => '#');
        $data['productInfo'] = $this->cart->contents();
        $this->load->view('cart/checkout', $data);
    }
 
    //  order now
    public function orderNow() {
            $productInfo = $this->cart->contents();
            $grandTotal = 0;
            $productList = array();
            foreach ($productInfo as $key => $element) {
                $grandTotal += $element['subtotal'];
                $productList[] = array(
                    'id' => $element['id'],
                    'name' => $element['name'],
                    'model' => $element['model'],
                    'price' => $element['price'],
                    'qty' => $element['qty'],
                    'subtotal' => $element['subtotal'],
                );
            }
 
            $customerID = 0;
            $firstname = $this->input->post('firstname');
            $lastname     = $this->input->post('lastname');           
            $email = $this->input->post('email');
            $phone  = $this->input->post('phone');
            $company  = $this->input->post('company');
            $address  = $this->input->post('address');
            $country  = $this->input->post('country');
            $state  = $this->input->post('state');
            $city  = $this->input->post('city');
            $zipcode  = $this->input->post('zipcode');
 
            $timeStamp = time();
            
            // firstname validation
            if(empty(trim($firstname))){
                $json['error']['firstname'] = 'Please enter first name';
            }
            // firstname validation
            if(empty(trim($lastname))){
                $json['error']['lastname'] = 'Please enter last name';
            }
            // email validation
            if(empty(trim($email))){
                $json['error']['email'] = 'Please enter email address';
            }
            // check email validation
            if ($this->basket->validateEmail($email) == FALSE) {
                $json['error']['email'] = 'Please enter valid email address';
            }
            // check conatct no validation
            if($this->basket->validateMobile($phone) == FALSE) {
                $json['error']['phone'] = 'Please enter valid contact no. format: 9000000001';
            }
            // company validation
            if(empty($company)){
                $json['error']['company'] = 'Please enter company';
            }
            if(empty($address)){
                $json['error']['address'] = 'Please enter address name';
            }
            if(empty($address)){
                $json['error']['address'] = 'Please enter address';
            }
            if(empty($country)){
                $json['error']['country'] = 'Please enter country';
            }
            if(empty($state)){
                $json['error']['state'] = 'Please enter state';
            }
            if(empty($city)){
                $json['error']['city'] = 'Please enter city';
            }
            if(empty($zipcode)){
                $json['error']['zipcode'] = 'Please enter zipcode';
            }
 
            if(empty($json['error'])){
                              
                $this->basket->setFirstName($firstname);
                $this->basket->setLastName($lastname);
                $this->basket->setEmail($email);
                $this->basket->setPhone($phone);
                $this->basket->setTimeStamp($timeStamp);
                // create customer
                $customerID = $this->basket->createCustomer();
 
                $this->basket->setCustomerID($customerID);
                $countInvoice = $this->basket->countInvoice();
                $fullInvoice = 'INV-' . str_pad($countInvoice + 1, 4, '0', STR_PAD_LEFT);
 
                $this->basket->setInvoiceNo($fullInvoice);
                $this->basket->setInvoicePrefix('INV');  
 
                $this->basket->setPaymentFirstName($firstname);
                $this->basket->setPaymentLastName($lastname);
                $this->basket->setPaymentCompany($company);
                $this->basket->setPaymentAddress($address);
                $this->basket->setPaymentCity($city);
                $this->basket->setPaymentPostCode($zipcode);
                $this->basket->setPaymentCountry($country);
                $this->basket->setPaymentState($state);
                $this->basket->setPaymentMethod('COD');
                $this->basket->setPaymentCode('COD');
                $this->basket->setComment('note');
                $this->basket->setTotal($grandTotal);
                $this->basket->setOrderStatusID(1);
                $this->basket->setCurrencyID(1);
                $this->basket->setCurrencyCode('USD');
                $this->basket->setCurrencyValue('0.000000000');
                try {
                 $last_id = $this->basket->createOrder();
                } catch (Exception $e) {
                    var_dump($e->getMessage());
                }
 
                if(!empty($last_id)) {
                    foreach ($productList as $key => $element) {
                        $batch[] = array(
                            'order_id' => $last_id,
                            'product_id' => $element['id'],
                            'model' => $element['model'],
                            'quantity' => $element['qty'],
                            'price' => $element['price'],
                            'total' => $element['subtotal'], 
                        );
                    }
                    $this->basket->setBatchData($batch);
                    $this->basket->addOrderItem();
                    $this->session->unset_userdata('cart_contents');
                }
 
                if (!empty($last_id) && $last_id > 0) {
                    $orderID = str_pad($last_id, 4, '0', STR_PAD_LEFT);
                    $json['order_id'] = $orderID;
                    $json['status'] = 'success';
                }
            }
            $this->output->set_header('Content-Type: application/json');
            echo json_encode($json);
    }
        // checkout item
    function success() {
        $data = array();
        $data['metaDescription'] = 'Shopping Cart';
        $data['metaKeywords'] = 'Shopping, Cart';
        $data['title'] = "Shopping Cart - TechArise";
        $data['breadcrumbs'] = array('Home' => site_url(), 'Success' => '#');
        $order_id = $this->input->get('order_id');
        $data['order_id'] = $order_id;
        $this->load->view('cart/success', $data);
    }
}