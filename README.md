# Fitzwilliam Museum Artworks

[![DOI](https://zenodo.org/badge/340044187.svg)](https://zenodo.org/badge/latestdoi/340044187)


A WordPress plugin that creates <a href="https://en.support.wordpress.com/shortcodes/">shortcodes</a>
for displaying up-to-date Fitzwilliam Museum artworks on your WordPress site.

This plugin is based on the work that [@mchesterkadwell](https://github.com/mchesterkadwell) created for [@findsorguk](https://github.com/findsorguk/) in 2017 for the PastExplorers project. As ever we stand on the shoulders of giants. [Original code](https://github.com/findsorguk/wp-findsorguk) can be found on the Portable Antiquities Scheme github repo (an endangered dataset, with software that is now 6 years old).

## Fitzwilliam Museum Open Data

Most images and all public data on the Fitzwilliam Museum collection are Creative Commons licensed.

Some images are restricted due to artist copyright.

## Shortcodes

The simplest possible shortcode just needs the record id and inserts a picture and caption automatically:

`[artwork id=656]`

You can also specify a caption text and the image size*:

`[artwork id=656 caption-text="An amazing artwork by Titian" image-size=large]`

Or, if you prefer, no caption at all:

`[artwork id=656 caption-option=none]`

Or you can choose the HTML type that is returned (Figure, Card or Image - Bootstrap style):

`[artwork id=656 display-type=card caption="A crime in action"]`

All the images come with copyright information and an attribution.

## Shortcode options

The shortcode takes the following attributes:

* **id** - the record id of the artwork (required)
* **caption-option** - whether to display a caption or not (optional)
  * auto - caption is automatically generated from the record or the caption-text provided (default)
  * none - no caption
* **display type** - type of HTML to return
  * Figure (Image in Bootstrap layout) with caption and link to record
  * Card - (Bootstrap card layout) with caption and descriptive text
  * Image - just an html image
* **caption-text** - the text to display as the caption (optional)
* **image-size** - the relative size of the image
  * preview
  * medium (default)
  * large
  * original

## Editor button

The plugin installs a button in the editor toolbar to make it easy to insert a shortcode.

![An image showing the popup editor button installed](https://fitz-cms-images.s3.eu-west-2.amazonaws.com/screenshot-2021-02-22-at-16.45.48.png)

Insert the cursor in your post where you want the shortcode to appear and press the button.

![A screenshot of the editor](https://fitz-cms-images.s3.eu-west-2.amazonaws.com/screenshot-2021-02-22-at-16.48.00.png)

A popup appears to take your options:

![A screenshot of the plugin](https://fitz-cms-images.s3.eu-west-2.amazonaws.com/screenshot-2021-02-22-at-16.45.21.png)

You can enter the artwork as:
![A demo of code entered](https://fitz-cms-images.s3.eu-west-2.amazonaws.com/screenshot-2021-02-22-at-16.50.20.png)

* URL - e.g. https://collection.beta.fitz.ms/id/object/656/
* Record ID - which is the id found at the end of the URL e.g. 656
* Accession number - e.g. M.12-1904 - this is to come shortly as the system does not present json code for this query right now.

Press 'Insert Shortcode' to check your input and create your shortcode.

The end result will look like this in the preview or published post:

![A demo of the plugin working](https://fitz-cms-images.s3.eu-west-2.amazonaws.com/tarquin-wordpress.png)

# Installation

The plugin is not yet available from the 'Add Plugins' page in your WordPress installation. However, we hope to make it available soon!

There are two different ways install from this Github repository. You'll need to be an administrator of your WordPress installation to
do this.

 1. Click on the green 'Clone or download' button in this repository and choose Download zip.

    Then go to the 'Plugins > Add New' page of your WordPress installation, click the 'Upload Plugin' button and
    choose the zip file you just downloaded. You won't get all the updates from the repo this way, but this is the
    simplest way to install at the moment.

 2. Alternatively, if you have direct access to your server (and probably sudo access) you can install the plugin via git:

    Navigate to the wp-content/plugins directory of your WordPress installation and clone this repository:


    Go to the 'Plugins' page of your WordPress installation and find 'collection.beta.fitz.ms artworks and Coins' in the list.
    To activate the plugin click 'Activate' (or 'Network Activate' if you have a multisite installation and want it to be
available to all the sites in your installation).

# How it works

The Fitzwilliam Museum provides JSON versions of its artwork records and search results, which are computer readable and come directly from elasticsearch.

The user inserts a shortcode into a post with an artwork record id and the plugin fetches the data for that record from the collection.beta.fitz.ms JSON feeds.


## Example JSON response from collection.beta.fitz.ms

```
{
    "admin": {
        "added": 1592995599000,
        "created": 1312637261000,
        "flag": "Standard Record",
        "id": "object-656",
        "indexed": 1612279217590,
        "modified": 1610038407000,
        "processed": 1612278713980,
        "source": "adlib",
        "stream": "fitz-online",
        "uid": "adlib-object-656",
        "uri": "http:\/\/data.fitzmuseum.cam.ac.uk\/id\/object\/656",
        "uuid": "2ae7af42-978d-3dbc-be34-a59ebbc15e97",
        "version": 7
    },
    "agents": [
        {
            "@link": {
                "relation": "person",
                "type": "reference"
            },
            "admin": {
                "id": "agent-178606",
                "uid": "adlib-agent-178606",
                "uuid": "adce2593-ac68-3182-bcbb-38fdf878d224"
            },
            "summary_title": "Tarquin"
        },
        {
            "@link": {
                "relation": "person",
                "type": "reference"
            },
            "admin": {
                "id": "agent-156878",
                "uid": "adlib-agent-156878",
                "uuid": "f5040d65-b7d5-33fe-8ff9-83d03b03a3ab"
            },
            "summary_title": "Lucretia"
        },
        {
            "@link": {
                "relation": "person",
                "type": "reference"
            },
            "admin": {
                "id": "agent-178600",
                "uid": "adlib-agent-178600",
                "uuid": "4b26f549-4234-3a97-9ecd-901164eff048"
            },
            "summary_title": "Nudity"
        },
        {
            "@link": {
                "relation": "person",
                "type": "reference"
            },
            "admin": {
                "id": "agent-153965",
                "uid": "adlib-agent-153965",
                "uuid": "9664cc3a-6337-3bb4-bb64-5aa43f095c53"
            },
            "summary_title": "servant"
        }
    ],
    "categories": [
        {
            "@link": {
                "type": "reference"
            },
            "admin": {
                "id": "term-106226",
                "uid": "adlib-term-106226",
                "uuid": "194567f2-2bcd-3446-ae31-652386611815"
            },
            "summary_title": "painting"
        }
    ],
    "component": [
        {
            "materials": [
                {
                    "reference": {
                        "@link": {
                            "type": "reference"
                        },
                        "admin": {
                            "id": "term-39136",
                            "uid": "adlib-term-39136",
                            "uuid": "12043b78-5c81-37bf-bdff-9ae151968b41"
                        },
                        "summary_title": "canvas"
                    }
                }
            ],
            "name": "Support"
        },
        {
            "measurements": {
                "dimensions": [
                    {
                        "dimension": "Height",
                        "units": "cm",
                        "value": "188.9"
                    },
                    {
                        "dimension": "Width",
                        "units": "cm",
                        "value": "145.1"
                    }
                ]
            },
            "name": "Canvas"
        }
    ],
    "department": {
        "value": "Paintings, Drawings and Prints"
    },
    "exhibitions": [
        {
            "@link": {
                "catalogue": "320",
                "type": "reference"
            },
            "admin": {
                "id": "exhibition-18",
                "uid": "adlib-exhibition-18",
                "uuid": "d710f826-fb52-350a-bae1-4630a842e7cb"
            },
            "summary_title": "Treasures of Cambridge"
        },
        {
            "@link": {
                "type": "reference"
            },
            "admin": {
                "id": "exhibition-199",
                "uid": "adlib-exhibition-199",
                "uuid": "ee41cef3-9b52-3d45-b7da-880df65f7ec4"
            },
            "summary_title": "The Genius of Venice"
        },
        {
            "@link": {
                "catalogue": "65",
                "type": "reference"
            },
            "admin": {
                "id": "exhibition-201",
                "uid": "adlib-exhibition-201",
                "uuid": "14c86d72-5b3b-32f3-85f5-cf71b1bb9878"
            },
            "summary_title": "Treasures from the Fitzwilliam, \"The Increase of Learning and other great Objects of that Noble Foundation\""
        },
        {
            "@link": {
                "type": "reference"
            },
            "admin": {
                "id": "exhibition-202",
                "uid": "adlib-exhibition-202",
                "uuid": "a7ccadb5-901f-35a4-bffc-c1379cd6d7e8"
            },
            "summary_title": "Titian, Prince of Painters"
        },
        {
            "@link": {
                "type": "reference"
            },
            "admin": {
                "id": "exhibition-3231",
                "uid": "adlib-exhibition-3231",
                "uuid": "bb7e2c29-0bd7-3add-9c0d-401b9a43a07a"
            },
            "summary_title": "Titian"
        },
        {
            "@link": {
                "type": "reference"
            },
            "admin": {
                "id": "exhibition-2664",
                "uid": "adlib-exhibition-2664",
                "uuid": "fce2d9af-c830-3d12-b84e-a1473a258da9"
            },
            "summary_title": "Titien, Tintoret, Veronese, Rivalites a Venise 1540-1600"
        },
        {
            "@link": {
                "type": "reference"
            },
            "admin": {
                "id": "exhibition-3093",
                "uid": "adlib-exhibition-3093",
                "uuid": "39a2a222-6a2f-3541-8e36-6b432d77187e"
            },
            "summary_title": "Der Spate Tizian und die Sinnlichkeit der Malerei"
        }
    ],
    "identifier": [
        {
            "accession_number": "914",
            "primary": true,
            "type": "accession number",
            "value": "914"
        },
        {
            "priref": "656",
            "type": "priref",
            "value": "656"
        },
        {
            "type": "uri",
            "uri": "http:\/\/data.fitzmuseum.cam.ac.uk\/id\/object\/656",
            "value": "http:\/\/data.fitzmuseum.cam.ac.uk\/id\/object\/656"
        }
    ],
    "inscription": [
        {
            "location": "on the slipper, right",
            "transcription": [
                {
                    "value": "TITIANVS.F.    (see catalogue for accurate transcription)"
                }
            ],
            "type": "signature"
        }
    ],
    "institutions": [
        {
            "@link": {
                "type": "reference"
            },
            "admin": {
                "id": "agent-149638",
                "uid": "adlib-agent-149638",
                "uuid": "7376d833-d0a7-3be0-916e-9c892b7a24d8"
            },
            "summary_title": "The Fitzwilliam Museum"
        }
    ],
    "lifecycle": {
        "acquisition": [
            {
                "agents": [
                    {
                        "@link": {
                            "type": "reference"
                        },
                        "admin": {
                            "id": "agent-96932",
                            "uid": "adlib-agent-96932",
                            "uuid": "00cc6772-bda6-35b8-a126-bc4b97b39d66"
                        },
                        "summary_title": "Fairfax Murray, Charles"
                    }
                ],
                "date": [
                    {
                        "earliest": 1918,
                        "latest": 1918,
                        "value": "1918"
                    }
                ],
                "method": {
                    "value": "given"
                }
            }
        ],
        "creation": [
            {
                "date": [
                    {
                        "earliest": 1571,
                        "era": [
                            "CE"
                        ],
                        "latest": 1571,
                        "precision": "circa",
                        "value": "1571"
                    }
                ],
                "maker": [
                    {
                        "@link": {
                            "role": [
                                {
                                    "value": "painter"
                                }
                            ],
                            "type": "reference"
                        },
                        "admin": {
                            "id": "agent-135216",
                            "uid": "adlib-agent-135216",
                            "uuid": "15246541-1d06-34f7-b400-5b2b876591d9"
                        },
                        "summary_title": "Vecellio, Tiziano"
                    }
                ]
            }
        ]
    },
    "medium": [
        {
            "materials": [
                {
                    "reference": {
                        "@link": {
                            "type": "reference"
                        },
                        "admin": {
                            "id": "term-37032",
                            "uid": "adlib-term-37032",
                            "uuid": "f9c1a037-2d7a-3297-83ff-657c4c02e10b"
                        },
                        "summary_title": "oil paint"
                    }
                }
            ]
        }
    ],
    "multimedia": [
        {
            "@link": {
                "type": "reference"
            },
            "admin": {
                "id": "media-218166",
                "uid": "adlib-media-218166",
                "uuid": "55ce0dfb-ef17-35a4-a0da-32823be0482e"
            },
            "processed": {
                "large": {
                    "format": "jpeg",
                    "location": "pdp\/pdp82\/914_201001_adn21_dc2.jpg",
                    "location_is_relative": true,
                    "measurements": {
                        "dimensions": [
                            {
                                "dimension": "height",
                                "units": "pixels",
                                "value": 1024
                            },
                            {
                                "dimension": "width",
                                "units": "pixels",
                                "value": 789
                            }
                        ]
                    },
                    "modified": 1605710881820,
                    "resizable": true,
                    "type": "image"
                },
                "mid": {
                    "format": "jpeg",
                    "location": "pdp\/pdp82\/mid_914_201001_adn21_dc2.jpg",
                    "location_is_relative": true,
                    "measurements": {
                        "dimensions": [
                            {
                                "dimension": "height",
                                "units": "pixels",
                                "value": 649
                            },
                            {
                                "dimension": "width",
                                "units": "pixels",
                                "value": 500
                            }
                        ]
                    },
                    "modified": 1605710881820,
                    "resizable": true,
                    "type": "image"
                },
                "original": {
                    "format": "jpeg",
                    "location": "pdp\/pdp82\/914_201001_adn21_dc2.jpg",
                    "location_is_relative": true,
                    "measurements": {
                        "dimensions": [
                            {
                                "dimension": "height",
                                "units": "pixels",
                                "value": 1024
                            },
                            {
                                "dimension": "width",
                                "units": "pixels",
                                "value": 789
                            }
                        ]
                    },
                    "modified": 1605710881820,
                    "resizable": true,
                    "type": "image"
                },
                "preview": {
                    "format": "jpeg",
                    "location": "pdp\/pdp82\/preview_914_201001_adn21_dc2.jpg",
                    "location_is_relative": true,
                    "measurements": {
                        "dimensions": [
                            {
                                "dimension": "height",
                                "units": "pixels",
                                "value": 324
                            },
                            {
                                "dimension": "width",
                                "units": "pixels",
                                "value": 250
                            }
                        ]
                    },
                    "modified": 1605710881820,
                    "resizable": true,
                    "type": "image"
                }
            },
            "type": {
                "base": "media",
                "type": "image"
            }
        }
    ],
    "name": [
        {
            "reference": {
                "@link": {
                    "type": "reference"
                },
                "admin": {
                    "id": "term-106226",
                    "uid": "adlib-term-106226",
                    "uuid": "194567f2-2bcd-3446-ae31-652386611815"
                },
                "summary_title": "painting"
            }
        }
    ],
    "note": [
        {
            "type": "history note",
            "value": "Probably Philip II of Spain, 1571, and Spanish Royal collection until 1813, when Joseph Bonaparte apparently took it to France, on relinquishing the throne of Spain; anonymous sale, ('Property of a distinguished Foreign Nobleman', sent for sale by Joseph Bates), Christie's, 24 May 1845 (71) bt. in; C.J. Nieuwenhuys; William Coningham, sale, Christie's, 9 June 1879 (66), bt. in; John, 2nd Lord Northwick; his sale by Phillips, Thirlestane House, Cheltenham, 29 July ff. 1859 (1001), bt. Nieuwenhuys; Charles Scarisbrick; anon. sale (C.J. Nieuwenhuys), Christie's, 28 June 1879 (66), bt. in; C.J Nieuwenhuys (decd.) sale, Christie's, 17 July 1886 (53), bt. Murray; Charles Butler (decd.) sale, Christie's, 25 May 1911 (95),  bt. Agnew."
        }
    ],
    "owners": [
        {
            "@link": {
                "type": "reference"
            },
            "admin": {
                "id": "agent-149638",
                "uid": "adlib-agent-149638",
                "uuid": "7376d833-d0a7-3be0-916e-9c892b7a24d8"
            },
            "summary_title": "The Fitzwilliam Museum"
        }
    ],
    "publications": [
        {
            "@link": {
                "page": "31",
                "type": "reference"
            },
            "admin": {
                "id": "publication-382",
                "uid": "adlib-publication-382",
                "uuid": "ee5148de-e3eb-3d38-88db-9a331edf70b6"
            },
            "summary_title": "Treasures of the Fitzwilliam Museum"
        },
        {
            "@link": {
                "page": "208",
                "type": "reference"
            },
            "admin": {
                "id": "publication-6",
                "uid": "adlib-publication-6",
                "uuid": "de1257ed-819b-337c-a407-8a7f41d7184d"
            },
            "summary_title": "The Principal Pictures in the Fitzwilliam Museum, Cambridge (1929)"
        },
        {
            "@link": {
                "type": "reference"
            },
            "admin": {
                "id": "publication-129",
                "uid": "adlib-publication-129",
                "uuid": "b0deb99e-b005-39b6-a7e3-bb744b073200"
            },
            "summary_title": "Tiziano"
        },
        {
            "@link": {
                "type": "reference"
            },
            "admin": {
                "id": "publication-130",
                "uid": "adlib-publication-130",
                "uuid": "6ab78860-0df8-3db1-8c34-38e8fa27bbed"
            },
            "summary_title": "Tizian, Leben und Werk"
        },
        {
            "@link": {
                "type": "reference"
            },
            "admin": {
                "id": "publication-131",
                "uid": "adlib-publication-131",
                "uuid": "df28a134-1213-36bb-a421-1cc5a1b6fe1e"
            },
            "summary_title": "Titian: the paintings and Drawings"
        },
        {
            "@link": {
                "page": "91",
                "type": "reference"
            },
            "admin": {
                "id": "publication-200000003",
                "uid": "adlib-publication-200000003",
                "uuid": "8cf0eb7f-5416-30b3-b2a0-eaed2d3c6e05"
            },
            "summary_title": "[Unknown; Illustrated London News; 1960]"
        },
        {
            "@link": {
                "page": "30",
                "type": "reference"
            },
            "admin": {
                "id": "publication-46",
                "uid": "adlib-publication-46",
                "uuid": "3ce88b28-89e0-3ca4-841a-2205560410c4"
            },
            "summary_title": "Treasures in Cambridge"
        },
        {
            "@link": {
                "type": "reference"
            },
            "admin": {
                "id": "publication-15",
                "uid": "adlib-publication-15",
                "uuid": "a688918a-bb81-3998-99cc-81244715767d"
            },
            "summary_title": "The Fitzwilliam Museum, An Illustrated Survey"
        },
        {
            "@link": {
                "type": "reference"
            },
            "admin": {
                "id": "publication-49",
                "uid": "adlib-publication-49",
                "uuid": "da721774-686e-3b95-bee3-39549309b6b0"
            },
            "summary_title": "Fitzwilliam Museum...Handbook and Guide"
        },
        {
            "@link": {
                "type": "reference"
            },
            "admin": {
                "id": "publication-128",
                "uid": "adlib-publication-128",
                "uuid": "ed7666e3-9922-3b0c-b637-b3cb12e698fc"
            },
            "summary_title": "Tutta la Pittura di Tiziano"
        },
        {
            "@link": {
                "notes": "fig. 1, 'a droite'",
                "page": "18",
                "type": "reference"
            },
            "admin": {
                "id": "publication-200000146",
                "uid": "adlib-publication-200000146",
                "uuid": "7c4bdf0c-286b-3353-92cb-af84e12b1c7d"
            },
            "summary_title": "Etude sur deux tableaux du Titien intitul\u00e9s: Tarquin and Lucretia"
        },
        {
            "@link": {
                "page": "766",
                "type": "reference"
            },
            "admin": {
                "id": "publication-200000148",
                "uid": "adlib-publication-200000148",
                "uuid": "ff598f8d-e4b7-3ce4-8861-5430d6ff7865"
            },
            "summary_title": "Titian's 'Tarquin and Lucretia' in Painting of the Month"
        },
        {
            "@link": {
                "page": "172-175",
                "type": "reference"
            },
            "admin": {
                "id": "publication-5",
                "uid": "adlib-publication-5",
                "uuid": "c37bfc24-ce16-38f0-a61f-e104be121758"
            },
            "summary_title": "Catalogue of Paintings in the Fitzwilliam Museum, Cambridge, Italian School"
        },
        {
            "@link": {
                "type": "reference"
            },
            "admin": {
                "id": "publication-200000145",
                "uid": "adlib-publication-200000145",
                "uuid": "6d58830b-b3a2-3fc6-aca0-e340b87e2dc6"
            },
            "summary_title": "'Rubens in Madrid and the decoration of the King's summer apartments'"
        },
        {
            "@link": {
                "page": "162-172",
                "type": "reference"
            },
            "admin": {
                "id": "publication-200000147",
                "uid": "adlib-publication-200000147",
                "uuid": "0b07310d-03b1-3c43-8381-9f4738465ca2"
            },
            "summary_title": "'Titian's 'Tarquin and Lucretia' in the Fitzwilliam'"
        },
        {
            "@link": {
                "type": "reference"
            },
            "admin": {
                "id": "publication-285",
                "uid": "adlib-publication-285",
                "uuid": "20524ed7-f96f-3ce6-907b-f9c6f968197e"
            },
            "summary_title": "Supplement to the Catalogue 'Titian Prince of Painters'"
        },
        {
            "@link": {
                "page": "198-200",
                "type": "reference"
            },
            "admin": {
                "id": "publication-200000149",
                "uid": "adlib-publication-200000149",
                "uuid": "4e4655b4-e96f-3b25-a5e5-658b6f4d2be7"
            },
            "summary_title": "'Mourning for Lucretia'"
        }
    ],
    "school_or_style": [
        {
            "@link": {
                "type": "reference"
            },
            "admin": {
                "id": "term-8403",
                "uid": "adlib-term-8403",
                "uuid": "f0de1729-98ba-32a3-adc6-c207550ffb08"
            },
            "summary_title": "Italian"
        },
        {
            "@link": {
                "type": "reference"
            },
            "admin": {
                "id": "term-106260",
                "uid": "adlib-term-106260",
                "uuid": "e4137209-f1f3-3154-9f8f-6304b0731874"
            },
            "summary_title": "Venetian School"
        }
    ],
    "subjects": [
        {
            "@link": {
                "relation": "object name",
                "type": "reference"
            },
            "admin": {
                "id": "term-69145",
                "uid": "adlib-term-69145",
                "uuid": "784af795-5401-382f-b51a-79b0f2b2dab1"
            },
            "summary_title": "curtains"
        },
        {
            "@link": {
                "relation": "object name",
                "type": "reference"
            },
            "admin": {
                "id": "term-107796",
                "uid": "adlib-term-107796",
                "uuid": "23593458-4ce0-320f-888c-2ba8aa5c5eb1"
            },
            "summary_title": "knife"
        },
        {
            "@link": {
                "relation": "object name",
                "type": "reference"
            },
            "admin": {
                "id": "term-109648",
                "uid": "adlib-term-109648",
                "uuid": "81e9054e-fe90-3431-8bf2-645c7c671530"
            },
            "summary_title": "dagger"
        },
        {
            "@link": {
                "relation": "object name",
                "type": "reference"
            },
            "admin": {
                "id": "term-106409",
                "uid": "adlib-term-106409",
                "uuid": "cf38689b-f0cd-3a76-9e24-496891523312"
            },
            "summary_title": "bed"
        },
        {
            "@link": {
                "relation": "object name",
                "type": "reference"
            },
            "admin": {
                "id": "term-235",
                "uid": "adlib-term-235",
                "uuid": "9cf0c470-4a55-3706-83a2-ae280fc26871"
            },
            "summary_title": "fashion"
        },
        {
            "@link": {
                "type": "literal"
            },
            "name": [
                {
                    "value": "curtains"
                }
            ],
            "summary_title": "curtains"
        },
        {
            "@link": {
                "type": "literal"
            },
            "name": [
                {
                    "value": "knife"
                }
            ],
            "summary_title": "knife"
        },
        {
            "@link": {
                "type": "literal"
            },
            "name": [
                {
                    "value": "dagger"
                }
            ],
            "summary_title": "dagger"
        },
        {
            "@link": {
                "type": "literal"
            },
            "name": [
                {
                    "value": "bed"
                }
            ],
            "summary_title": "bed"
        },
        {
            "@link": {
                "type": "literal"
            },
            "name": [
                {
                    "value": "fashion"
                }
            ],
            "summary_title": "fashion"
        }
    ],
    "summary": {
        "reference": {
            "@link": {
                "type": "reference"
            },
            "admin": {
                "id": "term-106226",
                "uid": "adlib-term-106226",
                "uuid": "194567f2-2bcd-3446-ae31-652386611815"
            },
            "summary_title": "painting"
        }
    },
    "summary_title": "painting",
    "techniques": [
        {
            "description": [
                {
                    "value": "oil on canvas"
                }
            ],
            "reference": {
                "@link": {
                    "type": "reference"
                },
                "admin": {
                    "id": "term-30011",
                    "uid": "adlib-term-30011",
                    "uuid": "13394a8d-f74d-3653-9665-2f427e155819"
                },
                "summary_title": "painting (image-making)"
            }
        }
    ],
    "title": [
        {
            "value": "Tarquin and Lucretia"
        }
    ],
    "type": {
        "base": "object",
        "type": "OBJECT"
    }
}
```

# Author

Daniel Pett & Mary Chester-Kadwell, The University of Cambridge

# License

GPL v3

# To do

* Caching of data to prevent unnecessary get requests and so speed up posts and pages
* Admin option to suppress error messages if desired

# Known issues

* Level of documentation at the Museum - some fields have no text!
