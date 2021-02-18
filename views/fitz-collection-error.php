<?php
/**
* Template used to display an error message.
*
* @package finds-org-uk-artefacts-and-coins
*/
?>

<p>
  <strong>Something has gone wrong with your Fitzwilliam Collection shortcode:</strong>
</p>
<p>
  <strong><?php echo esc_html( $this->get_error_message() ) ?></strong>
</p>
