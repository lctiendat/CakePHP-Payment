<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string|null $fullname
 * @property string $email
 * @property string $password
 * @property string $avatar
 * @property string $cash
 * @property string $coin
 * @property string $token_renew
 * @property string $token_login
 * @property string $role
 * @property int $delete_flag
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class User extends Entity
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
        'fullname' => true,
        'email' => true,
        'password' => true,
        'avatar' => true,
        'cash' => true,
        'coin' => true,
        'token_renew' => true,
        'token_login' => true,
        'role' => true,
        'delete_flag' => true,
        'created' => true,
        'modified' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
}
