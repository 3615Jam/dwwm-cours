<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light child-header">
	<div class="container">
		<?php the_custom_logo();?>
		<div class="custom-logo-link-url">
    	<h1 class="site-title"><a class="site-title-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" ><?php bloginfo( 'name' ); ?></a>
    	</h1>
    	<?php
		$honeybee_description = get_bloginfo( 'description', 'display' );
		if ( $honeybee_description || is_customize_preview() ) : ?>
			<p class="site-description"><?php echo $honeybee_description; ?></p>
		<?php endif; ?>
		</div>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'honeybee'); ?>">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<div class="ml-auto">
			<?php 
			 $honeybee_shop_button = '<ul class="nav navbar-nav mr-auto">%3$s';
			 $honeybee_shop_button .= '<li class="nav-item dev">
			 <div class="header-module">
			 	<div class="nav-search nav-light-search wrap">
			      <div class="search-box-outer">
			        <div class="dropdown">
			          <a href="#" title="'.esc_attr__('Search','honeybee').'" class="nav-link search-icon condition has-submenu" data-toggle="dropdown"><i class="fa fa-search"></i><span class="sub-arrow"></span></a>
			       		<ul class="dropdown-menu pull-right search-panel" role="menu" aria-hidden="true" aria-expanded="false">
			      			<li class="panel-outer">
			             	<div class="form-container">
			                	<form role="search" method="get" class="search-form" action="'.esc_url( home_url( '/' )).'">
			                   <label>
			                    <input type="search" class="search-field" placeholder="'.esc_attr__('Search …','honeybee').'" value="" name="s">
			                   </label>
			                 		<input type="submit" class="search-submit" value="'.esc_attr__('Search','honeybee').'">
			                	</form>                   
			               </div>
			            </li>
			          </ul>
			        </div>
			      </div>
			    </div>
			</div></li>';
				$honeybee_shop_button .= '</ul>';
				$honeybee_menu_class='';
				 wp_nav_menu( array
		            (
		            'theme_location'=> 'honeypress-primary', 
		            'menu_class'    => 'nav navbar-nav mr-auto '.$honeybee_menu_class.'',
		            'items_wrap' 	=> $honeybee_shop_button,
		            'fallback_cb'   => 'honeypress_fallback_page_menu',
		            'walker'        => new Honeypress_nav_walker()
		            )); 				
		        ?>  
			</div>
		</div>
	</div>
</nav>