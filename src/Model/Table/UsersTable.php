<?php
namespace App\Model\Table;

use App\Model\Entity\SkillsGroup;
use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Table\SkillsGroupsTable;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Positions
 * @property \Cake\ORM\Association\BelongsToMany $Skills
 * @property \Cake\ORM\Association\BelongsToMany $Specializations
 */
class UsersTable extends Table
{

    public $errorMessage    = [];

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
            ->allowEmpty('first_name_uk');

        $validator
            ->allowEmpty('last_name_uk');

        $validator
            ->allowEmpty('first_name_ru');

        $validator
            ->allowEmpty('last_name_ru');

        $validator            
            ->allowEmpty('phone');

        $validator
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator            
            ->allowEmpty('gmail');

        $validator            
            ->allowEmpty('skype');

        $validator            
            ->allowEmpty('social_fb');

        $validator
            ->add('official', 'valid', ['rule' => 'boolean'])            
            ->allowEmpty('official');

        $validator
            ->add('work_start_date', 'valid', ['rule' => 'datetime'])            
            ->allowEmpty('work_start_date');

        $validator
            ->add('work_finish_date', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('work_finish_date');

        $validator
            ->add('birthday', 'valid', ['rule' => 'datetime'])            
            ->allowEmpty('birthday');

        $validator            
            ->allowEmpty('ssh_key');

        $validator
            ->allowEmpty('hash');

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
    
    /**
     * Find user by email or gmail
     * @param $email
     * @return boolean
     */
    public function getByEmail($email) {
        $email = trim($email);
        $user = $this->find()
            ->where([
                'OR' => [['email' => $email], ['gmail'=>$email]]
            ])
            ->contain([])
            ->toArray();

        if (!empty($user[0])) {
            return $user[0];
        } else {
            $this->errorMessage[] = __('Электронный адрес "{0}" не найден', $email);
            return false;
        }
    }
    
     /**
     * @param $user
     * @return object User
     */
    public function getAdditionalInformation($user) {

        // The age of user
        $user->age    = (!empty($user->birthday))? round((time() - strtotime($user->birthday))/YEAR, 1): '&mdash;';
        // Users skills
        $user->skills = $this->formatSkills($user->skills);
        // Work in company
        $user->year_in_company = (!empty($user->work_start_date))? round((time() - strtotime($user->work_start_date))/YEAR, 1): '&mdash;';

        return $user;
    }

    private function formatSkills($skills = []) {
        return $skills;
    }
}
