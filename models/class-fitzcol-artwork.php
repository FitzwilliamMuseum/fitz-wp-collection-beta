<?php

/**
 * Represents a single fitzcol artwork record.
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
    private $title;
    private $object_type;
    private $image;
    private $image_copyright_holder;
    private $image_license;
    private $image_license_acronym;

    private $cc_license_acronyms = array(
        'Attribution-NonCommercial-ShareAlike License' => 'BY-NC-SA',
        'Attribution-NonCommercial License' => 'BY-NC-ND',
        'Attribution License' => 'BY',
        'Attribution-ShareAlike License' => 'BY-SA'
    );

    public function __construct( array $data )
    {
        $this->id = $data[ 'identifier' ][0]['priref'];
        $this->accession_number = $data['identifier'][0]['accession_number'];
        $this->title = $data['title'][0]['value'];
        $this->image = $data['multimedia']['processed']['mid']['location'];
        $this->object_type = $data['summary_title'];
        $this->image_copyright_holder = $data['legal']['credit_line'];
        $this->image_license = 'BY-NC-ND';
        $this->image_license_acronym = $this->lookup_license_acronym( $data[ 'imageLicense' ] );

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



    public function get_image()
    {
        return $this->image;
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
        return $this->image_license;
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
