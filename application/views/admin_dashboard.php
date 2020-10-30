<div style="display: flex; flex-direction:column;align-items: normal;
margin-left:5rem;margin-right: 5rem;">
<div style="display: flex; flex-direction:row;justify-content: space-around;">
	<div style="display: flex; flex-direction:column;align-items: center;padding: 25px;
    padding-left: 50px;
    padding-right: 50px;">
		<h2>Total Orders</h2>
		<h1><?php echo $total_orders_no ?></h1>
	</div>
	<div style="display: flex; flex-direction:column;align-items: center;padding: 25px;
    padding-left: 50px;
    padding-right: 50px;">
		<h2>Orders Pending</h2>
		<h1><?php echo $orders_delivered_no ?></h1>
	</div>
	<div style="display: flex; flex-direction:column;align-items: center;padding: 25px;
    padding-left: 50px;
    padding-right: 50px;">
		<h2>Orders Delivered</h2>
		<h1><?php echo $orders_pending_no ?></h1>
	</div>
</div>
<div style="display: flex; flex-direction:row; justify-content: space-around;">
	<div style="display: flex; flex-direction:column;">
		<h3>CUSTOMERS</h3>
		<table>
			<tr><td>Customer</td><td>Phone</td></tr>
			<?php
foreach ($last_five_customers as $ky) {
	# code...
	echo "<tr><td>{$ky->firstname}</td><td>{$ky->phone}</td></tr>";
}
?>
		</table>
	</div>
	<div style="display: flex; flex-direction:column;">
		<h3>LAST 5 ORDERS</h3>
		<table>
			<tr><td>Product</td><td>Date Ordered</td><td>Status</td><td>UpDate</td><td>Remove</td></tr>
			<?php
foreach ($last_five_orders as $ky) {
	# code...
	echo "<tr><td>{$ky->firstname}</td>
				<td>{$ky->phone}</td>
				<td>{$ky->order_status}</td>
				<td>UpDate</td>
				<td>Remove</td></tr>";
}
?>
		</table>
	</div>
</div>
</div>