<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity.
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $first_name_uk
 * @property string $last_name_uk
 * @property string $first_name_ru
 * @property string $last_name_ru
 * @property string $phone
 * @property string $email
 * @property string $gmail
 * @property string $skype
 * @property string $social_fb
 * @property bool $official
 * @property \Cake\I18n\Time $work_start_date
 * @property \Cake\I18n\Time $work_finish_date
 * @property \Cake\I18n\Time $birthday
 * @property string $ssh_key
 * @property string $hash
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $table_num
 * @property \App\Model\Entity\Position[] $positions
 * @property \App\Model\Entity\Skill[] $skills
 * @property \App\Model\Entity\Specialization[] $specializations
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
        '*' => true,
        'id' => false,
    ];
}
