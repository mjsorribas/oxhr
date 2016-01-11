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

    private $spec = [];
    private $counter = 0;

    public function initialize() {
        parent::initialize();
        $this->loadModel('Users');
        $this->loadModel('UsersSpecializations');

        $specializations = $this->Users->Specializations->find('list', ['limit' => 200]);
        //$this->spec = $specializations;
        foreach ($specializations as $key=>$item) {
            $this->spec[$key] = strtolower($item);
        }
    }

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
     * import information of users from CSV-file, to DB
     */
    public function load () {

        $filename = '';

        if (empty($this->args[0])) {
            return $this->out('Error! File name not present');
        } else {
            $filename = $this->args[0];
        }

        if (!file_exists($filename)) {
            return $this->out('Error! File not exist');
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
        //we($oneU);
    }

    /**
     * Парсим строку с данными в структуру для сохранениия в таблицу User
     * @param $txtstring
     */
    private function parsUserInfo($txtstring) {
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
     * @param $user_data
     */
    private function saveUserInfo($userInfo = []) {

        $user = $this->Users->newEntity();
        $user = $this->Users->patchEntity($user, $userInfo);
        if ($this->Users->save($user)) {
            $this->counter++;
            return $user['id'];
        } else {
            $this->out('Error! User not saved: ' . $userInfo['email']);
            $this->out(print_r($user));
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

        /*if (!empty($specId)) {
            $this->out($spec .': '.$this->spec[$specId]);
        }*/

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
}
