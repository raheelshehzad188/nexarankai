<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="google-site-verification" content="FwsxHb032ShzzvWfXYxWJwjLg19V_I-qidUc-FIYqqM" />
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/style.css" type="text/css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/animate.min.css" type="text/css">
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-WV8MPWZ15J"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-WV8MPWZ15J');
</script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="clean-air-fixbar">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-12"><a href="https://clean-air.ae/" class="logo-clean-air"></a></div>
      <div class="col-lg-9 col-md-12">
        <div class="navbar-clean-air">
          <ul>
            <li><a href="https://clean-air.ae">Home</a></li>
            <li><a href="https://clean-air.ae/about">About</a></li>
            <li><a href="https://clean-air.ae/ac-cleaning-uae">Our Services</a></li>
            <li><a href="<?php echo home_url(); ?>">Blog</a></li>
            <li><a href="https://clean-air.ae/contct-us">Contact Us</a></li>
          </ul>
        </div>
        <div class="rtcontact-btn"><a href="https://clean-air.ae/contct-us">Contact Us</a></div>
      </div>
    </div>
  </div>
</header>