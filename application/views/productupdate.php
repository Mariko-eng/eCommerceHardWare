<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div style="width: 100%; display: flex; flex-direction:column;
align-items: center;">
	<h1>
		Update Product
	</h1>
	<div style="padding-right:3rem padding-left:3rem;">
		<?php echo form_open_multipart('admin/updateProductReal'); ?>

		<input type = "hidden" name="pID" value="<?php echo $item['product_id']; ?>"/>

		<h2 style="color: crimson;">Product Name</h2>
		<input type = "text" name="pname" value="<?php echo $item['name']; ?>" style="width: 500px; color: crimson;" autocomplete="OFF" />
		<h2 style="color: crimson;">Product Category</h2>
		<input type = "text" name="pcategory" value="<?php echo $item['category']; ?>" style="width: 500px; color: crimson;" autocomplete="OFF" />
		<h2 style="color: crimson;">Product Description</h2>
		<textarea name="pdesc" style="width: 500px; color: crimson;" rows="7" autocomplete="OFF"><?php echo $item['description']; ?></textarea>
		<h2 style="color: crimson;">Product Quantity</h2>
		<input type = "number" name="pquantity" value="<?php echo $item['quantity']; ?>" style="width: 500px; color: crimson;" autocomplete="OFF" />
		<h2 style="color: crimson;">Product Price</h2>
		<input type = "number" name="pprice" value="<?php echo $item['price']; ?>" style="width: 500px; color: crimson;" autocomplete="OFF" />
		<h2 style="color: crimson;">Product SKU</h2>
		<input type = "text" name="psku" value="<?php echo $item['SKU']; ?>" style="width: 500px; color: crimson;" autocomplete="OFF" />
		<h2 style="color: crimson;">Product Status</h2>
		<input type = "text" name="pstatus" value="<?php echo $item['status']; ?>" style="width: 500px; color: crimson;" autocomplete="OFF" />
		<h2 style="color: crimson;">Product Image</h2>
		<input type="file" name="uploadimg" size="1000" required/>
		<br/><br/>
		<button type="submit" name ="pupdate" value ="update">UPDATE PRODUCT</button>
		</form>
	</div>
	<div>
		<?php
if (isset($_SESSION['name'])) {
	echo anchor('logout', 'LOGOUT Shaaaaaa', 'title="Logout shitttttt!"');
}
?>
	</div>
</div>