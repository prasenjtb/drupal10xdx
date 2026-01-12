<?php

namespace Drupal\customized\Plugin\Layout\SectionStyle;

use Drupal\layout_builder\Plugin\SectionLayoutStyleBase;

/**
 * Provides a theme switcher for layout sections.
 *
 * @SectionLayoutStyle(
 *   id = "layout_theme_style",
 *   label = @Translation("Layout Theme"),
 * )
 */
class ThemeStyle extends SectionLayoutStyleBase {

  public function defaultConfiguration() {
    return ['theme' => 'default'] + parent::defaultConfiguration();
  }

  public function build(array $regions) {
    $build = parent::build($regions);

    $theme = $this->configuration['theme'];

    $build['#attributes']['class'][] = 'section-theme--' . $theme;

    return $build;
  }

  public function buildConfigurationForm(array $form, \Drupal\Core\Form\FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);

    $form['theme'] = [
      '#type' => 'select',
      '#title' => $this->t('Section theme'),
      '#options' => [
        'default' => $this->t('Default'),
        'dark' => $this->t('Dark'),
        'light' => $this->t('Light'),
      ],
      '#default_value' => $this->configuration['theme'],
    ];

    return $form;
  }

}