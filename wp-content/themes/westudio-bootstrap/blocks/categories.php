<?php
if (!$categories = get_categories()):
  return;
endif;
?>
<aside class="block">
  <h3 class="block-title"><?php _e('Categories', 'wb') ?></h3>
  <div class="block-body">
    <ul class="nav nav-pills nav-stacked">
<?php
foreach ($categories as $category):
  $label  = $category->name;
  $url    = get_category_link($category->cat_ID);
  $active = is_category() && get_queried_object()->term_id == $category->cat_ID;
 ?>
      <li<?php echo ($active ? ' class="active"' : '') ?>>
<?php if ($active && get_option('show_on_front') === 'page'): ?>
        <a href="<?php echo get_permalink(get_option('page_for_posts')) ?>" class="close"><i class="glyphicon glyphicon-remove"></i></a>
<?php endif ?>
        <a href="<?php echo $url ?>"><?php echo $label ?></a>
      </li>
<?php endforeach ?>
    </ul>
  </div>
</aside>
