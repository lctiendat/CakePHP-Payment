<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OtpSecurities Model
 *
 * @method \App\Model\Entity\OtpSecurity newEmptyEntity()
 * @method \App\Model\Entity\OtpSecurity newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\OtpSecurity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OtpSecurity get($primaryKey, $options = [])
 * @method \App\Model\Entity\OtpSecurity findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\OtpSecurity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OtpSecurity[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OtpSecurity|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OtpSecurity saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OtpSecurity[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OtpSecurity[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\OtpSecurity[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OtpSecurity[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OtpSecuritiesTable extends Table
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

        $this->setTable('otp_securities');
        $this->setAlias('OtpSecurities');
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
            ->scalar('otp')
            ->maxLength('otp', 255)
            ->requirePresence('otp', 'create')
            ->notEmptyString('otp');

        $validator
            ->scalar('ip')
            ->maxLength('ip', 255)
            ->requirePresence('ip', 'create')
            ->notEmptyString('ip');

        return $validator;
    }
}
