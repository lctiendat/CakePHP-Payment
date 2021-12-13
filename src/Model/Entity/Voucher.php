<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Voucher Entity
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $code
 * @property string $money
 * @property string $amount
 * @property string $coin
 * @property string $type
 * @property int $delete_flag
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenDate $expired_time
 */
class Voucher extends Entity
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
        'title' => true,
        'description' => true,
        'code' => true,
        'money' => true,
        'amount' => true,
        'coin' => true,
        'type' => true,
        'delete_flag' => true,
        'created' => true,
        'expired_time' => true,
    ];
}
