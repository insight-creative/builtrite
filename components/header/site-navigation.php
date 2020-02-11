<button class="menu-toggle animated" aria-expanded="false" >
	<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'builtrite' ); ?></span>
	<span class="genericon genericon-menu"></span>
</button>

<nav id="primary" class="site-navigation" role="navigation">
		<ul class="main-menu menu">
		<?php
				wp_nav_menu( array(
						'theme_location'    => 'main-menu',
						'container_class'				=> 'main-menu',
						'depth'             => 2,
						'container'         => false,
						'items_wrap' 				=> '%3$s'
				) );

				//add search form search-toggle
				echo '<li id="site-search" class="search-toggle">' . get_search_form( false ) . '</li>';
		?>
	</ul>
</nav><!-- #site-navigation -->
