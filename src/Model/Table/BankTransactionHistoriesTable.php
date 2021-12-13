<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BankTransactionHistories Model
 *
 * @method \App\Model\Entity\BankTransactionHistory newEmptyEntity()
 * @method \App\Model\Entity\BankTransactionHistory newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BankTransactionHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BankTransactionHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\BankTransactionHistory findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BankTransactionHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BankTransactionHistory[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BankTransactionHistory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BankTransactionHistory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BankTransactionHistory[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BankTransactionHistory[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BankTransactionHistory[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BankTransactionHistory[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BankTransactionHistoriesTable extends Table
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

        $this->setTable('bank_transaction_histories');
        $this->setAlias('BankTransactionHistories');
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
            ->scalar('tranding_code')
            ->maxLength('tranding_code', 255)
            ->requirePresence('tranding_code', 'create')
            ->notEmptyString('tranding_code');

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
            ->scalar('transaction_type')
            ->maxLength('transaction_type', 255)
            ->requirePresence('transaction_type', 'create')
            ->notEmptyString('transaction_type');

        $validator
            ->scalar('transaction_amount')
            ->maxLength('transaction_amount', 255)
            ->requirePresence('transaction_amount', 'create')
            ->notEmptyString('transaction_amount');

        $validator
            ->scalar('recharge_code')
            ->maxLength('recharge_code', 255)
            ->requirePresence('recharge_code', 'create')
            ->notEmptyString('recharge_code');

        $validator
            ->scalar('status')
            ->maxLength('status', 255)
            ->notEmptyString('status');

        $validator
            ->scalar('ip')
            ->maxLength('ip', 255)
            ->requirePresence('ip', 'create')
            ->notEmptyString('ip');

        return $validator;
    }
}
