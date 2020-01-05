<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
	<div class="sidebar-inner slimscrollleft">
		<!-- User -->
		<div class="user-box">
			<div class="user-img">
				<img src="{{ auth()->user()->avatar }}" alt="user-img" title="Mat Helme"
				     class="img-circle img-thumbnail img-responsive">
				<div class="user-status offline"><i class="zmdi zmdi-dot-circle"></i></div>
			</div>
			<h5><a href="#">{{ auth()->user()->name }}</a></h5>
			<ul class="list-inline">
				<li>
					<a href="{{ route('users.edit', auth()->user()->id) }}">
						<i class="zmdi zmdi-settings"></i>
					</a>
				</li>
				<li>
					<a href="#" class="text-custom">
						<i class="zmdi zmdi-power"></i>
					</a>
				</li>
			</ul>
		</div>
		<!-- End User -->

		<!--- Sidemenu -->
		<div id="sidebar-menu">
			<ul>
			</ul>
			<div class="clearfix"></div>
		</div>
		<!-- Sidebar -->
		<div class="clearfix"></div>
	</div>
</div>
<!-- Left Sidebar End -->
