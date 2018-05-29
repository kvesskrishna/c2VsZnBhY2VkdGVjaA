<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Selfpaced Tech</span>
							Web Admin &copy; 2017-2018
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>
				</div>
			</div>
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
			<script type="text/javascript">
				var newenrollments_refresh = setInterval(function ()
					{
						$('.newenrollments').load('newenrollments.php').fadeIn("slow");
					}, 10000);
				var newschedulerequest_refresh = setInterval(function ()
					{
						$('.newschedulerequests').load('newschedulerequests.php').fadeIn("slow");
					}, 9500);
				var newbusinessrequest_refresh = setInterval(function ()
					{
						$('.newbusinessrequests').load('newbusinessrequests.php').fadeIn("slow");
					}, 9000);
				var newinstructorrequest_refresh = setInterval(function ()
					{
						$('.newinstructorrequests').load('newinstructorrequests.php').fadeIn("slow");
					}, 8500);

			</script>