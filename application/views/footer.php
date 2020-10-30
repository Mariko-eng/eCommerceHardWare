			</div>
			<div class="footer-section" style="display: flex; justify-content:center; background: green;color:white;">
				All Rights And Copyrights Are Reserved!
			</div>
		</div>

<script type="text/javascript">
	$(document).ready(function(){
		var count = 0;
		$("#prpnd").click(function(){
			count = count + 1;
			$("#divA").prepend("<b><p>The "+ count+ " One</p></b>");
		});
		$("#appnd").click(function(){
			count = count + 1;
			$("#divA").append("<b><p>The "+ count+ " One</p></b>");
		});
	});
</script>
	</body>
</html>