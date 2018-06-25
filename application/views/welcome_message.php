<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Linkyu's art page</title>

    <link rel="shortcut icon" href="<?php echo base_url(); ?>static/images/icon.png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/style.css">
</head>
<body>
<header>
    <h1>LINKYU'S ART PAGE</h1>
</header>
<div id="container">
    <div id="body">
        <div id="avatar_div"><img src="<?php echo base_url(); ?>static/images/feryuu.png"></div>


        <p id="introduction">Hello, and welcome to my public art page! I am currently taking commissions, and this is
            where you can find all the info you might need about it. If you already know what you want and what price to
            expect for it, there is a form at the bottom of this page to contact me for the commission.</p>

        <div id="main_galleries">
            <h2 class="section_heading" id="featured_heading">⭐ Featured</h2>
            <section id="featured_section" class="mini_gallery">
                <div class="thumbnail">
                    <div class="thumbnail_img_div">
                        <div class="thumbnail_star_counter">⭐ X 15</div>
                        <img src="<?php echo base_url(); ?>static/images/PH_thumbnails/fer1.png">
                    </div>
                    <p class="thumbnail_title">Feryuu ref sheet</p>
                </div>
                <div class="thumbnail">
                    <div class="thumbnail_img_div">
                        <div class="thumbnail_star_counter">⭐ X 7</div>
                        <img src="<?php echo base_url(); ?>static/images/PH_thumbnails/kara.png">
                    </div>
                    <p class="thumbnail_title">"Kara Qureshi, ready to take off!"</p>
                </div>
                <div class="thumbnail">
                    <div class="thumbnail_img_div">
                        <div class="thumbnail_star_counter">⭐ X 95</div>
                        <img src="<?php echo base_url(); ?>static/images/PH_thumbnails/aot.png">
                    </div>
                    <p class="thumbnail_title">Attack on Touhou</p>
                </div>
            </section>

            <h2 class="section_heading" id="latest_heading">🕑 Latest</h2>
            <section id="latest_section" class="mini_gallery">
                <div class="thumbnail">
                    <p class="thumbnail_date">yesterday</p>
                    <div class="thumbnail_img_div">
                        <img src="<?php echo base_url(); ?>static/images/PH_thumbnails/lyra.png">
                    </div>
                    <p class="thumbnail_title">Lyra scars ref</p>
                </div>
                <div class="thumbnail">
                    <p class="thumbnail_date">2 days ago</p>
                    <div class="thumbnail_img_div">
                        <img src="<?php echo base_url(); ?>static/images/PH_thumbnails/kara2.png">
                    </div>
                    <p class="thumbnail_title">Underwater infiltration aaaaaaaaaaaaaaa  a aaa a a a a  a  a aaaa</p>
                </div>
                <div class="thumbnail">
                    <p class="thumbnail_date">4 days ago</p>
                    <div class="thumbnail_img_div">
                        <img src="<?php echo base_url(); ?>static/images/PH_thumbnails/fer2.png">
                    </div>
                    <p class="thumbnail_title">Sketchavember day 27: Ult</p>
                </div>
            </section>
        </div>
    </div>
    <nav id="menu">
        <?php include "menu.php" ?>
    </nav>
</div>
<footer>
    <p class="footer">Page rendered in <strong>{elapsed_time}</strong>
        seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
    </p>
</footer>
</body>
</html>