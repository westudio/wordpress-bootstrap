<?php
if ($attachments = bootstrap_get_gallery()):
  $id    = 'carousel-' . get_the_ID();
  $count = count($attachments);
?>
    <div id="<?php echo $id ?>" class="carousel slide hidden-xs" data-ride="carousel">

      <div class="carousel-inner">
<?php
      foreach ($attachments as $i => $attachment):
          $title   = $attachment->fields->title;
          $caption = $attachment->fields->caption;
          $url     = ($image = wp_get_attachment_image_src($attachment->id, 'bootstrap-carousel')) ? $image[0] : '';
?>
        <div class="item<?php echo ($i == 0 ? ' active' : ''); ?>">

          <?php echo wp_get_attachment_image($attachment->id, 'bootstrap-carousel'); ?>

<?php if ($title || $caption): ?>
          <div class="container">
            <div class="carousel-caption">
<?php if ($title): ?>
              <h4><?php echo $title; ?></h4>
<?php endif; ?>
<?php if ($caption): ?>
              <p><?php echo $caption; ?></p>
<?php endif; ?>
            </div>
          </div>
<?php endif;?>
        </div>
<?php endforeach; ?>
      </div><!-- /.carousel-inner -->

<?php if ($count > 1): ?>

      <a class="carousel-control left" href="#<?php echo $id ?>" data-slide="prev">
        <span class="icon-prev"></span>
      </a>
      <a class="carousel-control right" href="#<?php echo $id ?>" data-slide="next">
        <span class="icon-next"></span>
      </a>

      <!--<ol class="carousel-indicators">
<?php foreach ($attachments as $i => $attachment): ?>
        <li data-target="#<?php echo $id ?>" data-slide-to="<?php echo $i ?>" class="<?php echo ($i == 0 ? ' active' : ''); ?>">
            <?php // echo wp_get_attachment_image($attachment->id, 'bootstrap-2-2'); ?>
        </li>
<?php endforeach; ?>
      </ol>-->

<?php endif ?>

    </div><!-- /.carousel -->
<?php
endif;
?>
