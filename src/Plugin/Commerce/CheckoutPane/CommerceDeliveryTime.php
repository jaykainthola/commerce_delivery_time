<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Drupal\commerce_delivery_time\Plugin\Commerce\CheckoutPane;

use Drupal\commerce_checkout\Plugin\Commerce\CheckoutFlow\CheckoutFlowInterface;
use Drupal\commerce_checkout\Plugin\Commerce\CheckoutPane\CheckoutPaneBase;
use Drupal\commerce_checkout\Plugin\Commerce\CheckoutPane\CheckoutPaneInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides the Commerce Delivery Time.
 *
 * @CommerceCheckoutPane(
 *   id = "commerce_delivery_time",
 *   label = @Translation("Commerce Delivery Time"),
 *   default_step = "order_information",
 *   wrapper_element = "fieldset",
 * )
 */
class CommerceDeliveryTime extends CheckoutPaneBase implements CheckoutPaneInterface {

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, CheckoutFlowInterface $checkout_flow, EntityTypeManagerInterface $entity_type_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $checkout_flow, $entity_type_manager);
  }


  /**
   * {@inheritdoc}
   */
  public function buildPaneForm(array $pane_form, FormStateInterface $form_state, array &$complete_form) {

    $pane_form['commerce_delivery_time'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Delivery Time'),
      '#default_value' => '',
      '#required' => FALSE,
    ];

    return $pane_form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitPaneForm(array &$pane_form, FormStateInterface $form_state, array &$complete_form) {
    $value = $form_state->getValue($pane_form['#parents']);
    $this->order->setData('commerce_delivery_time', $value['commerce_delivery_time']);
  }

  /**
   * {@inheritdoc}
   */
  public function buildPaneSummary() {
    return [
      '#markup' => $this->order->getData('commerce_delivery_time')

    ];
  }

}
