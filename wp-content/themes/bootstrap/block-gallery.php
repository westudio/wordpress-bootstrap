<?php
if ($attachments = bootstrap_get_gallery()):
    if(count($attachments) == 1):
        $attachment = $attachments[0];
?>
    <?php echo wp_get_attachment_image($attachment->id, 'bootstrap-9-cropped'); ?>
<?php
    else:
?>
    <div id="carousel" class="carousel slide" data-toggle="modal-gallery" data-target="#modal-gallery">

        <div class="carousel-inner">
<?php
        foreach ($attachments as $i => $attachment):
            $title   = $attachment->fields->title;
            $caption = $attachment->fields->caption;
            $url     = ($image = wp_get_attachment_image_src($attachment->id, 'bootstrap-12')) ? $image[0] : '';
?>
            <div class="item<?php echo ($i == 0 ? ' active' : ''); ?>">

                <a class="btn btn-icon open" href="<?php echo $url; ?>" title="<?php echo $title; ?>" data-gallery="gallery"><i class="icon-search"></i></a>

                <?php echo wp_get_attachment_image($attachment->id, 'bootstrap-9'); ?>

<?php
            if ($title || $caption):
?>
                <div class="carousel-caption">
<?php
                if ($title):
?>
                    <h4><?php echo $title; ?></h4>
<?php
                endif;
?>
<?php
                if ($caption):
?>
                    <p><?php echo $caption; ?></p>
<?php
                endif;
?>
                </div>
<?php
            endif;
?>
            </div>
<?php
        endforeach;
?>
        </div>

        <a class="carousel-control left" href="#carousel" data-slide="prev">&lt;</a>
        <a class="carousel-control right" href="#carousel" data-slide="next">&gt;</a>

        <ol class="carousel-indicators">
<?php
        foreach ($attachments as $i => $attachment):
?>
            <li data-target="#carousel" data-slide-to="<?php echo $i ?>" class="<?php echo ($i == 0 ? ' active' : ''); ?>">
                <?php // echo wp_get_attachment_image($attachment->id, 'bootstrap-2-square'); ?>
            </li>
<?php
        endforeach;
?>
        </ol>

    </div>

    </div>
<?php
    endif;
endif;
?>
