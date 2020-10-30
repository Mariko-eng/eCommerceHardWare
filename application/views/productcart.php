

<div style="display: flex; flex-direction:column;align-items: normal;
margin-left:5rem;margin-right: 5rem;">
<?php
if (isset($_SESSION["cart_data"])) {
	echo "SHOPPING CART!";
	if (!empty($_SESSION["cart_data"])) {
		$v = $_SESSION["cart_data"];
		$sub_total = 0;
		foreach ($v as $k) {
			$sub_total = $sub_total + ($k["Price"] * $k["Quantity"]);
			# code...
			echo "<div style='border-top:3px solid khaki; border-bottom:3px solid aliceblue;
			min-height:120px; margin-top:0.2rem; margin-bottom:0.2rem; padding:10px; border-radius:5%;'>";
			echo "<p class='itm' style='margin-bottom:0;margin-top:0;'>";
			echo $k['Name'];
			echo "</p>";
			echo "<p style='margin-bottom:0;margin-top:0;'>";
			echo $k["Category"];
			echo "</p>";
			echo "<p style='margin-bottom:0;margin-top:0;'>";
			echo "Price : ";
			echo $k["Price"];
			echo "</p>";
			echo "SUB_TOTAL : ";
			echo $sub_total;
			echo "</p>";

			echo "<div style='display:flex;'>";
			echo "<form class='update-quantity-form'>";
			echo "<div class='product-id' style='display:none;'>";
			echo $k['ProductID'];
			echo "</div>";
			echo "<input type='number' name='quantity'
		value='{$k["Quantity"]}' class = 'cart-quantity'
		min='1' style='width: 70px;text-align: center;'/>";
			echo "<button type='submit'>Update</button>";
			echo "</form>";

			$n = array_search($k, $v);
			echo "<p style='margin-left:5px; border:1px solid blue;
		margin-bottom:0;margin-top:0; border-radius:15%;'><a href = ";
			echo '"';
			echo site_url("/deletecartitem/{$n}");
			echo '"';
			echo ">Delete</a></p>";
			echo "</div>";
			echo "</div>";
		}
	}
	echo "<h1>";
	echo "TOTAL : ";
	echo $sub_total;
	echo "</h1>";

	echo "<div>";
	echo form_open('makeorder');
	echo "<input type ='hidden' name='totalInvoice' value='{$sub_total}'/>";
	echo "<button type='submit'
	style='background-color:blue; margin:5px; min-height:2rem;
	border:1px solid blue; border-radius:10%;'>
	Proceed To Make Order</button>";
	echo "</form>";
	echo "</div>";

} else {
	echo "<h1>Your Shopping Cart Is Empty</h1>";
}

?>
</div>


<script type="text/javascript">
	$('.update-quantity-form').on('submit', function(){
    	var id = $(this).find('.product-id').text();
    	var quantity = $(this).find('.cart-quantity').val();

     alert(id +"   " + quantity);

    $.ajax({
         type: "POST",
         url: "<?php echo base_url("customer/update_cart_item"); ?>",
         data:{pID: id, qty:quantity},
         // dataType: "text",
         cache:false,
         success:
              function(){
              	alert("UPDATED");
              }
          });
});
</script>
