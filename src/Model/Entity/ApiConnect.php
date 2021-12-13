<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApiConnect Entity
 *
 * @property int $id
 * @property string $email
 * @property string $public_key
 * @property string $security_key
 * @property \Cake\I18n\FrozenTime $created
 */
class ApiConnect extends Entity
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
        'public_key' => true,
        'security_key' => true,
        'created' => true,
    ];
}
