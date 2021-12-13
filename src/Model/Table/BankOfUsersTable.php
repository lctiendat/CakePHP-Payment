<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BankOfUsers Model
 *
 * @method \App\Model\Entity\BankOfUser newEmptyEntity()
 * @method \App\Model\Entity\BankOfUser newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BankOfUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BankOfUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\BankOfUser findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BankOfUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BankOfUser[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BankOfUser|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BankOfUser saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BankOfUser[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BankOfUser[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BankOfUser[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BankOfUser[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BankOfUsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('bank_of_users');
        $this->setAlias('BankOfUsers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('bank')
            ->maxLength('bank', 255)
            ->requirePresence('bank', 'create')
            ->notEmptyString('bank');

        $validator
            ->scalar('holder')
            ->maxLength('holder', 255)
            ->requirePresence('holder', 'create')
            ->notEmptyString('holder');

        $validator
            ->scalar('card_number')
            ->maxLength('card_number', 255)
            ->requirePresence('card_number', 'create')
            ->notEmptyString('card_number');

        $validator
            ->scalar('date_card')
            ->maxLength('date_card', 255)
            ->requirePresence('date_card', 'create')
            ->notEmptyString('date_card');

        return $validator;
    }
}
