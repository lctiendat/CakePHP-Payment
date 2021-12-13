<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ApiConnect Model
 *
 * @method \App\Model\Entity\ApiConnect newEmptyEntity()
 * @method \App\Model\Entity\ApiConnect newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ApiConnect[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ApiConnect get($primaryKey, $options = [])
 * @method \App\Model\Entity\ApiConnect findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ApiConnect patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ApiConnect[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ApiConnect|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ApiConnect saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ApiConnect[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ApiConnect[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ApiConnect[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ApiConnect[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ApiConnectTable extends Table
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

        $this->setTable('api_connect');
        $this->setAlias('ApiConnect');
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
            ->scalar('public_key')
            ->maxLength('public_key', 255)
            ->requirePresence('public_key', 'create')
            ->notEmptyString('public_key');

        $validator
            ->scalar('security_key')
            ->maxLength('security_key', 255)
            ->requirePresence('security_key', 'create')
            ->notEmptyString('security_key');

        return $validator;
    }
}
