<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<?php
		if (has_site_icon()){
			echo '<link rel="shortcut icon" href="' . get_site_icon_url() . '" />';
		}
	?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="preloader-mask">
		<div class="preloader"></div>
	</div>

	<div class="main-container">
		<?php ventcamp_hero_block( 'after' ); ?>

		<header class="main-nav">
			<div class="menu-wrapper">
				<div class="container">

					<div class="row">
						<div class="col-sm-2 col-xs-12 navigation-header">
							<div class="table-container">
								<div class="cell-container">
									<?php ventcamp_header_logo(); ?>

									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation" aria-controls="navigation">
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								</div>
							</div>
						</div>

						<div class="col-sm-10 col-xs-12 navigation-container">
							<div class="table-container">
								<div class="cell-container">
									<div id="navigation" class="navbar-collapse collapse">
										<?php ventcamp_header_menu(); ?>
										<?php ventcamp_header_button(); ?>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

	<?php ventcamp_hero_block( 'before' ); ?>
