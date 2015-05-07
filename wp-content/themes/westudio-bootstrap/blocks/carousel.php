<?php
if (!function_exists('get_field')):
  return;
endif;

if (!($images = get_field('gallery'))):
  return;
endif;

$id    = 'carousel-' . get_the_ID();
$count = count($images);
?>
  <div id="<?php echo $id ?>" class="carousel slide hidden-xs" data-ride="carousel">

    <div class="carousel-inner">
<?php
foreach ($images as $i => $image):
  $title   = $image['title'];
  $caption = $image['caption'];
  $alt     = $image['alt'];
  $sizes   = $image['sizes'];
?>
      <div class="item<?php echo ($i == 0 ? ' active' : ''); ?>">

        <img
          src="<?php echo $sizes['wp-12'] ?>"
          alt="<?php echo $alt ?>"
          width="<?php echo $sizes['wp-12-width'] ?>"
          height="<?php echo $sizes['wp-12-height'] ?>" />

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

      <ol class="carousel-indicators">
<?php foreach ($images as $i => $attachment): ?>
        <li data-target="#<?php echo $id ?>" data-slide-to="<?php echo $i ?>" class="<?php echo ($i == 0 ? ' active' : ''); ?>">
          <img
            src="<?php echo $sizes['wp-2-2'] ?>"
            alt="<?php echo $alt ?>"
            width="<?php echo $sizes['wp-2-2-width'] ?>"
            height="<?php echo $sizes['wp-2-2-height'] ?>" />
        </li>
<?php endforeach; ?>
      </ol>

<?php endif ?>

    </div><!-- /.carousel -->
