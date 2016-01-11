<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Positions
 * @property \Cake\ORM\Association\BelongsToMany $Skills
 * @property \Cake\ORM\Association\BelongsToMany $Specializations
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Positions', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'position_id',
            'joinTable' => 'users_positions'
        ]);
        $this->belongsToMany('Skills', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'skill_id',
            'joinTable' => 'users_skills'
        ]);
        $this->belongsToMany('Specializations', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'specialization_id',
            'joinTable' => 'users_specializations'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        /*$validator
            ->requirePresence('gmail', 'create')
            ->notEmpty('gmail');*/

        /*$validator
            ->requirePresence('skype', 'create')
            ->notEmpty('skype');*/

        $validator
            ->add('birthday', 'valid', ['rule' => 'date'])
            ->allowEmpty('birthday');

        /*$validator
            ->requirePresence('ssh_key', 'create')
            ->notEmpty('ssh_key');*/

        $validator
            ->add('table_num', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('table_num');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
        return $rules;
    }
}
