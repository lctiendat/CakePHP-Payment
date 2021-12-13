<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BankOfUser Entity
 *
 * @property int $id
 * @property string $email
 * @property string $bank
 * @property string $holder
 * @property string $card_number
 * @property string $date_card
 * @property \Cake\I18n\FrozenTime $created
 */
class BankOfUser extends Entity
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
        'email' => true,
        'bank' => true,
        'holder' => true,
        'card_number' => true,
        'date_card' => true,
        'delete_flag'=>true,
        'created' => true,
    ];
}
