<?php

if (!isset($_SESSION['userinfo'])) {
	echo "<p><a href = ";
	echo '"';
	echo site_url("/customerlogin");
	echo '"';
	echo ">First Login TO Make Your Order</a></p>";
} else {
	$userdata = $_SESSION['userinfo'];
	$Ordered_items = $_SESSION["cart_data"];

	echo "<div class='pdetail'>";
	echo "<div style='box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); padding:35px;'>";
	echo "<div class='customer_details'style='border-bottom:3px solid khaki;'>";
	echo "<p>Your Sur Name is : {$userdata['fname']}</p>";
	echo "<p>Your First NAme : {$userdata['lname']}</p>";
	echo "<p>Your Email is : {$userdata['mail']}</p>";
	echo "<p>Your Phone Number : {$userdata['telephone']}</p>";
	echo "</div>";

	echo "<div class='Ordered_items'>";
	$sub_total2 = 0;
	foreach ($Ordered_items as $k) {
		$sub_total2 = $sub_total2 + ($k["Price"] * $k["Quantity"]);
		echo "<div>";
		echo "<p>Item Name : {$k['Name']}</p>";
		echo "<p>Item Price : {$k['Price']} </p>";
		echo "<p>Quantity : {$k['Quantity']} </p>";
		echo "<p>Cumlative Total : {$sub_total2}</p>";
		echo "</div>";
	}
	echo "</div>";
	echo "ka total keeko : {$totalInvoice}";

	echo "<div class='confirm_order'>";
	echo "<h2 style='border-top: 3px solid blue; padding: 5px;'>CONFIRM ORDER</h2>";
	echo form_open('customer/confirmation_order');

	$itemNo = 0;
	foreach ($Ordered_items as $k) {
		echo "<input type ='hidden' name = 'itemName'.$itemNo value='{$k['Name']}'/>";
		echo "<input type ='hidden' name = 'itemName'.$itemNo value='{$k['Price']}'/>";
		echo "<input type ='hidden' name = 'itemName'.$itemNo value='{$k['Quantity']}'/>";
	}
	echo "<input type ='hidden' name='totalInvoice' value='{$totalInvoice}'/>";

	echo "<p> Enter District Name</p>";
	echo "<input type ='text' name='location_district'/>";
	echo "<p> Enter Town/Sub County Name</p>";
	echo "<input type ='text' name='location_town'/>";
	echo "<p> Enter Village Name</p>";
	echo "<input type ='text' name='location_village'/>";
	echo "<p>Payment Method : <span>MOBILE MONEY</span></p>";
	echo "<input type ='hidden' name='paymentMethod' value='Mobile Money'/>";

	echo "<button type='submit'
	style='background-color:blue; margin:5px; min-height:2rem;
	border:1px solid blue; border-radius:10%;'>
	CONFIRM ORDER</button>";
	echo "</form>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
}

?>