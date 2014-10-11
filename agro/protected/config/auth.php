<?php
/**
 * Created by PhpStorm.
 * User: storm
 * Date: 8/19/14
 * Time: 3:19 AM
 */

return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),
    'requester' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Requester',
        'children' => array(
            'guest', // унаследуемся от гостя
        ),
        'bizRule' => null,
        'data' => null
    ),
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Adminstrator',
        'children' => array(
            'guest',          // позволим модератору всё, что позволено пользователю
        ),
        'bizRule' => null,
        'data' => null
    ),
    'supplier' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Supplier',
        'children' => array(
            'guest',
        ),
        'bizRule' => null,
        'data' => null
    ),
    'accountant' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Accountant',
        'children' => array(
            'guest',
        ),
        'bizRule' => null,
        'data' => null
    ),
    'financier' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Finansier',
        'children' => array(
            'guest',
        ),
        'bizRule' => null,
        'data' => null
    ),
    'signer' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Signer',
        'children' => array(
            'guest',
        ),
        'bizRule' => null,
        'data' => null
    ),
    'techdir' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Signer',
        'children' => array(
            'guest',
            'signer',
        ),
        'bizRule' => null,
        'data' => null
    ),
    'gendir' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Signer',
        'children' => array(
            'guest',
            'signer',
        ),
        'bizRule' => null,
        'data' => null
    ),
    'root' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Root',
        'children' => array(
            'guest',
            'requester',
            'admin',
            'supplier',
            'accountant',
            'financier',
            'gendir',
            'techdir',
        ),
        'bizRule' => null,
        'data' => null
    ),
);