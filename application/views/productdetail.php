 <div class="pdetail">
	<div>
<?php
$aa = base_url();
$bb = 'uploads/';
$cc = $item['image'];
$dd = $aa . "" . $bb . "" . $cc;
echo "<img src='{$dd}' alt='Photo2'/><br>";
?>
</div>
<div class="card">
	<h1>Product Information</h1>
<?php
echo "<p> Name : {$item['name']} </p>";
echo "<p> Category : {$item['category']} </p>";
echo "<p> Price : $ {$item['price']} </p>"; ?>
<?php
if (isset($_SESSION['admin_info'])) {
	if (!empty($_SESSION['admin_info'])) {
		echo "<form class='edit-item-form' style='display:flex;'>";
		echo "<input type='hidden' value='{$item['product_id']}' class='editItem'/>";
		echo "<button type='submit' style ='border:0; color:green; background-color:white;'>
		EDIT ITEM DETAILS</button>";
		echo "</form>";

		echo "<form class='delete-item-form' style='display:flex;'>";
		echo "<input type='hidden' value='{$k->product_id}' class='delItem'/>";
		echo "<button type='submit' style ='border:0; color:green; background-color:white;'>
		DELETE ITEM</button>";
		echo "</form>";
	}
} else {
	echo form_open('customer/add_cart_item');
	echo "<form class='add-cart-form' style='display:flex;'>";
	echo "<input type='hidden' name = 'p_id' value='{$item['product_id']}' class='crt'/>";
	echo "<button type='submit' style ='border:0; color:green; background-color:white;'>ADD TO CART</button>";
	echo "</form>";
}

?>
</div>
</div>

<div>
<?php
if (isset($_SESSION['name'])) {
	echo "<p>";
	echo "Data from session :";
	echo $_SESSION['name'];
	echo "</p>";
}?>
</div>

<div>
<?php
if (isset($_SESSION['userinfo'])) {
	echo "<div>";
	echo anchor('customerlogout', 'LOGOUT Already');
	echo "</div>";
}
?>
</div>