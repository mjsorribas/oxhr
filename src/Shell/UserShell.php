<?php
/**
 * Created by PhpStorm.
 * User: @xainse
 * Date: 10.01.2016
 * Time: 10:52
 */

namespace App\Shell;

use Cake\Console\Shell;

class UserShell extends Shell {

    /**
     * The list of specialisations
     * @var array
     */
    private $spec = [];

    /**
     * Error of validation file
     * @var array
     */
    private $validationErrors = [];

    /**
     * The counter of iterations
     * @var int
     */
    private $counter = 0;

    public function initialize() {
        parent::initialize();
        $this->loadModel('Users');
        $this->loadModel('UsersSpecializations');

        $specializations = $this->Users->Specializations->find('list', ['limit' => 200]);

        foreach ($specializations as $key=>$item) {
            $this->spec[$key] = strtolower($item);
        }
    }

    /**
     * Show information about user by username
     * @return bool|int
     */
    public function show()
    {
        $this->out('Show user information');
        if (empty($this->args[0])){
            // Use error() before CakePHP 3.2
            return $this->out('Please enter a username');
        }
        $this->out($this->args[0]);
        $user =  $this->Users->findByUsername($this->args[0])->first();
        if (!empty($user)) {
            $this->out(print_r($user, true));
        } else {
            $this->out('Can\'t find user');
        }
    }

    /**
     * Smport information of users from CSV-file, to DB
     */
    public function load () {

        $filename = null;
        if (!$filename = $this->validateFileParam()) {
            return $this->out(join("\n ", $this->validationErrors));
        }

        $handle = fopen($filename, 'r');
        $i = 0;
        while (!feof($handle)) {
            $i++;
            $txtline = fgets($handle, 4096);

            // Pars user data from file line
            $oneU   = $this->parsUserInfo($txtline);

            // Save new user
            $userId = $this->saveUserInfo($oneU);

            // Save specialisation
            $this->saveSpecialisations($userId, $oneU[1]);
        }

        $this->out('Parsed: '.$i.'. Saved: '.$this->counter);

        fclose($handle);
    }


    /**
     * Парсим строку с данными в структуру для сохранениия в таблицу User
     * @param $txtstring
     * @return array
     */
    private function parsUserInfo($txtstring) {
//        $this->out($txtstring);
        $keys = ['first_name', 'last_name', 'email', 'gmail', 'skype'];
        $result = [];
        $result = explode(',', $txtstring);

        // User Name
        $fio = explode(' ', $result[0]);
        $result[$keys[0]] = trim($fio[0]);
        $result[$keys[1]] = trim($fio[1]);

        // contacts
        $result['email'] = trim($result[2]);
        $result['gmail'] = trim($result[3]);
        $result['skype'] = trim($result[4]);
        $result['table_num'] = trim($result[5]);

        // autofill
        $result['username'] = explode('@', $result['email'])[0];
        $result['password'] = 'empty password';

        return $result;
    }

    /**
     * Save user info to the database
     * @param array $userInfo
     * @return bool
     */
    private function saveUserInfo($userInfo = []) {

        if (empty($userInfo['password'])) {
            $userInfo['password'] = 'empty_password';
        }

        if (!empty($userInfo['email'])) {

            $user = $this->Users->getByEmail($userInfo['email']);
            if (!empty($user)) {

            } else {
                $user = $this->Users->newEntity();
                $this->out(print_r($userInfo));
                $this->out('New #1: ' . $userInfo['email']);
            }
        } else {
            return $this->out('New #2: ');
        }

        $user = $this->Users->patchEntity($user, $userInfo);
        if ($this->Users->save($user)) {
            $this->counter++;
            return $user['id'];
        } else {
            $this->out('Error! User not saved: ' . $userInfo['email']);
            $this->out(print_r($user));
            we();
        }

        return false;
    }

    /**
     * Define the user specialisations and save connections
     */
    private function saveSpecialisations($userId, $spec) {
        $specId = null;

        if (empty($spec)) return false;

        $spec = strtolower($spec);

        foreach($this->spec as $k=>$item) {
            $res = strpos($item, $spec);
            if (is_numeric($res)) {
                $specId = $k;
            }
        }

        if (!empty($specId) && !empty($userId)) {
            $connection = $this->UsersSpecializations->newEntity();
            $connection['user_id'] = $userId;
            $connection['specialization_id'] = $specId;
            if ($this->UsersSpecializations->save($connection)) {
                return true;
            } else {
                return false;
            }
        } else {
            $this->out('Error! Connection not save for user ID: ['.$userId.'] and spec: '.$spec);

            return false;
        }
    }

    /**
     * Load second file with additional data about employees
     * File header columns:
     * - N
     * - First Name
     * - Last Name
     * - Фамилия
     * - Имя
     * - Отчество
     * - uid (nick)
     * - Дата начала работы
     * - День рождения
     * - Домашний телефон
     * - моб. Телефон
     * - Адресс
     * - Локальный email
     * - Внешний email
     *
       bin\cake user load2 tmp\onix_ldpa_personal-2-numbers.csv
     */
    public function load2() {
        $filename = null;
       if (!$filename = $this->validateFileParam()) {
           return $this->out(join("\n ", $this->validationErrors));
       }

        $handle = fopen($filename, 'r');
        $i = 0;
        while (!feof($handle)) {
            $i++;
            $txtline = fgets($handle, 4096);

            // Pars user data from file line
            $oneU   = $this->parsUserInfo2($txtline);

            // Save new user
            $userId = $this->saveUserInfo($oneU);

            // Save specialisation
//            $this->saveSpecialisations($userId, $oneU[1]);
        }

        $this->out('Parsed: '.$i.'. Saved: '.$this->counter);

        fclose($handle);
    }

    /**
     * Pars string from CSV file from OLDAP
     * @param $txtstring
     * @return array
     */
    private function parsUserInfo2($txtstring) {
        $keys = [
            'num', 'first_name', 'last_name', 'first_name_ru', 'last_name_ru', 'father_name_ru',
            'username', 'work_start_date', 'birthday', 'home_phone', 'phone', 'address', 'localemail', 'email'];
        $result = []; // birthday

        $tmp = explode(',', $txtstring);

        foreach($keys as $index=>$key) {
            if (!empty($tmp[$index])) {
                $result[$key] = trim($tmp[$index]);
            }
        }

        unset($result["num"]);
        unset($result["localemail"]);

        return $result;
    }

    /**
     *
     * @return bool|filename
     */
    private function validateFileParam() {
        $filename = null;

        if (empty($this->args[0])) {
            $this->validationErrors[] = 'Error! File name not present';
            return false;
        } else {
            $filename = $this->args[0];
        }

        if (!file_exists($filename)) {
            $this->validationErrors[] = 'Error! File not exist';
            return false;
        }

        return $filename;
    }
}
