<?php
/**
* Template used to display a single artwork figure.
*
*/
?>
<?php  if($this->get_display_type() == 'figure'):?>
<figure class="fitzcol-figure wp-caption">

  <img class="figure-img img-fluid rounded"
  src="https://collection.beta.fitz.ms/imagestore/<?php $function = $this->get_image_display(); esc_html_e( $this->get_artwork_record()->$function() );?>"
  alt="<?php esc_html_e( $this->get_caption_text_display() ); ?>
  <?php esc_html_e( $this->get_artwork_record()->get_image_copyright_holder() ); ?>
  <?php _e( $this->get_artwork_record()->get_image_license_acronym() ); ?> 4.0"
  >

  <figcaption class="figure-caption small mt-2">
    <?php if ( 'auto' == $this->get_caption_option() ): ?>
      <h3>
        <a href="https://collection.beta.fitz.ms/id/object/<?php esc_html_e($this->get_artwork_record()->get_id());?>"><?php esc_html_e($this->get_artwork_record()->get_accession_number());?> <?php esc_html_e( $this->get_artwork_record()->get_title() );?></a>
      </h3>
      <?php esc_html_e( $this->get_caption_text_display() ); ?>

    <?php elseif ( 'none' == $this->get_caption_option() ): ?>
    <?php endif; ?>
  </figcaption>
  <?php if ( 'auto' == $this->get_caption_option() ): ?>
  <span class="fitzcol-copyright small">
    <p>
      Legal note: <?php esc_html_e( $this->get_artwork_record()->get_image_copyright_holder() ); ?>
    <br />
      License: <a href="https://creativecommons.org/licenses/<?php esc_html_e( strtolower( $this->get_artwork_record()->get_image_license() ) ); ?>/4.0/">
      <?php esc_html_e( $this->get_artwork_record()->get_image_license_acronym() ); ?>
    </a>
    </p>
  </span>
<?php endif;?>

</figure>
<?php elseif($this->get_display_type() == 'card'): ?>
  <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="https://collection.beta.fitz.ms/imagestore/<?php $function = $this->get_image_display(); esc_html_e( $this->get_artwork_record()->$function() );?>" alt="Card image cap">
  <div class="card-body">
      <a href="https://collection.beta.fitz.ms/id/object/<?php esc_html_e($this->get_artwork_record()->get_id());?>"><?php esc_html_e($this->get_artwork_record()->get_accession_number());?> <?php esc_html_e( $this->get_artwork_record()->get_title() );?></a>
      <?php if ( 'auto' == $this->get_caption_option() ): ?>
        <p class="card-text">
          Legal note: <?php esc_html_e( $this->get_artwork_record()->get_image_copyright_holder() ); ?>
        <br />
          License: <?php esc_html_e( strtolower( $this->get_artwork_record()->get_image_license() ) ); ?>
        </a>
        </p>
    <?php endif;?>
    <a href="https://collection.beta.fitz.ms/id/object/<?php esc_html_e($this->get_artwork_record()->get_id());?>" class="btn btn-primary stretched-link">Read more</a>
  </div>
</div>
<?php elseif($this->get_display_type() == 'image'): ?>
  <img class="img-fluid"
  src="https://collection.beta.fitz.ms/imagestore/<?php $function = $this->get_image_display(); esc_html_e( $this->get_artwork_record()->$function() );?>"
  alt="<?php esc_html_e( $this->get_caption_text_display() ); ?>
  <?php esc_html_e( $this->get_artwork_record()->get_image_copyright_holder() ); ?>
  <?php _e( $this->get_artwork_record()->get_image_license_acronym() ); ?> 4.0"
  >
<?php endif;?>
