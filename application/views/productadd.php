<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div style="width: 100%; display: flex; flex-direction:column;
align-items: center;">
<?php
if (isset($status)) {
	echo "<h1 style='color: darkcyan;'>Item is Added</h1>";
	echo "<h1 style='color: darkcyan;'>Add Another Product</h1>";
} else {
	echo "<h1 style='color: darkcyan;'>Add NEW Product</h1>";
}
?>
	<div style="width: 600px; padding-right:3rem padding-left:3rem; text-align:center;">
		<?php echo form_open_multipart('admin/newproduct'); ?>
		<h2 style="color: crimson;">Product Name</h2>
		<input type = "text" name="pname" style="width: 500px; color: crimson;" autocomplete="OFF" />
		<h2 style="color: crimson;">Product Category</h2>
		<input type = "text" name="pcategory" style="width: 500px; color: crimson;" autocomplete="OFF" />
		<h2 style="color: crimson;">Product Description</h2>
		<textarea name="pdesc" style="width: 500px; color: crimson;" rows="7" autocomplete="OFF"></textarea>
		<h2 style="color: crimson;">Product Quantity</h2>
		<input type = "number" name="pquantity" style="width: 500px; color: crimson;" autocomplete="OFF" />
		<h2 style="color: crimson;">Product Price</h2>
		<input type = "number" name="pprice" style="width: 500px; color: crimson;" autocomplete="OFF" />
		<h2 style="color: crimson;">Product SKU</h2>
		<input type = "text" name="psku" style="width: 500px; color: crimson;" autocomplete="OFF" />
		<h2 style="color: crimson;">Product Image</h2>
		<input type="file" name="uploadimg" size="1000"/>
		<br/><br/>
		<button type="submit" name ="psubmit" value ="submit" style="color: darkcyan;">ADD PRODUCT</button>
		</form>
	</div>

</div>
