<?php

if ($categories = get_terms('link_category')):
    var_dump($categories);
?>

<section class="links">

<?php
    foreach ($categories as $category):
        if ($links = get_bookmarks(array('category' => $category->term_id))):
            var_dump($links)
?>


    <div class="links-category">

        <h2><?php echo $category->name; ?></h2>

        <ul class="media-list">
<?php
            foreach ($links as $link):
?>
                <li class="media">
<?php
                if ($link->link_image):
?>
                    <a class="pull-left" href="<?php echo $link->link_url; ?>" target="<?php echo $link->link_target; ?>">
                        <img src="<?php echo $link->link_image; ?>" alt="" class="media-object">
                    </a>
<?php
                endif;
?>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <a href="<?php echo $link->link_url; ?>" target="<?php echo $link->link_target; ?>"><?php echo $link->link_name; ?></a>
                        </h4>
<?php
                if ($link->link_description):
?>
                        <p><?php echo $link->link_description; ?></p>
<?php
                endif;
?>
                    </div>
                    
                </li>
<?php
            endforeach;
?>
        </ul>
    </div>

<?php
    endforeach
?>

</section>

<?php
endif;
?>