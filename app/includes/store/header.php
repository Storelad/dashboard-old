<header id="header" class="transparent-header full-header" data-sticky-class="not-dark">

			<div id="header-wrap">

				<div class="container clearfix">

					<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

					<!-- Logo ============================================= -->
					<div id="logo">
						<a href="<?php echo BASE_URL . '/'; ?>" class="standard-logo" data-dark-logo="<?php echo BASE_URL . '/assets/open/'?>/images/logo-dark.png"><img src="<?php echo BASE_URL . '/assets/open/'?>/images/logo.png" alt="Canvas Logo"></a>
						<a href="<?php echo BASE_URL . '/'; ?>" class="retina-logo" data-dark-logo="<?php echo BASE_URL . '/assets/open/'?>/images/logo-dark@2x.png"><img src="<?php echo BASE_URL . '/assets/open/'?>/images/logo@2x.png" alt="Canvas Logo"></a>
					</div>
					<!-- #logo end -->

					<!-- Primary Navigation ============================================= -->
					<nav id="primary-menu" class="dark">
						<ul>
							<li <?php if($page === 'about'):?> class="current"<?php endif;?>>
								<a href="<?php echo STORE_URL . '/about'; ?>"><div>About</div></a>
							</li>
							<li <?php if($page === 'services'):?> class="current"<?php endif;?>>
								<a href="<?php echo STORE_URL . '/contact'; ?>"><div>Contact</div></a>
							</li>
							<li <?php if($page === 'blog'):?> class="current"<?php endif;?>>
								<a href="<?php echo BASE_URL . '/blog/'; ?>"><div>Blog</div></a>
							</li>
							<li <?php if($page === 'accounts'):?> class="current"<?php endif;?>><a href="<?php echo BASE_URL . '/accounts'; ?>"><div>Login/Sign Up</div></a></li>
							<li <?php if($page === 'stores'):?> class="current"<?php endif;?>><a href="<?php echo BASE_URL . '/stores'; ?>"><div>Stores</div></a></li>
						</ul>

						<!-- Top Cart ============================================= -->
						<div id="top-cart">
							<a href="<?php echo BASE_URL . '/accounts'; ?>"><i class="icon-users"></i><span style="width: 20px !important;">5k+</span></a>
							
						</div><!-- #top-cart end -->

						<!-- Top Search
						============================================= -->
						<div id="top-search">
							<a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
							<form action="search.html" method="get">
								<input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter..">
							</form>
						</div><!-- #top-search end -->

					</nav><!-- #primary-menu end -->

				</div>

			</div>

		</header>