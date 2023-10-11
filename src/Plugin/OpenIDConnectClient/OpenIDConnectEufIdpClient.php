<?php

namespace Drupal\openid_connect_eufidp\Plugin\OpenIDConnectClient;

use Drupal\Core\Form\FormStateInterface;
use Drupal\openid_connect\Plugin\OpenIDConnectClientBase;

/**
 * EUF IdP OpenID Connect client.
 *
 * @OpenIDConnectClient(
 *   id = "eufidp",
 *   label = @Translation("EUF IdP")
 * )
 */
class OpenIDConnectEufIdpClient extends OpenIDConnectClientBase {

  /**
   * Base URLs for EUF IdP environments.
   *
   * @var array
   */
  protected $envUrls = [
    'staging' => 'https://idp.dev.uni-foundation.eu',
    'production' => 'https://idp.uni-foundation.eu',
  ];

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration(): array {
    return [
      'environment' => 'staging',
      'scopes' => ['openid', 'email'],
    ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state): array {
    $form = parent::buildConfigurationForm($form, $form_state);

    $description = $this->t('Credentials must be defined in a settings file.');

    $form['client_id']['#attributes']['readonly'] = 'readonly';
    $form['client_id']['#default_value'] = 'placeholder_client_id';
    $form['client_id']['#description'] = $description;

    $form['client_secret']['#attributes']['readonly'] = 'readonly';
    $form['client_secret']['#default_value'] = 'placeholder_client_secret';
    $form['client_secret']['#description'] = $description;

    $form['scopes'] = [
      '#title' => $this->t('Scopes'),
      '#type' => 'textfield',
      '#description' => $this->t('Custom scopes, separated by spaces, for example: openid email'),
      '#default_value' => implode(' ', $this->configuration['scopes']),
    ];

    $form['environment'] = [
      '#title' => $this->t('Environment'),
      '#type' => 'select',
      '#options' => [
        'staging' => $this->t('Staging'),
        'production' => $this->t('Production'),
      ],
      '#default_value' => $this->configuration['environment'],
      '#required' => TRUE,
    ];

    dpm($form);
    dpm($this->getEndpoints());


    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $configuration = $form_state->getValues();

    if (!empty($configuration['scopes'])) {
      $this->setConfiguration([
        'scopes' => explode(' ', $configuration['scopes'])
      ]);
    }

    parent::submitConfigurationForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function getClientScopes(): ?array {
    return $this->configuration['scopes'];
  }

  /**
   * {@inheritdoc}
   */
  public function getEndpoints() : array {
    $base_url = $this->envUrls[$this->configuration['environment']];

    return [
      'authorization' => $base_url . '/oauth2/authorize',
      'token' => $base_url . '/oauth2/token',
      'userinfo' => $base_url . '/oauth2/userInfo',
    ];
  }

}
