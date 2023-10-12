# OpenID Connect EUF IdP client

EUF IdP client compatible with the **3.x version** of the [OpenID Connect](https://www.drupal.org/project/openid_connect/) module.

This is a clone of the _Generic OAuth 2.0_ client plugin provided by the contributed module.

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

A new OpenID Connect client option will be available at `/admin/config/people/openid-connect`.

The configuration options available are more limited than the _Generic OAuth 2.0_ client:

1. _Client ID_ and _Client secret_ are hardcoded by design so that these credentials are never committed to a `git` repository along with other site configuration.
2. Instructions on how to perform the configuration override (see below) are included in the form.
3. There is a choice between the **Staging** and **Production** environments of the EUF IdP, whose endpoints are automatically determined by the module.

### Overriding configuration

Add the following to your `settings.php` or `settings.local.php` file:

    /* EUF IdP settings */
    #$config['openid_connect.client.machine_name']['status'] = FALSE;
    $config['openid_connect.client.machine_name']['settings']['client_id'] = REAL_CLIENT_ID;
    $config['openid_connect.client.machine_name']['settings']['client_secret'] = REAL_CLIENT_SECRET;

Alternatively, use the _Generic OAuth 2.0_ client instead.
