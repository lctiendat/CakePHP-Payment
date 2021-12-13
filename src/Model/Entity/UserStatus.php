<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserStatus Entity
 *
 * @property int $id
 * @property string $email
 * @property \Cake\I18n\FrozenTime $lock_time
 * @property string|null $reason
 * @property int $delete_flag
 * @property \Cake\I18n\FrozenTime $created
 */
class UserStatus extends Entity
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
        'lock_time' => true,
        'reason' => true,
        'delete_flag' => true,
        'created' => true,
        'modified' => true
    ];
}
