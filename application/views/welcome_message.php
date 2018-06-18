<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Linkyu's art page</title>

    <link rel="shortcut icon" href="<?php echo base_url(); ?>static/images/icon.png">

    <style type="text/css">
        header {
            background-color: #08669A;
            max-height: 350px;
            padding-top: 80px;
            padding-bottom: 20px;
        }

        header:after {
            content: "";
            position: absolute;
            left: 0;
            top: 300px;
            width: 0;
            height: 0;
            border-top: 200px solid #08669A;
            border-left: 4000px solid transparent;
            border-right: 0 solid transparent;
        }

        header h1 {
            text-align: center;
            color: #D19B00;
            font-size: 5em;
            text-shadow: -1px -1px 1px #A33A00, 1px 1px 1px #F1E000;
            font-family: "Lato", "proxima-nova", "Helvetica Neue", Arial, sans-serif;
        }

        body {
            background-color: #cacaca;
            margin: 0;
        }

        img {
            display: block;
        }

        #container {
            display: flex;
            flex-flow: row nowrap;
            justify-content: flex-start;
            align-content: flex-start;
        }

        #body {
            background-color: white;
            width: 70%;
            min-width: 350px;
            max-width: 950px;
            margin-left: auto;
            padding: 1em;
        }

        #introduction {
            padding: 3em;
            font-size: large;
        }

        #avatar_div {
            display: inline-block;
            width: 15%;
            padding: 5px;
            background-color: #DEC026;
            margin-left: -16%;
            float: left;
        }

        #avatar_div img {
            width: 100%;
        }

        #menu {
            /*background-color: #00bcd4;*/
            margin-top: 100px;
            margin-right: auto;
            display: flex;
            flex-flow: column nowrap;
        }

        .menu_tab {
            background-color: #08669A;
            color: whitesmoke;
            padding: 5px 1em;
            margin-bottom: 1em;
            font-family: "Lato", "proxima-nova", "Helvetica Neue", Arial, sans-serif;
        }

        #main_galleries {
            clear: left;
        }

        .section_heading {
            width: 7em; /* "MMMMMMM" > "* Featured" */
            margin-left: -5%;
            padding: 0.2em;
            color: whitesmoke;
        }

        #featured_heading {
            background-color: #DE6426;
        }

        #latest_heading {
            background-color: #2cc36b;
        }

        .mini_gallery {
            display: flex;
            flex-flow: row wrap;
            justify-content: space-around;
            align-content: space-between;
        }

        .mini_gallery div {
            flex-shrink: 1;
        }

        .mini_gallery div img {
            border: #00bcd4 2px solid;
        }

        #featured_section div img {
            border: #DEC026 2px solid;
        }

        .thumbnail {
            display: flex;
            flex-flow: column wrap;
            justify-content: flex-start;
            align-content: space-between;
        }

        .thumbnail_date {
            text-align: right;
            font-style: italic;
            color: grey;
            margin-bottom: 8px;
        }

        .thumbnail_title {
            font-weight: bold;
            text-align: center;
            margin: 8px auto;
            /*background-color: #00bcd4;*/
            padding: 0 1em;
            max-width: 200px;
        }

        .thumbnail_star_counter {
            background-color: #DE6426;
            color: whitesmoke;
            width: 4em;
            border-radius: 2em;
            position: relative;
            top: 2em;
            left: -1em;
        }

        footer {
            background-color: #08669A;
            color: whitesmoke;
            text-align: center;
        }
    </style>
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
        <a class="menu_tab">Main page</a>
        <a class="menu_tab">Gallery</a>
        <a class="menu_tab">Commission details</a>
        <a class="menu_tab">Terms and conditions</a>
        <a class="menu_tab">Contact</a>
    </nav>
</div>
<footer>
    <p class="footer">Page rendered in <strong>{elapsed_time}</strong>
        seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
    </p>
</footer>
</body>
</html>