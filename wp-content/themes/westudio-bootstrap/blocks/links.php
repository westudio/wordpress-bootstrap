<?php
// Link Category
if ($categories = get_terms('link_category')):
?>

<section class="links">

  <h2 class="links-heading"><?php _e('Links', 'wb'); ?></h2>

<?php
  foreach ($categories as $category):
    if ($links = get_bookmarks(array('category' => $category->term_id))):
?>

  <div class="links-category">

    <h3 class="links-category-heading"><?php echo $category->name; ?></h3>

    <ul class="links-list">
<?php
      foreach ($links as $link):
?>
      <li class="link">
        <a href="<?php echo $link->link_url; ?>"
           target="<?php echo $link->link_target; ?>"
           title="<?php echo $link->link_description; ?>">
          <?php echo $link->link_name; ?>
        </a>
      </li>
<?php
      endforeach;
?>
    </ul>

<?php
    endif;
  endforeach;
?>

</section>

<?php
// Bookmarks
elseif ($links = get_bookmarks()):
?>

<section class="links">

  <h2 class="links-heading"><?php _e('Links', 'wb'); ?></h2>

  <ul class="links-list">
<?php
  foreach ($links as $link):
?>
    <li class="link">
      <a href="<?php echo $link->link_url; ?>"
         target="<?php echo $link->link_target; ?>"
         title="<?php echo $link->link_description; ?>">
        <?php echo $link->link_name; ?>
      </a>
    </li>
<?php
  endforeach;
?>
  </ul>

</section>

<?php
endif;
?>
