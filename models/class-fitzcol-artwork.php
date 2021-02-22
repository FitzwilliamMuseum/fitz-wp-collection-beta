<?php

/**
 *
 * Description.
 *
 * @since 1.0.0
 * @TODO documentation
 */
class Fitzcol_Artwork
{
    private $id;
    private $accession_number;
    private $object_type;
    private $large_image;
    private $medium_image;
    private $original_image;
    private $preview_image;
    private $image_copyright_holder;
    private $image_license;
    private $image_license_acronym;
    private $title;
    private $description;

    private $cc_license_acronyms = array(
        'Attribution-NonCommercial-ShareAlike' => 'BY-NC-SA',
        'Attribution-NonCommercial-No-Derivatives' => 'BY-NC-ND',
        'Attribution' => 'BY',
        'Attribution-ShareAlike' => 'BY-SA'
    );

    private $sizes = array(
      'preview',
      'medium',
      'large',
      'original'
    );

    public function __construct( array $data )
    {
        $this->id = $data[ 'identifier' ][1]['priref'];
        $this->accession_number = $data[ 'identifier' ][0]['accession_number'];
        $this->object_type = $data[ 'summary_title' ];
        $this->medium_image = $data['multimedia'][0]['processed']['mid']['location'];
        $this->large_image = $data[ 'multimedia' ][0]['processed']['large']['location'];
        $this->preview_image = $data[ 'multimedia' ][0]['processed']['preview']['location'];
        $this->original_image = $data[ 'multimedia' ][0]['processed']['original']['location'];
        if(array_key_exists('legal', $data)){
            $this->image_copyright_holder = $data[ 'legal' ]['credit_line'];
        } else {
            $this->image_copyright_holder ='The Fitzwilliam Museum, University of Cambridge';
        }
        if(array_key_exists('title', $data)){
          $this->title = $data['title'][0]['value'];
        } else {
          $this->title = '';
        }
        if(array_key_exists('note', $data)){
          $this->description = $data['note'][0]['value'];
        } else {
          $this->description = 'This object has no descriptive text available';
        }

    }

    public function get_image($image) {
        if(in_array($image, $this->sizes)){
          $imagefunction = 'get_' . $image . '_image';
        } else {
          $imagefunction = 'get_medium_image';
        }
        return $this->$imagefunction();
    }

    /**
     * @return string
     */
    public function get_title()
    {
        return $this->title;
    }
    /**
     * @return string
     */
    public function get_id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function get_accession_number()
    {
        return $this->accession_number;
    }

    /**
     * @return string
     */
    public function get_object_type()
    {
        return $this->object_type;
    }


    /**
     * @return string
     */
    public function get_medium_image()
    {
        return $this->medium_image;
    }
    /**
     * @return string
     */
    public function get_large_image()
    {
        return $this->large_image;
    }
    /**
     * @return string
     */
    public function get_preview_image()
    {
        return $this->preview_image;
    }
    /**
     * @return string
     */
    public function get_original_image()
    {
        return $this->original_image;
    }
    /**
     * @return string
     */
    public function get_image_copyright_holder()
    {
        return $this->image_copyright_holder;
    }

    /**
     * @return string
     */
    public function get_image_license()
    {
        $this->image_license = 'BY-NC-ND';
        return $this->image_license;
    }

    /**
     * @return string
     */
    public function get_description()
    {
        return $this->description;
    }
    /**
     * @return string
     */
    public function get_image_license_acronym()
    {
        $this->image_license_acronym = 'Attribution-NonCommercial-No-Derivatives';
        return $this->image_license_acronym;
    }

    /**
     * @return string
     */
    public function get_cc_license_acronyms()
    {
        return $this->cc_license_acronyms;
    }

    /**
     * @return string
     */
    public function lookup_license_acronym( $image_license )
    {
        if ( ! is_null ( $image_license ) ) {
            $acronyms = $this->get_cc_license_acronyms();
            return $acronyms[$image_license];
        } else {
            return null;
        }
    }


}
