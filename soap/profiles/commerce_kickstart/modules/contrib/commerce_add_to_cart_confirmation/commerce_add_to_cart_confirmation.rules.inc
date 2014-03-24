<?php

/**
 * @file
 * Rules integration for the Commerce add to cart confirmation module.
 */

/**
 * Implements hook_rules_action_info().
 */
function commerce_add_to_cart_confirmation_rules_action_info() {
  return array(
    'commerce_add_to_cart_confirmation_message' => array(
      'label' => t('Add to Cart message'),
      'parameter' => array(
        'commerce_line_item' => array(
          'type' => 'commerce_line_item',
          'label' => t('Line item'),
        ),
      ),
      'group' => t('Commerce (contrib)'),
      'callbacks' => array(
        'execute' => 'commerce_add_to_cart_confirmation_rules_add_to_cart_message',
      ),
    ),
  );
}

/**
 * Rules action: displays a custom Add to Cart message.
 */
function commerce_add_to_cart_confirmation_rules_add_to_cart_message($line_item, $continue) {

  $message = '<div class="added-product-title clearfix">' . t('Товар успешно добавлен в корзину') . '</div>';
  $message .= '<div class="button-wrapper">';
  $message .= '<div class="button checkout">' . l(t('Перейти в корзину'), 'cart') . '</div>';
  $message .= '<div class="button continue"><span class="commerce-add-to-cart-confirmation-close">' . t('Обратно в каталог') . '</span></div>';
  $message .= '</div>';
  $message .= views_embed_view('confirm_message_product_display', 'default', $line_item->line_item_id);
  $close = t('Закрыть');

  drupal_set_message('<div class="message-inner">' . $message . '<a class="commerce-add-to-cart-confirmation-close" href="#"><span class="element-invisible">' . $close . '</span></a></div>', 'commerce-add-to-cart-confirmation');
}
