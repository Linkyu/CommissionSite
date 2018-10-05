<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Linkyu's art page</title>

    <link rel="shortcut icon" href="<?php echo base_url(); ?>static/images/icon.png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/cropper/cropper.css" type="text/css" />
</head>
<body>
<header>
    <h1>LINKYU'S ART PAGE</h1>
</header>
<div id="container">
    <div id="body">
        <div id="avatar_div"><img src="<?php echo base_url(); ?>static/images/feryuu.png"></div>

        <div id="body_container">
            <div id="error_div">
                <?php echo validation_errors(); ?>
            </div>

            <h2>Upload art</h2>

            <?php echo form_open_multipart('admin/upload', 'id = "upload_form"'); ?>
                <div id="upload_inputs_div">
                    <div>
                        <label>Title
                            <input type="text" name="title">
                        </label>
                        <label>File
                            <input type="file" id="upload_file_input" name="upload_file_input">
                        </label>
                        <label>Description
                            <textarea name="description"></textarea>
                        </label>
                        <br>
                        <h2>Stats:</h2>

                        <?php foreach ($stats as $stat): ?>
                            <label><?php echo $stat->name ?>
                                <input type="text" name="<?php echo strtolower(str_replace(' ', '_', $stat->name)) ?>">
                            </label>
                        <?php endforeach; ?>

                        <label>Commission?
                            <input type="checkbox" id="upload_commission_checkbox" name="upload_commission_checkbox">
                        </label>
                        <label id="upload_price_block">Price
                            <input type="text" name="price">
                        </label>
                    </div>
                    <div>
                        <label>Thumbnail</label>
                        <div id="view">
                            <img id="canvas" src="#" alt="preview" />
                        </div>
                        <div id="preview"></div>
                    </div>
                </div>
                <input type="submit" value="Upload">
            <?php echo form_close(); ?>
        </div>

    </div>
    <nav id="menu">
<!--     <?php //include "../menu.php" ?>   -->
    </nav>
</div>
<footer>
    <p class="footer">Page rendered in <strong>{elapsed_time}</strong>
        seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
    </p>
</footer>
<script src="<?php echo base_url(); ?>static/js/jquery-3.3.1.js"></script>
<script src="<?php echo base_url(); ?>static/js/jquery-cropper/cropper.js"></script>
<script src="<?php echo base_url(); ?>static/js/jquery-cropper/jquery-cropper.js"></script>

<!-- Jcrop and image previewer for making the thumbnail -->
<script type="text/javascript">
    var cropper;
    var canvas_global = $('#canvas');

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                canvas_global.attr('src', e.target.result);
                startCropper();
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function startCropper() {

        // CROPPER

        canvas_global.cropper({
            aspectRatio: 1,
            zoomable: false,
            crop: function(event) {
                console.log(event.detail.x);
                console.log(event.detail.y);
                console.log(event.detail.width);
                console.log(event.detail.height);
                console.log(event.detail.rotate);
                console.log(event.detail.scaleX);
                console.log(event.detail.scaleY);
            }
        });

        // Get the Cropper.js instance after initialized
        cropper = canvas_global.data('cropper');
    }

    $("#upload_file_input").change(function() {
        readURL(this);
    });

    $("#upload_form").submit( function(eventObj) {
        var crop_size = cropper.getCropBoxData();
        console.log("WAIT");
        $('<input />').attr('type', 'hidden')
            .attr('name', "x")
            .attr('value', crop_size.left)
            .appendTo('#upload_form');
        $('<input />').attr('type', 'hidden')
            .attr('name', "y")
            .attr('value', crop_size.top)
            .appendTo('#upload_form');
        $('<input />').attr('type', 'hidden')
            .attr('name', "width")
            .attr('value', crop_size.width)
            .appendTo('#upload_form');
        $('<input />').attr('type', 'hidden')
            .attr('name', "height")
            .attr('value', crop_size.height)
            .appendTo('#upload_form');
        console.log("OKAY");
        return true;
    });


</script>
<!-- hider -->
<script type="text/javascript">
    $("#upload_price_block").hide();

    $(function () {
        $("#upload_commission_checkbox").click(function () {
            if ($(this).is(":checked")) {
                $("#upload_price_block").show();
            } else {
                $("#upload_price_block").hide();
            }
        });
    });
</script>
</body>
</html>