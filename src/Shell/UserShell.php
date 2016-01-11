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

    public function initialize() {
        parent::initialize();
        $this->loadModel('Users');

        $specializations = $this->Users->Specializations->find('list', ['limit' => 200]);
        foreach ($specializations as $key=>$item) {
            $this->spec[$key] = $item;
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
        $txtline = fgets($handle, 4096);

        $oneU = $this->parsUserInfo($txtline);

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

        // autofill
        $result['username'] = explode('@', $result['email'])[0];
        $result['password'] = 'empty password';

        // Save specialisation
        $this->saveSpecialisations(1, $result[1]);
        //exit;

        /*$user = $this->Users->newEntity();
        $user = $this->Users->patchEntity($user, $result);
        if ($this->Users->save($user)) {

        } else {

            $this->out('Error! User not saved: ' . $result['email']);
        }
        we($user);*/

        return $result;
    }

    /**
     * Розпізнати і зберегти спеціалізацію працівника
     * - якщо нема, тоді нема
     */
    private function saveSpecialisations($userId, $spec) {
        $specId = null;

        $this->out($spec);
        foreach($this->spec as $k=>$item) {
            if (strrpos($item, $spec)) {
                $specId = $k;
            }
        }

        if (!empty($specId)) {
            $this->out($spec .': '.$this->spec[$specId]);
        }
    }
}
