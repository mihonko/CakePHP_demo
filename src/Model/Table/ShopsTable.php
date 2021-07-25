<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Shops Model
 *
 * @method \App\Model\Entity\Shop newEmptyEntity()
 * @method \App\Model\Entity\Shop newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Shop[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Shop get($primaryKey, $options = [])
 * @method \App\Model\Entity\Shop findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Shop patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Shop[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Shop|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Shop saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Shop[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Shop[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Shop[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Shop[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ShopsTable extends Table
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

        $this->setTable('shops');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('News');
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
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('shopname')
            ->maxLength('shopname', 50, '50文字以内で入力してください。')
            ->notEmptyString('shopname', '店舗名は必須項目です。');

        $validator
            ->scalar('postcode')
            ->maxLength('postcode', 8, '郵便番号は8文字まで入力可能です。')
            ->notEmptyString('postcode', '郵便番号は必須項目です。')
            ->add('postcode', 'custom',[
                'rule' =>[$this, 'postcode_check'],
                'message' => 'ハイフンを含む半角数字で入力してください。'
            ]);

        $validator
            ->integer('pref_id', '都道府県の選択が無効です。')
            ->range('pref_id', [0, 48], '都道府県の選択が無効です。')
            ->notEmptyString('pref_id', '都道府県の選択は必須です。');

        $validator
            ->scalar('address')
            ->maxLength('address', 255)
            ->notEmptyString('address', '住所（市区町村以下）は必須項目です。');

        $validator
            ->scalar('tel')
            ->maxLength('tel', 20)
            ->notEmptyString('tel', '電話番号は必須項目です。')
            ->add('tel', 'custom',[
                'rule' =>[$this, 'tel_check'],
                'message' => 'ハイフンを含む半角数字で入力してください。'
            ]);

        $validator
            ->scalar('business_hours')
            ->maxLength('business_hours', 255)
            ->allowEmptyString('business_hours');

        $validator
            ->scalar('regular_holiday')
            ->maxLength('regular_holiday', 255)
            ->allowEmptyString('regular_holiday');

        $validator
            ->scalar('free_test')
            ->maxLength('free_test', 255)
            ->allowEmptyString('free_test');

        $validator
            ->scalar('shop_image')
            ->allowEmptyString('shop_image');

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

    // 郵便番号フォーマットのチェック
    public function postcode_check($value, $context)
    {
        return (bool) preg_match('/^[0-9]{3}-[0-9]{4}$/', $value);
    }

    // 電話番号フォーマットのチェック
    public function tel_check($value, $context)
    {
        return (bool) preg_match('/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/', $value);
    }
}
