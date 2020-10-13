# OpenID Connect EUF IDP client

EUF IDP client compatible with the Drupal 8 version of the OpenID Connect module.

This is a pure clone of the Generic client provided by the contributed module.

## Installation

Include the repository in your project's `composer.json` file:

    "repositories": [
        ...
        {
            "type": "vcs",
            "url": "https://github.com/EuropeanUniversityFoundation/openid_connect_eufidp"
        }
    ],

Then you can require the package as usual:

    composer require euf/openid_connect_eufidp

Finally, install the module:

    drush en openid_connect_eufidp

## Usage

A new OpenID Connect client will be available at `/admin/config/services/openid-connect`. The configuration options available are the same as the Generic client and the module ships with some defaults.
