<?php

/**
 * Represents a single finds.org.uk artefact record.
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
        'Attribution-NonCommercial-ShareAlike License' => 'BY-NC-SA',
        'Attribution-NonCommercial License' => 'BY-NC-ND',
        'Attribution License' => 'BY',
        'Attribution-ShareAlike License' => 'BY-SA'
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
        $this->image_copyright_holder = $data[ 'legal' ]['credit_line'];
        $this->image_license_acronym = $this->lookup_license_acronym( 'BY-NC-ND' );
        $this->title = $data['title'][0]['value'];
        $this->description = $data['note'][0]['value'];
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
        if($this->image_copyright_holder == '')  {
          $this->image_copyright_holder = 'The Fitzwilliam Museum';
        }
        return $this->image_copyright_holder;
    }

    /**
     * @return string
     */
    public function get_image_license()
    {
        if($this->image_license == ''){
          $this->image_license = 'BY-NC-ND';
        }
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
    private function lookup_license_acronym( $image_license )
    {
        if ( ! is_null ( $image_license ) ) {
            $acronyms = $this->get_cc_license_acronyms();
            return $acronyms[$image_license];
        } else {
            return null;
        }
    }

}
