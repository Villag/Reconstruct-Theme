<?php
/**
 * Header Template
 *
 * The header template is generally used on every page of your site. Nearly all other templates call it
 * somewhere near the top of the file. It is used mostly as an opening wrapper, which is closed with the
 * footer.php file. It also executes key functions needed by the theme, child themes, and plugins.
 *
 * @package Enterprise
 * @subpackage Template
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html <?php language_attributes(); ?> class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>

	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">
	<title><?php hybrid_document_title(); ?></title>

	<?php wp_head(); // wp_head ?>
	<?php if( $post ) echo get_post_meta( $post->ID, 'enterprise-css', true ); ?>

</head>

<body class="<?php hybrid_body_class(); ?>">

	<?php do_atomic( 'open_body' ); // enterprise_open_body ?>

	<?php do_atomic( 'before_header' ); // enterprise_before_header ?>

	<div id="header" class="row">

		<div class="container">

			<?php do_atomic( 'open_header' ); // enterprise_open_header ?>

			<div id="branding" class="span6">
				<?php hybrid_site_title(); ?>
				<?php hybrid_site_description(); ?>
			</div><!-- #branding -->

			<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>

			<?php do_atomic( 'header' ); // enterprise_header ?>

			<script>
			jQuery(document).ready(function($) {

			    // Show the login dialog box on click
			    $('a#show_login').on('click', function(e){
			        $('body').prepend('<div class="login_overlay"></div>');
			        $('form#login').fadeIn(500);
			        $('div.login_overlay, form#login a.close').on('click', function(){
			            $('div.login_overlay').remove();
			            $('form#login').hide();
			        });
			        e.preventDefault();
			    });

			    // Perform AJAX login on form submit
			    $('form#login').on('submit', function(e){
			        $('form#login p.status').show().text(ajax_login_object.loadingmessage);
			        $.ajax({
			            type: 'POST',
			            dataType: 'json',
			            url: ajax_login_object.ajaxurl,
			            data: {
			                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
			                'username': $('form#login #username').val(),
			                'password': $('form#login #password').val(),
			                'security': $('form#login #security').val() },
			            success: function(data){
			                $('form#login p.status').text(data.message);
			                if (data.loggedin == true){
			                    document.location.href = ajax_login_object.redirecturl;
			                }
			            }
			        });
			        e.preventDefault();
			    });

			});
			</script>
			<style>
			form#login{
			    display: none;
			    background-color: #FFFFFF;
			    position: fixed;
			    top: 200px;
			    padding: 40px 25px 25px 25px;
			    width: 350px;
			    z-index: 999;
			    left: 50%;
			    margin-left: -200px;
			}

			form#login p.status{
			    display: none;
			}

			.login_overlay{
			    height: 100%;
			    width: 100%;
			    background-color: #F6F6F6;
			    opacity: 0.9;
			    position: fixed;
			    z-index: 998;
			}
			</style>
			<?php if (is_user_logged_in()) { ?>
			    <a class="login_button" href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a>

			    <?php get_template_part( 'before-after', 'submit' ); ?>

			<?php } else { ?>
			    <a class="login_button btn btn-primary" id="show_login" href="">Get Started</a>

			    <form id="login" action="login" method="post">
			        <h1>Site Login</h1>
			        <p class="status"></p>
			        <label for="username">Username</label>
			        <input id="username" type="text" name="username">
			        <label for="password">Password</label>
			        <input id="password" type="password" name="password">
			        <a class="lost" href="<?php echo wp_lostpassword_url(); ?>">Lost your password?</a>
			        <input class="submit_button" type="submit" value="Login" name="submit">
			        <a class="close" href="">(close)</a>
			        <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
			    </form>
			<?php } ?>

			<?php do_atomic( 'close_header' ); // enterprise_close_header ?>

		</div><!-- .container -->

	</div><!-- #header.row -->

	<?php do_atomic( 'after_header' ); // enterprise_after_header ?>

	<?php do_atomic( 'before_main' ); // enterprise_before_main ?>

	<div id="main"  class="row">

		<?php do_atomic( 'open_main' ); // enterprise_open_main ?>