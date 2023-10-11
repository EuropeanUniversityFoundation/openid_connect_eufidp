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

A new OpenID Connect client option will be available at `/admin/config/people/openid-connect`. The configuration options available are the same as the _Generic OAuth 2.0_ client and the module ships with some defaults.

### Overriding defaults

Out of the box, the module points to the development instance of the EUF IdP. Once all relevant testing has been carried out, it is safe to edit the configuration to point to the production instance.

**However** overriding the placeholders for Client ID and Client Secret should be done via `settings.php` or `settings.local.php` so that these credentials are not committed to the `git` repository. This approach is also useful to enable and disable certain clients per environment. See configuration override syntax below:

    /* EUF IdP settings */
    #$config['openid_connect.client.euf_idp']['status'] = FALSE;
    $config['openid_connect.client.euf_idp']['settings']['client_id'] = 'real_client_id';
    $config['openid_connect.client.euf_idp']['settings']['client_secret'] = 'real_client_secret';
