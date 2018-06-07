<?php

// Require hero style 3 class
require_once get_template_directory() . "/extensions/hero/style-1.class.php";

// Init an object of Hero class
$hero = new Hero_Style_1();
?>

<div class="hero-main-typo">
	<h1 class="font-bold font-color-white" lang="ko">
		우주기술
	</h1>
	<h1 class="font-bold font-color-white" lang="ko">
		대학생
	</h1>
	<h1 class="font-bold font-color-white" lang="ko">
		창업 아카데미
	</h1>
	<h1 class="font-bold font-color-main" lang="en">
		STAR-EXPLORATION
	</h1>
</div>

<div class="hero-main-count">
	<h2 class="font-bold" lang="en">2018. 07. 05 </h2>
	<?php ventcamp_hero_countdown(); ?>
</div>

<div class="hero-main-logos">
	<img src="http://virusnetwork1.cafe24.com/wp-content/uploads/2018/06/logo_KARI_white.png" />
	<img src="http://virusnetwork1.cafe24.com/wp-content/uploads/2018/06/logo_virus.png" />
</div>

<div class="hero-main-symbol">
	<img src="http://virusnetwork1.cafe24.com/wp-content/uploads/2018/06/logo_camp.png" />
</div>

<section id="hero" <?php echo $hero->get_section_attr( 'light-text' ); ?>>
    <?php
        $hero->overlay();
        $hero->top_line();
    ?>

    <div class="heading-block">
		<div class="container">

            <?php
                $hero->heading_top();
                $hero->heading();
                $hero->subheading();
                $hero->buttons();
            ?>
        </div>
    </div>
</section>
