<header id="header"
	data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyStartAt': 45, 'stickySetTop': '-45px', 'stickyChangeLogo': true}">
	<div class="header-body">
		<div class="header-container container">
			<div class="header-row">
				<div class="header-column">
					<div class="header-row">
						<div class="header-logo">
							<a href="/">
								<img class="img-fluid" alt="SIMONDES" width="130" height="50" data-sticky-width="120"
									data-sticky-height="50" data-sticky-top="20"
									src="/storage/image/simondes-white.png">
							</a>
						</div>
					</div>
				</div>
				<div class="header-column justify-content-end">
					<div class="header-row pt-3">

						<nav class="header-nav-top">
							<ul class="nav nav-pills">
								<li class="nav-item nav-item-anim-icon d-none d-md-block">
									<a class="nav-link ps-0" href="#"><i class="fas fa-angle-right"></i> Tentang
										Kami</a>
								</li>
								<li class="nav-item nav-item-anim-icon d-none d-md-block">
									<a class="nav-link" href="#"><i class="fas fa-angle-right"></i> Kontak</a>
								</li>
								<li
									class="nav-item nav-item-left-border nav-item-left-border-remove nav-item-left-border-md-show">
									<span class="ws-nowrap"><i class="fas fa-phone"></i> 0812-7886-1007</span>
								</li>
							</ul>
						</nav>
						<div class="header-nav-features">
							<div class="header-nav-feature header-nav-features-search d-inline-flex">
								<a href="#" class="header-nav-features-toggle text-decoration-none"
									data-focus="headerSearch"><i class="fas fa-search header-nav-top-icon"></i></a>
								<div class="header-nav-features-dropdown" id="headerTopSearchDropdown">
									<form role="search" action="page-search-results.html" method="get">
										<div class="simple-search input-group">
											<input class="form-control text-1" id="headerSearch" name="q" type="search"
												value="" placeholder="Search...">
											<button class="btn" type="submit">
												<i class="fas fa-search header-nav-top-icon"></i>
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<ul class="header-social-icons social-icons d-none d-sm-block">
							<li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank"
									title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
							<li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank"
									title="Twitter"><i class="fab fa-twitter"></i></a></li>
							<li class="social-icons-instagram"><a href="http://www.instagram.com/" target="_blank"
									title="Instagram"><i class="fab fa-instagram"></i></a></li>
							<li class="social-icons-youtube"><a href="http://www.youtube.com/" target="_blank"
									title="Youtube"><i class="fab fa-youtube"></i></a></li>
						</ul>
					</div>
					<div class="header-row">
						<div class="header-nav pt-1">
							<div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1">
								<nav class="collapse">
									<ul class="nav nav-pills" id="mainNav">
										<li>
											<a href="/" class="nav-link">
												Beranda
											</a>
										</li>
										<li class="dropdown">
											<a class="dropdown-item dropdown-toggle" href="#">
												Profil &nbsp;<i class="fa fa-angle-down"></i>
											</a>
											<ul class="dropdown-menu">
												<li>
													<a class="dropdown-item" href="//inspektorat.lampungutarakab.go.id/"
														target="_blank">Profil Inspektorat</a>
												</li>
												<li>
													<a class="dropdown-item" href="/profil">Profil Desa</a>
												</li>
											</ul>
										</li>
										<li class="dropdown">
											<a class="dropdown-item dropdown-toggle" href="#">
												Regulasi Desa &nbsp;<i class="fa fa-angle-down"></i>
											</a>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item" href="/pengawasanapip">Pengawasan APIP</a>
												</li>
												<li><a class="dropdown-item" href="/regulasi">Pemerintahan dan Keuangan
														Desa</a></li>
												<!-- <li><a class="dropdown-item" href="/penataanaset">Penataan Aset</a></li>
												<li><a class="dropdown-item" href="/bumdes">BUMDes</a></li>
												<li><a class="dropdown-item" href="/admpem">Administrasi Pemerintahan</a></li>
												<li><a class="dropdown-item" href="/regulasiperangkat">Perangkat Desa</a></li> -->
											</ul>
										</li>
										<li class="dropdown">
											<a class="dropdown-item dropdown-toggle" href="#">
												Data dan Informasi &nbsp;<i class="fa fa-angle-down"></i>
											</a>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item" href="/rpjmdes">RPJMDes</a></li>
												<li><a class="dropdown-item" href="/apbdes">Publikasi APBDes</a></li>
												<li><a class="dropdown-item" href="/dataperangkat">Perangkat Desa</a>
												</li>
												<li><a class="dropdown-item" href="/peta">Peta Desa</a></li>
												<li><a class="dropdown-item" href="/aset">Aset Desa</a></li>
												<li class="dropdown-submenu">
													<a class="dropdown-item" href="#">Monografi</a>
													<ul class="dropdown-menu">
														<li><a class="dropdown-item" href="#">Jumlah Penduduk</a></li>
														<li><a class="dropdown-item" href="#">Sarpras</a></li>
														<li><a class="dropdown-item" href="#">Penduduk Miskin</a></li>
													</ul>
												</li>

											</ul>
										</li>
										<li class="dropdown">
											<a class="dropdown-item dropdown-toggle" href="#">
												Akuntabilitas &nbsp;<i class="fa fa-angle-down"></i>
											</a>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item" href="#">Progress input data</a></li>
												<li><a class="dropdown-item" href="#">Capaian akuntabilitas</a></li>
											</ul>
										</li>
										{{-- @if(session()->has('loggedAdminDesa'))
										<li class="dropdown">
											<a class="dropdown-item dropdown-toggle  btn btn-sm btn-secondary text-white"
												href="#">
												Admin Desa &nbsp;<i class="fa fa-angle-down"></i>
											</a>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item" href="/adminDesa">Dashboard</a></li>
												<li><a class="dropdown-item" href="/logoutDesa">logout</a></li>
											</ul>
										</li>
										@elseif(session()->has('loggedEditor'))
										<li class="dropdown">
											<a class="dropdown-item dropdown-toggle" href="#">
												Editor &nbsp;<i class="fa fa-angle-down"></i>
											</a>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item" href="/editor">Dashboard</a></li>
												<li><a class="dropdown-item" href="/logoutEditor">logout</a></li>
											</ul>
										</li>
										@elseif(session()->has('loggedAdminIrbanwil'))
										<li class="dropdown">
											<a class="dropdown-item dropdown-toggle btn btn-sm btn-secondary text-white"
												href="#">
												Irbanwil &nbsp;<i class="fa fa-angle-down"></i>
											</a>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item" href="/adminIrbanwil">Dashboard</a></li>
												<li><a class="dropdown-item" href="/logoutIrbanwil">logout</a></li>
											</ul>
										</li>
										@else
										<a href="/login"
											class="btn btn-sm btn-rounded btn-secondary mb-2 ml-4">Login</a>
										@endif --}}
										&emsp;&emsp;
										<a href="/login"
											class="btn btn-sm btn-rounded btn-secondary mb-2 ml-4">Login</a>

									</ul>
								</nav>
							</div>

							<button class="btn header-btn-collapse-nav" data-bs-toggle="collapse"
								data-bs-target=".header-nav-main nav">
								<i class="fas fa-bars"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>