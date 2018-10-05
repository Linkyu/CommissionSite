<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>KYUSART</title>

    <link rel="shortcut icon" href="<?php echo base_url(); ?>static/images/icon.png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>static/js/chosen_v1.8.7/chosen.css">
</head>
<body>
<header>
    <h1>KYUSART</h1>
</header>
<div id="container">
    <div id="body">
        <div id="avatar_div"><img src="<?php echo base_url(); ?>static/images/feryuu.png"></div>


        <p id="introduction">Welcome to the gallery. You can filter and search.</p>

        <?php echo validation_errors(); ?>

        <?php echo form_open('main/search', 'id = "gallery_search_form"'); ?>
            <input type="search" placeholder="Search..." id="gallery_search_bar" name="query"/>
            <select multiple data-placeholder="Select which tags to include" id="gallery_tag_selector"
                    class="chosen-choices" title="Tags" name="tags[]">
                <?php foreach ($tag_categories as $category => $tags): ?>
                    <optgroup label="<?php echo $category ?>">
                        <?php foreach ($tags as $tag): ?>
                            <option value="<?php echo $tag["id"] ?>"><?php echo $tag["tag"] ?></option>
                        <?php endforeach; ?>
                    </optgroup>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="> Search">
        <?php echo form_close(); ?>

        <div id="main_galleries">
            <section class="gallery">
                <?php foreach ($arts as $art): ?>
                    <?php $coordinates = explode(",", $art->thumbnail) ?>
                    <div class="thumbnail">
                        <a href="<?php echo site_url('Main/art/' . $art->id) ?>">
                            <p class="thumbnail_date"><?php echo $art->date; ?></p>
                            <div class="thumbnail_img_div">
                                <img style="display:none;" class="thumbnail_source_image" src="<?php echo base_url(); ?>static/images/uploads/<?php echo $art->filename; ?>" id="<?php echo "art_image_" . $art->id ?>" data-id="<?php echo $art->id ?>" data-coordinates="<?php echo $art->thumbnail ?>">
                                <img id="<?php echo "art_canvas_" . $art->id ?>" width="256px" height="256px" data-id="<?php echo $art->id ?>" src="#" />
                            </div>
                            <p class="thumbnail_title"><?php echo $art->title; ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            </section>
            <div class="pagination_div">
                <ul class="pagination">
                    <?php if ($current_page > 1): ?>
                    <li><a href="<?php echo site_url('Main/' . $path . '/' . ($current_page - 1)) ?>">«</a></li>
                    <?php endif; ?>

                    <?php for($i = 1; $i <= $amount_of_pages; ++$i): ?>
                    <li><a <?php if($i == $current_page){echo ' class="active"';}?> href="<?php echo site_url('Main/' . $path . '/' . $i) ?>"><?php echo $i; ?></a></li>
                    <?php endfor; ?>

                    <?php if ($current_page < $amount_of_pages): ?>
                    <li><a href="<?php echo site_url('Main/' . $path . '/' . ($current_page + 1)) ?>">»</a></li>
                    <?php endif; ?>
                </ul>
            </div>
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
<script src="<?php echo base_url(); ?>static/js/jquery-3.3.1.js"></script>
<script src="<?php echo base_url(); ?>static/js/chosen_v1.8.7/chosen.jquery.js"></script>
<script>
    $(".chosen-choices").chosen();

    $("document").ready(function () {
        $(".thumbnail_source_image").on("load", function () {
            var artId = this.getAttribute("data-id");
            var thumbnailCoordinates = this.getAttribute("data-coordinates").split(",");
            var srcImage = this;

            // draw image to canvas and get image data
            var canvas = document.createElement("canvas");
            canvas.width = srcImage.width;
            canvas.height = srcImage.height;
            var ctx = canvas.getContext("2d");
            ctx.drawImage(srcImage, 0, 0);
            var imageData = ctx.getImageData(
                parseInt(thumbnailCoordinates[0]),
                parseInt(thumbnailCoordinates[1]),
                parseInt(thumbnailCoordinates[2]),
                parseInt(thumbnailCoordinates[3])
            );

            // create destination canvas
            var canvas1 = document.createElement("canvas");
            canvas1.width = parseInt(thumbnailCoordinates[2]);
            canvas1.height = parseInt(thumbnailCoordinates[3]);
            var ctx1 = canvas1.getContext("2d");
            ctx1.rect(parseInt(thumbnailCoordinates[0]),
                parseInt(thumbnailCoordinates[1]),
                parseInt(thumbnailCoordinates[2]),
                parseInt(thumbnailCoordinates[3]));
            ctx1.fillStyle = 'white';
            ctx1.fill();
            ctx1.putImageData(imageData, 0, 0);

            // put data to the img element
            var dstImg = $('#art_canvas_' + artId).get(0);
            dstImg.src = canvas1.toDataURL("image/png");
        })
    })
</script>
</body>
</html>