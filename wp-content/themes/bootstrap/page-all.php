<?php

/**
 * Template Name: All pages in one
 */

// Build tree from `main` menu items
$nodes = array();
foreach (wp_get_nav_menu_items(get_nav_menu_id_by_location('main')) as $item) {
  $node = (object) array(
    'parent'  => $item->menu_item_parent,
    'chilren' => array(),
    'item'    => $item
  );

  if ($node->parent) {
    $nodes[$node->parent]->children[] = $node;
  }
  $nodes[$item->ID] = $node;
}


?>
<?php
get_template_part('templates/header');
bootstrap_set_layout(false);

foreach ($nodes as $node):
  if ($node->parent):
    continue;
  endif;

  $item = $node->item;
  $id   = bootstrap_url_to_slug($item->url);
?>
  <section id="<?php echo $id ?>" class="page-wrapper">
<?php
    bootstrap_render_item($item);

  if ($node->children):
?>
    <div class="container tabs-wrapper">
      <ul class="nav nav-tabs" role="tablist">
<?php
    $first = true;
    foreach ($node->children as $child):
      $item = $child->item;
      $id   = bootstrap_url_to_slug($item->url);
?>
        <li<?php echo ($first ? ' class="active"' : '') ?>>
          <a href="#<?php echo $id ?>" role="table" data-toggle="tab">
            <?php echo $item->title ?>
          </a>
        </li>
<?php
      $first = false;
    endforeach;
?>
      </ul>

      <div class="tab-content">
<?php
    $first = true;
    foreach ($node->children as $child):
      $item = $child->item;
      $id   = bootstrap_url_to_slug($item->url);
?>
        <div id ="<?php echo $id ?>" class="tab-pane fade<?php echo ($first ? ' in active' : '') ?>">
<?php
          bootstrap_set('is_block', true);
          bootstrap_render_item($item);
          bootstrap_set('is_block', false);
?>
        </div>
<?php
      $first = false;
    endforeach;
?>
      </div>
    </div>
<?php
  endif;
?>
  </section>
<?php
endforeach;
?>

<?php
bootstrap_set_layout(true);
get_template_part('templates/footer');
