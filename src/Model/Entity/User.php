<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Utility\Security;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity.
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $gmail
 * @property string $skype
 * @property \Cake\I18n\Time $birthday
 * @property string $ssh_key
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
     * Arguments to generate the password
     */
    static public $pass_symbols     = [];
    static private $pass_length     = 16;
    static private $spec_symbols    = ['(','_','!','#','$','%',')','-', '~','^','@','*'];
    static private $symbols_count   = 0;

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

    /**
     * hashing password before save
     * @param $password
     * @return mixed
     */
    protected function _setPassword($password){
        return (new DefaultPasswordHasher)->hash($password);
    }

    /**
     * Generate random hash
     * @param $hash
     * @return string
     */
    public static function getHash($hash = 'onix-hg-systems') {
        return Security::hash(time() . $hash);
    }

    /**
     * $settings array - settings to generate the password
     * Generate random password
     */
    public static function getRandomPass($settings = []) {
        $default = ['use-numbers' => true, 'use-spec' => false];
        $settings = array_intersect_key($settings + $default, $default);

        self::$pass_length = mt_rand(8,self::$pass_length);
        self::$pass_symbols = array_merge(range('a', 'z'), range('A', 'Z'));

        if (!empty($settings['use-numbers'])) {
            self::$pass_symbols = array_merge(range(0,9), self::$pass_symbols, range(0,9));
        }

        if (!empty($settings['use-spec'])) {
            self::$pass_symbols = array_merge(self::$spec_symbols, self::$pass_symbols);
        }

        self::$symbols_count = count(self::$pass_symbols);

        return self::generateRandomString();
    }

    /**
     * @return string
     */
    static private function generateRandomString() {
        srand(self::make_seed());
        $result = array();

        for ($i=0; $i < self::$pass_length; $i++) {
            $result[] = self::$pass_symbols[mt_rand(0, self::$symbols_count-1)];
        }

        return join('',$result);
    }

    /**
     * Generate number to reset the randomizer
     * @return float
     */
    static private function make_seed() {
        list($usec, $sec) = explode(' ', microtime());
        return (float) $sec + ((float) $usec * 100000);
    }

}
