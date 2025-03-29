<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package practicaltheme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<style>
.site-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 30px;
    background: #f8f9fa;
    border-bottom: 2px solid #ddd;
}

/* Branding (Logo + Title) */
.site-branding {
    display: flex;
    align-items: center;
}

/* Navigation Menu */
.main-navigation {
    margin-left: auto; /* ✅ Moves the menu to the right */
}

.main-menu {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    gap: 20px;
}

.main-menu li {
    display: inline;
}

.main-menu a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    padding: 10px 15px;
    transition: color 0.3s;
}

.main-menu a:hover {
    color: #007bff;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .site-header {
        flex-direction: column;
        text-align: center;
    }

    .main-navigation {
        width: 100%;
        text-align: center;
        margin-top: 10px;
    }

    .main-menu {
        flex-direction: column;
        gap: 10px;
    }
}


</style>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'practicaltheme' ); ?></a>
	<header id="masthead" class="site-header">
    <div class="site-branding">
        <?php the_custom_logo(); ?>

        <div class="site-title-container">
            <?php if (is_front_page() && is_home()) : ?>
                <h1 class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                </h1>
            <?php else : ?>
                <p class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                </p>
            <?php endif; ?>

            <?php 
            $practicaltheme_description = get_bloginfo('description', 'display');
            if ($practicaltheme_description || is_customize_preview()) : ?>
                <p class="site-description"><?php echo esc_html($practicaltheme_description); ?></p>
            <?php endif; ?>
        </div>
    </div><!-- .site-branding -->

    <nav id="site-navigation" class="main-navigation">
        <?php
        if (!session_id()) session_start();

        $menu_location = (isset($_SESSION['is_organic']) && $_SESSION['is_organic'] == 1) ? 'organic_menu' : 'default_menu';

        wp_nav_menu([
            'theme_location' => $menu_location,
            'container'      => 'nav',
            'menu_class'     => 'main-menu',
        ]);
        ?>
    </nav><!-- #site-navigation -->
</header><!-- #masthead -->
