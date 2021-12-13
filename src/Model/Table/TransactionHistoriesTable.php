<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TransactionHistories Model
 *
 * @method \App\Model\Entity\TransactionHistory newEmptyEntity()
 * @method \App\Model\Entity\TransactionHistory newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\TransactionHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TransactionHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\TransactionHistory findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\TransactionHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TransactionHistory[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TransactionHistory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TransactionHistory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TransactionHistory[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TransactionHistory[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\TransactionHistory[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TransactionHistory[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TransactionHistoriesTable extends Table
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

        $this->setTable('transaction_histories');
        $this->setAlias('TransactionHistories');
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
            ->scalar('transmitter')
            ->maxLength('transmitter', 255)
            ->requirePresence('transmitter', 'create')
            ->notEmptyString('transmitter');

        $validator
            ->scalar('receiver')
            ->maxLength('receiver', 255)
            ->requirePresence('receiver', 'create')
            ->notEmptyString('receiver');

        $validator
            ->scalar('amount_of_money')
            ->maxLength('amount_of_money', 255)
            ->requirePresence('amount_of_money', 'create')
            ->notEmptyString('amount_of_money');

        $validator
            ->scalar('content')
            ->maxLength('content', 255)
            ->requirePresence('content', 'create')
            ->notEmptyString('content');

        $validator
            ->scalar('ip')
            ->maxLength('ip', 255)
            ->requirePresence('ip', 'create')
            ->notEmptyString('ip');

        return $validator;
    }
}
