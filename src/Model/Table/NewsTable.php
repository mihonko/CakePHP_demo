<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * News Model
 *
 * @method \App\Model\Entity\News newEmptyEntity()
 * @method \App\Model\Entity\News newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\News[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\News get($primaryKey, $options = [])
 * @method \App\Model\Entity\News findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\News patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\News[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\News|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\News saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\News[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\News[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\News[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\News[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class NewsTable extends Table
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

        $this->setTable('news');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Shops');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $shops = $this->Shops->find('list')->select('id')->toArray();

        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('shop_id')
            ->inList('shop_id', $shops, '?????????????????????????????????')
            ->allowEmpty('shop_id', 'create');

        $validator
            ->scalar('is_valid')
            ->notEmptyString('is_valid', '?????? / ??????????????????????????????');

        $validator
            ->date('release_date', ['ymd'], '????????????????????????????????????????????????????????????')
            ->notEmptyDate('release_date', '???????????????????????????????????????');

        $validator
            ->date('release_end_date', ['ymd'], '????????????????????????????????????????????????????????????')
            ->allowEmptyDate('release_end_date');

        $validator
            ->scalar('title')
            ->maxLength('title', 50, '50??????????????????????????????????????????')
            ->notEmptyString('title', '????????????????????????????????????');

        $validator
            ->scalar('text')
            ->notEmptyString('text', '??????????????????????????????');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        return $rules;
    }
}
