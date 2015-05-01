<?php
if (!$months = get_months()):
  return;
endif;
?>
<aside class="block">
  <h3 class="block-title"><?php _e('Archives', 'wb') ?></h3>
  <div class="block-body">
    <ul class="nav nav-pills nav-stacked">
<?php
foreach ($months as $month):
  $label  = ucfirst(date_i18n('F Y', mktime(0,0,0,$month->month,1,$month->year)));
  $url    = get_month_link($month->year, $month->month);
  $active = is_month()
         && get_query_var('monthnum') == $month->month
         && get_query_var('year') == $month->year;
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
