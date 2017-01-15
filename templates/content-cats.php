<?php while (have_posts()) : the_post(); ?>
<article class="wrapper">
  <div class="row">
    <div class="col-xs-8 col-sm-6">
      <div class="slider slider-for">
    <?php 

    $fields = get_fields();
  
    if ($fields==true) {

    
      if( isset($fields) ) {
        foreach( $fields as $field_name => $value ) {
          
            // large image
            $size = 'large';
            $thumb = $value['sizes'][ $size ];
            $width = $value['sizes'][ $size . '-width' ];
            $height = $value['sizes'][ $size . '-height' ];
            $url = $value['url'];
            $title = $value['title'];
            $alt = $value['alt'];
            $caption = $value['caption']; 
            $field = get_field_object($field_name, false, array('load_value' => false));?>
            <div>
              <a href="<?php echo $url; ?>" title="<?php echo $title; ?>">
                <img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="FullWidth" />
              </a></div>
          <?php 
        }
      } 
    }?>
    </div>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content">
      <h4 class="brandColor"><?php echo $metas = get_post_meta( get_the_ID(), '_slogan_value_key', true ); ?></h4>
      <?php if(get_post_meta( get_the_ID(), '_gender_value_key', true ) == 'hona'){
        ?> <p><?php echo get_post_meta( get_the_ID(), '_gender_value_key', true ); ?> <i class="fa fa-venus" aria-hidden="true"></i></p> <?php;
        } else { ?>
          <p><?php echo get_post_meta( get_the_ID(), '_gender_value_key', true ); ?> <i class="fa fa-mars" aria-hidden="true"></i></p>
          <?php } ?>
     
      <?php the_content(); ?>

    </div>
    </div>
    <div class="col-xs-4 col-sm-2">
    <div class="slider slider-nav" role="toolbar">
        <?php 
  
    if ($fields==true) {

    
      if( isset($fields) ) {
        foreach( $fields as $field_name => $value ) {
          
            // large image
            $size = 'large';
            $thumb = $value['sizes'][ $size ];
            $alt = $value['alt'];
            $field = get_field_object($field_name, false, array('load_value' => false));?>
            
              <img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>"/>
           
          <?php 
        }
      } 
    }?>
    </div>
    </div>
    <div class="col-xs-12 col-sm-4">
      <div class="wrapper-sidebar">
        <?php dynamic_sidebar('sidebar-primary'); ?>
      </div>
    </div>
  </div>
  </div>
  </article>


<?php endwhile; ?>
