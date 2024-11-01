<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://forhad.net
 * @since      1.0.0
 *
 * @package    Survey_Popup
 * @subpackage Survey_Popup/admin/partials
 */
?>
<style>
:root{
	--primary:#ddd;
	--dark:#333;
	--light:#fff;
	--sahdow: 0 1px 5px rgba(104, 104, 104, 0.8);
}
.btn{
	background-color: var(--dark);
	color: var(--light);
	padding: 0.6rem 1.3rem;
	text-decoration: none;
	border: 0;
}
img{
	max-width: 100%;
}
.wrapper{
	display: grid;
	grid-gap: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

/* Navigation */
nav.main-nav {
	border-bottom: 1px solid #e3e3e3;
}
.main-nav ul{
	display: grid;
	grid-gap: 20px;
	padding: 0px;
	grid-template-columns: repeat(4, 1fr);
	list-style: none;
}
.main-nav ul a{
	padding: 0.8rem;
	display: block;
	font-size: 1.1rem;
	text-decoration: none;
	color: var(--dark);
	text-transform: uppercase;
	background-color: var(--primary);
	box-shadow: var(--sahdow);
	text-align: center;
}
.main-nav a:hover{
	background-color: var(--dark);
	color: var(--light);
}

/* Top Container */
.top-container {
	display: grid;
	gap: 20px;
	grid-template-areas: 
	'showcase showcase top-box-a'
	'showcase showcase top-box-b';

}
/* Showcase */

.showcase {
	grid-area: showcase;
	min-height: 400px;
	padding: .5rem;
	display: flex;
	flex-direction: column;
	align-items: flex-start;
	justify-content: flex-end;
	box-shadow: var(--sahdow);
}
.showcase h1{
	font-size: 4rem;
	margin-bottom: 0;
	color: var(--light);
}
.showcase p{
	font-size: 1.3rem;
	color: var(--light);
	margin-top: 0;
	background-color: rgba(51, 51, 51, 0.771);
}
/* Top Box */
.top-box {
	background-color: var(--primary);
	display: grid;
	align-items: center;
	justify-items: center;
	box-shadow: var(--sahdow);
	padding: 1.5rem;
}
.top-box .price {
	font-size: 2.5rem;
}
.top-box-a {
	grid-area: top-box-a;
}
.top-box-b {
	grid-area: top-box-b;
}

/* Boxes */
.boxes {
	display: grid;
	gap: 20px;
	grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
}
.box {
	background-color: var(--primary);
	display: grid;
	text-align: center;
	padding: 1.3rem;
	box-shadow: var(--sahdow);
}
.info {
	background-color: var(--primary);
	box-shadow: var(--sahdow);
	display: grid;
	gap: 30px;
	grid-template-columns: 1fr 1fr;
	padding: 1rem;
	align-items: center;
}
.portfolio {
	display: grid;
	gap: 20px;
	grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
}
.portfolio img {
	height:100%;
	width: 100%;
	box-shadow: var(--sahdow);
}
footer {
	margin-top: 1.5rem;
	background-color: var(--dark);
	text-align: center;
	padding: 2rem;
	color: var(--light);
}

/* Media Queries */
@media(max-width: 700px) {
	.top-container {
		grid-template-areas: 
		'showcase showcase'
		'top-box-a top-box-b';
	}
	.showcase h1 {
		font-size: 2.5rem;
	}
	.main-nav ul {
		grid-template-columns: 1fr 1fr;
	}
	.info {
		grid-template-columns: 1fr ;
	}
	.info .btn {
		display: block;
		text-align: center;
		margin-top: auto;
	}
}
</style>
<div class="wrapper">
	<!--Navigation-->
	<nav class="main-nav">
		<ul>
			<li><a href="<?php echo esc_url( get_admin_url() . '/post-new.php?post_type=gpsp_survey' ); ?>" target="_blank">New Survey</a></li>
			<li><a href="<?php echo esc_url( get_admin_url() . '/edit.php?post_type=gpsp_survey&page=srvy_survey_settings' ); ?>" target="_blank">Settings</a></li>
			<li><a href="https://forhad.net/" target="_blank">Services</a></li>
			<li><a href="https://forhad.net/" target="_blank">Contact</a></li>
		</ul>
	</nav>

	<!--Top Container-->
	<section class="top-container">
		<header class="showcase">
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/72ym-4BMfCM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</header>
		<div class="top-box top-box-a ">
			<h4>Membership</h4>
			<p class="price">Yearly</p>
			<a href="https://forhad.net/" target="_blank" class="btn">Buy now</a>
		</div>
		<div class="top-box top-box-b ">
			<h4>Pro Membership</h4>
			<p class="price">Lifetime</p>
			<a href="https://forhad.net/" target="_blank" class="btn">Buy now</a>
		</div>
	</section>
	<!--Box Sections-->
	<section class="boxes">
		<div class="box">
			<i class="fas fa-feather-alt fa-4x"></i>
			<h3>It’s Lightweight</h3>
			<p>No need to worry about loading speed as this plugin is absolutely lightweight and fully SEO-optimized.</p>
		</div>
		<div class="box">
			<i class="fas fa-folder-open fa-4x"></i>
			<h3>Well Documentation</h3>
			<p>We have documented every single step so that you can learn about the product features and functionalities.</p>
		</div>
		<div class="box">
			<i class="fas fa-headset fa-4x"></i>
			<h3>24/7 Customer Support</h3>
			<p>Contact Us immediately, and our support team will get back to you ASAP!<br>Don't missed up!</p>
		</div>
		<div class="box">
			<i class="fas fa-plug fa-4x"></i>
			<h3>Plug n Play</h3>
			<p>Very easy to setup, just install and activate. See the dashboard.<br>You got it!</p>
		</div>
	</section>
	<!--Infos section-->
	<section class="info">
		<img src="<?php echo esc_url( SRVY_CONDITIONAL_TYPO_DIR_URL_FILE . 'admin/img/banner-772x250.jpg' ) ?>" alt="">
		<div>
			<h2>Add to Cart Button Pro for WooCommerce</h2>
			<p>Add to Cart Button for WooCommerce allows you to fully customize the Add to Cart button of your WooCommerce shop. You can add a sticky add to cart button on the screen so that customers can buy products from the bottom after reading a long description..</p>
			<a href="https://wordpress.org/plugins/add-to-cart-button-for-woocommerce/" target="_blank" class="btn">Learn More</a>
		</div>
	</section>
	<!--Portfolio-->
	<section class="portfolio">
		<a href="https://wordpress.org/plugins/wp-post-slider-grandslider/" target="_blank"><img src="<?php echo esc_url( SRVY_CONDITIONAL_TYPO_DIR_URL_FILE . 'admin/img/wordpress-post-slider-card.jpg' ) ?>" alt=""></a>
		<a href="https://wordpress.org/plugins/product-slider-carousel/" target="_blank"><img src="<?php echo esc_url( SRVY_CONDITIONAL_TYPO_DIR_URL_FILE . 'admin/img/woo-ps-banner.jpg' ) ?>" alt=""></a>
        <a href="https://wordpress.org/plugins/corona-virus-covid-19-visualizations/" target="_blank"><img src="<?php echo esc_url( SRVY_CONDITIONAL_TYPO_DIR_URL_FILE . 'admin/img/covid-19-visualization-card.jpg' ) ?>" alt=""></a>
		<a href="https://wordpress.org/plugins/acc-conditional-typo/" target="_blank"><img src="<?php echo esc_url( SRVY_CONDITIONAL_TYPO_DIR_URL_FILE . 'admin/img/acc-banner.jpg' ) ?>" alt=""></a>
		<a href="https://wordpress.org/plugins/video-gallery-playlist/" target="_blank"><img src="<?php echo esc_url( SRVY_CONDITIONAL_TYPO_DIR_URL_FILE . 'admin/img/wordpress-youtube-gallery-card.jpg' ) ?>" alt=""></a>
	</section>
	<!--footer-->
	<footer>
		<p>Forhad &copy; 2022</p>
	</footer>
</div>
<!--Wrapper Ends-->
