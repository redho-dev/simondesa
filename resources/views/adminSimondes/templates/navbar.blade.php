<div class="inner-wrapper">
	<!-- start: sidebar -->
	<aside id="sidebar-left" class="sidebar-left">

		<div class="sidebar-header">
			<div class="sidebar-title">
				Navigation
			</div>
			<div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
				<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
			</div>
		</div>

		<div class="nano">
			<div class="nano-content">
				<nav id="menu" class="nav-main" role="navigation">

					<ul class="nav nav-main">
						<li class="{{ (request()->is('admin')) ? 'nav-active' : '' }}">
							<a class="nav-link" href="/admin">
								<i class="bx bx-home-alt" aria-hidden="true"></i>
								<span>Dashboard</span>
							</a>                        
						</li>
						<li class="nav-parent {{ (request()->is('admin/*')) ? 'nav-expanded nav-active' : '' }} ">
							<a class="nav-link" href="#">
								<i class="el el-dashboard"></i>
								<span>Master Data</span>
							</a>   
							<ul class="nav nav-children">
								<li class="{{ (request()->is('admin/akun')) ? 'nav-active' : '' }}">
									<a class="nav-link" href="/admin/akun">
										Akun Inspektorat
									</a>
								</li>
								<li class="{{ (request()->is('admin/aspek')) ? 'nav-active' : '' }}">
									<a class="nav-link" href="/admin/aspek">
										Aspek
									</a>
								</li>
							</ul>                                  
						</li>
					</ul>
				</nav>
			</div>
		</div>

	</aside>

	<script>
		// Maintain Scroll Position
		if (typeof localStorage !== 'undefined') {
			if (localStorage.getItem('sidebar-left-position') !== null) {
				var initialPosition = localStorage.getItem('sidebar-left-position'),
					sidebarLeft = document.querySelector('#sidebar-left .nano-content');

				sidebarLeft.scrollTop = initialPosition;
			}
		}
	</script>