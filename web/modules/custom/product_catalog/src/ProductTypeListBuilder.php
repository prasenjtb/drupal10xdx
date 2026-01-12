<?php
declare(strict_types=1);

namespace Drupal\product_catalog;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;
//use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

class ProductTypeListBuilder extends ConfigEntityListBuilder {

  public function buildHeader() {
    //$header['id'] = $this->t('ID');
    //$header['title'] = $this->t('Title');
    $header['label'] = $this->t('Label');
    return $header + parent::buildHeader();
  }

  public function buildRow(EntityInterface $entity) {
    //$row['id'] = $entity->id();
    //$row['title'] = $entity->label();
    $row['label'] = $entity->label();
    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  public function render(): array {
    $build = parent::render();

    $build['table']['#empty'] = $this->t(
      'No product_type types available. <a href=":link">Add product_type type</a>.',
      [':link' => Url::fromRoute('entity.product_type.add_form')->toString()],
    );

    return $build;
  }
}