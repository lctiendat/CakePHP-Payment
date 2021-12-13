<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BankTransactionHistory Entity
 *
 * @property int $id
 * @property string $tranding_code
 * @property string $email
 * @property string $bank
 * @property string $transaction_type
 * @property string $transaction_amount
 * @property string $recharge_code
 * @property string $status
 * @property string $ip
 * @property \Cake\I18n\FrozenTime $created
 */
class BankTransactionHistory extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'tranding_code' => true,
        'email' => true,
        'bank' => true,
        'transaction_type' => true,
        'transaction_amount' => true,
        'recharge_code' => true,
        'status' => true,
        'reason' => true,
        'ip' => true,
        'created' => true,
        'modified'=>true
    ];
}
