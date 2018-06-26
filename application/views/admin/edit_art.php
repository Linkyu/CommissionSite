<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Linkyu's art page</title>

    <link rel="shortcut icon" href="<?php echo base_url(); ?>static/images/icon.png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/jcrop/jquery.Jcrop.css" type="text/css" />
</head>
<body>
<header>
    <h1>LINKYU'S ART PAGE</h1>
</header>
<div id="container">
    <div id="body">
        <div id="avatar_div"><img src="<?php echo base_url(); ?>static/images/feryuu.png"></div>

        <div id="body_container">
            <h2>Edit art #<?php echo $id ?></h2>

            <form id="upload_form">
                <div id="upload_inputs_div">
                    <div>
                        <label>Title
                            <input type="text" value="<?php echo $title ?>">
                        </label>
                        <label>File
                            <input type="file" id="upload_file_input">
                        </label>
                        <label>Description
                            <textarea><?php echo $description ?></textarea>
                        </label>
                        <br>
                        <h2>Stats:</h2>
                        <label>Time spent
                            <input type="text" value="<?php echo $time_spent ?>">
                        </label>
                        <label>Software
                            <input type="text" value="<?php echo $software ?>">
                        </label>
                        <label>Amount of layers
                            <input type="text" value="<?php echo $layers ?>">
                        </label>
                        <label>Commission?
                            <input type="checkbox" id="upload_commission_checkbox" <?php echo $is_commission ?> >
                        </label>
                        <label id="upload_price_block">Price
                            <input type="text" value="<?php echo $price ?>">
                        </label>
                    </div>
                    <div>
                        <label>Thumbnail</label>
                        <div id="views"></div>
                        <div id="preview"></div>
                    </div>
                </div>
                <input type="submit" value="Upload">
            </form>
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
<script src="<?php echo base_url(); ?>static/js/jcrop/jquery.Jcrop.js"></script>
<script src="<?php echo base_url(); ?>static/js/jcrop/jquery.color.js"></script>
<!-- Jcrop and image previewer for making the thumbnail -->
<script type="text/javascript">
    var crop_max_width = 400;
    var crop_max_height = 400;
    var jcrop_api;
    var canvas;
    var context;
    var image;

    var prefsize;

    $("#upload_file_input").change(function() {
        loadImage(this);
    });

    function loadImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            canvas = null;
            reader.onload = function(e) {
                image = new Image();
                image.onload = validateImage;
                image.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function dataURLtoBlob(dataURL) {
        var BASE64_MARKER = ';base64,';
        if (dataURL.indexOf(BASE64_MARKER) === -1) {
            var parts = dataURL.split(',');
            var contentType = parts[0].split(':')[1];
            var raw = decodeURIComponent(parts[1]);

            return new Blob([raw], {
                type: contentType
            });
        }
        parts = dataURL.split(BASE64_MARKER);
        contentType = parts[0].split(':')[1];
        raw = window.atob(parts[1]);
        var rawLength = raw.length;
        var uInt8Array = new Uint8Array(rawLength);
        for (var i = 0; i < rawLength; ++i) {
            uInt8Array[i] = raw.charCodeAt(i);
        }

        return new Blob([uInt8Array], {
            type: contentType
        });
    }

    function validateImage() {
        if (canvas != null) {
            image = new Image();
            image.onload = restartJcrop;
            image.src = canvas.toDataURL('image/png');
        } else restartJcrop();
    }

    function restartJcrop() {
        if (jcrop_api != null) {
            jcrop_api.destroy();
        }
        var views = $("#views");
        views.empty();
        views.append("<canvas id=\"canvas\">");
        canvas_global = $("#canvas");
        canvas = canvas_global[0];
        context = canvas.getContext("2d");
        canvas.width = image.width;
        canvas.height = image.height;
        context.drawImage(image, 0, 0);
        canvas_global.Jcrop({
            onSelect: selectcanvas,
            onRelease: clearcanvas,
            boxWidth: crop_max_width,
            boxHeight: crop_max_height
        }, function() {
            jcrop_api = this;
        });
        clearcanvas();
    }

    function showPreview(coords)
    {
        var rx = 100 / coords.w;
        var ry = 100 / coords.h;

        $('#preview').css({
            width: Math.round(rx * 500) + 'px',
            height: Math.round(ry * 370) + 'px',
            marginLeft: '-' + Math.round(rx * coords.x) + 'px',
            marginTop: '-' + Math.round(ry * coords.y) + 'px'
        });
    }

    function clearcanvas() {
        prefsize = {
            x: 0,
            y: 0,
            w: canvas.width,
            h: canvas.height
        };
    }

    function selectcanvas(coords) {
        prefsize = {
            x: Math.round(coords.x),
            y: Math.round(coords.y),
            w: Math.round(coords.w),
            h: Math.round(coords.h)
        };

        showPreview(coords);
    }

    function applyCrop() {
        canvas.width = prefsize.w;
        canvas.height = prefsize.h;
        context.drawImage(image, prefsize.x, prefsize.y, prefsize.w, prefsize.h, 0, 0, canvas.width, canvas.height);
        validateImage();
    }

    $("#cropbutton").click(function(e) {
        applyCrop();
    });

    $("#form").submit(function(e) {
        e.preventDefault();
        formData = new FormData($(this)[0]);
        var blob = dataURLtoBlob(canvas.toDataURL('image/png'));
        //---Add file blob to the form data
        formData.append("cropped_image[]", blob);
        $.ajax({
            url: "whatever.php",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                alert("Success");
            },
            error: function(data) {
                alert("Error");
            },
            complete: function(data) {}
        });
    });

</script>
<!-- hider -->
<script type="text/javascript">
    var price_block = $("#upload_price_block");
    var com_checkbox = $("#upload_commission_checkbox");

    if (com_checkbox.is(":checked")) {
        price_block.show();
    } else {
        price_block.hide();
    }

    $(function () {
        com_checkbox.click(function () {
            if ($(this).is(":checked")) {
                price_block.show();
            } else {
                price_block.hide();
            }
        });
    });
</script>
</body>
</html>