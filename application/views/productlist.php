<div class="plist_super">
	<div class="plist_sidebr">
		<div style="display:flex;flex-direction: column; padding-left: 5rem;">
	<div style="display:flex;flex-direction: column;">
		<h3 class="asd"><a href="#">Main1</a></h3>
		<div class="xx">Sub1</div>
		<div class="xx">Sub11</div>
	</div>
	<div style="display:flex;flex-direction: column;">
		<h3 class="asd1"><a href="#">Main2</a></h3>
		<div class="xx1">Sub2</div>
		<div class="xx1">Sub22</div>
	</div>
	<div style="display:flex;flex-direction: column;">
		<h3 class="asd2"><a href="#">Main3</a></h3>
		<div class="xx2">Sub3</div>
		<div class="xx2">Sub33</div>
	</div>
</div>
	</div>
	<div class="plist">
		<div class="plist1">
<?php
foreach ($results as $k) {
	$aa = base_url();
	$bb = 'uploads/';
	$cc = $k->image;
	$dd = $aa . "" . $bb . "" . $cc;

	$vr = '/productdetail/' . 'JERRY';
	echo "
		<div class='card'>
		<h1>{$k->name} </h1>
		<h1>Price : {$k->price} UgShs</h1>";

	echo "<img class='card_img' src='{$dd}' alt='Photo2'/><br>";
	echo "<div style ='display:flex; justify-content:space-around;'>";
	echo "<p><a href = ";
	echo '"';
	echo site_url("/productdetail/{$k->product_id}");
	echo '"';
	echo ">Get To Item</a></p>";

	if (isset($_SESSION['admin_info'])) {
		if (!empty($_SESSION['admin_info'])) {
			// echo "<form class='edit-item-form' style='display:flex;'>";
			echo form_open('admin/updateProductDisplay');
			echo "<input type='hidden' name='productID' value='{$k->product_id}' class='editItem'/>";
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
		echo "<input type='hidden' name = 'p_id' value='{$k->product_id}' class='crt'/>";
		echo "<button type='submit' style ='border:0; color:green; background-color:white;'>ADD TO CART</button>";
		echo "</form>";
	}

	echo "</div>";
	echo "</div>";
}
?>
	</div>
	<div style="margin-top:2rem;margin-left:2rem;">
<?php
if (isset($_SESSION['userinfo'])) {
	echo "<div>";
	echo anchor('customerlogout', 'LOGOUT Already');
	echo "</div>";
}
?>
	</div>
	<div class="lks">
	<?php
// foreach ($page_links as $l) {
// 	echo "<b>";
// 	echo $l;
// 	echo "</b>";
// }
echo "<b>";
echo $page_links;
echo "</b>";
?>
	</div>
	</div>
</div>