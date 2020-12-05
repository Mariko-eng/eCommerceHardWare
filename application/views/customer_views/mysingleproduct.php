<!-- Home -->
<?php
$aa = base_url();
$bb = 'uploads/';
$cc = $item['image'];
$dd = $aa . "" . $bb . "" . $cc;
?>
	<!-- Product Details -->

	<div class="product_details" style="padding-top: 120px;">
		<div class="container">
			<div class="row details_row">

				<!-- Product Image -->
				<div class="col-lg-6">
					<div class="details_image">
						<div class="details_image_large">
							<img src="<?=$dd?>" alt="">

						</div>
					</div>
				</div>

				<!-- Product Content -->
				<div class="col-lg-6">
					<div class="details_content">
						<div class="details_name"><?=$item['name']?></div>
						<div class="details_discount">$<?=$item['price']?></div>
						<div class="details_price">$<?=$item['price']?></div>

						<!-- In Stock -->
						<?php if ($item['quantity'] >= 1): ?>
							<div class="in_stock_container">
							<div class="availability">Availability:</div>
							<span>In Stock</span>
						</div>
							<?php else: ?>
								<div class="in_stock_container">
							<div class="availability">Availability:</div>
							<span>In Stock</span>
						</div>
						<?php endif?>
						<div class="details_text">
							<p><?=$item['description']?></p>
						</div>

						<!-- Product Quantity -->

						<div class="product_quantity_container">
								<input type='hidden' name = 'p_id' value="<?=$item['product_id']?>" class="cart" />
								<button type="submit" style="border: 0;background: none;">
									<div class="button cart_button" style="padding-top: 15px;" type="submit">Add to cart</div>
								</button>
						</div>

						<!-- Share -->
						<div class="details_share">
							<span>Share:</span>
							<ul>
								<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Products -->

	<div class="products">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="products_title">Related Products</div>
				</div>
			</div>
			<div class="row">
				<div class="col">

					<div class="product_grid">
						<?php foreach ($items4 as $k): ?>
							<?php
$aa = base_url();
$bb = 'uploads/';
$cc = $k->image;
$dd = $aa . "" . $bb . "" . $cc;
$alink = base_url("/ezimba/singleproduct/{$k->product_id}");
?>
    					<div class="product">
					    	<div class="product_image">
					    		<img class='card_img' src='<?=$dd?>' alt='Photo2'/>
					    	</div>
					    	<div class="product_content">
								<div class="product_title">
									<a href="<?=$alink?>">

										<?=$k->name?>

										</a>
								</div>
								<div class="product_price"><?=$k->price?>
									UgShs
								</div>
							</div>
						</div>
						<?php endforeach;?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_border"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="newsletter_content text-center">
						<div class="newsletter_title">Subscribe to our newsletter</div>
						<div class="newsletter_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros</p></div>
						<div class="newsletter_form_container">
							<form action="#" id="newsletter_form" class="newsletter_form">
								<input type="email" class="newsletter_input" required="required">
								<button class="newsletter_button trans_200"><span>Subscribe</span></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


<script type="text/javascript">
	$(document).ready(function(){
		$(".product_quantity_container").find('button').click(function(){
			var pid = $(".product_quantity_container").find('input').val();
			$.ajax({
			type:'POST',
			url : "<?php echo base_url('ezimba/addcartitem'); ?>",
			data:{pID: pid},
			dataType : "JSON",
			success : function(response){
				var dt =  response.names.map(name => "<p>" +name+"</p>");
				alert(dt);
				$(".product_quantity_container").find('.button').text(response.status);
				}
			});
		});
	});
</script>