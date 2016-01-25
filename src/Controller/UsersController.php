<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use App\Model\Entity\User;
use Cake\Network\Exception\NotFoundException;
use Cake\Auth\DefaultPasswordHasher;
use Cake\MAiler\Email;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    private $recoveryLink = '/users/chngp';
    private $haskVar      = 'byhash';

    public function beforeFilter(Event $event)
    {
//        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'signup', 'recovery', 'chngp']);
    }


    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
     * Вхід на сайт введенням логіна і пароля
     * @return \Cake\Network\Response|void
     * password: adminP
     * passhash: $2y$10$y563a3JljMAs6eTl1l22h.8NXUNSfUdPi3.hmEb5kKaoa81wDwK0S
     *
     * pass: adminP: $2y$10$xzVOLVHcVndquW2HJcqJF.B2MG6vFX/670mTka9JUI3AYd2w5Xr/u
     */
    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                // якщо залогінили - то треба встановити потрібну куку
//                $this->Cookie->write(self::COOKIE_UID, $user['cookieId']);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Неправильний логін чи пароль. Спробуйте ще раз!'));
        }

        $pass = 'adminP';
        $passhash = (new DefaultPasswordHasher)->hash($pass);
        $this->set(compact('pass','passhash'));
    }

    /**
     * Logout user
     */
    public function logout() {
//      $this->Cookie->delete(self::COOKIE_UID);
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Recovery tha customer password by email address
     */
    public function recovery() {
        $result = false;

        if (!empty($this->request->data)) {
            $result = $this->checkRecovery($this->request->data);
        }
        $this->set(compact('result'));
    }

    /**
     * Page with ability change password
     */
    public function chngp() {

        $usrSession = 'ddf398clal39';

        if (!empty($this->request->query['byhash'])) {

            $user = $this->Users->find('all', [
                'conditions' => ['hash' =>$this->request->query['byhash']],
                'contain' => []
            ])->toArray();

            if (!empty($user[0])) {
                $this->request->session()->write($usrSession, $user[0]);
                $sess = $this->request->session()->read($usrSession);
                $this->redirect('/users/chngp');
            } else {
                $this->Flash->error(__('Ваш ключ восстновления не действительній'));
            }
        }

        if ($this->request->session()->check($usrSession) && empty($this->request->data)) {
            // Вывести поле для ввода нового пароля
            $password = User::getRandomPass(['use-numbers' => true, 'use-spec' => true]);
            $this->set(compact('password'));

        } elseif ($this->request->session()->check($usrSession) && !empty($this->request->data['password'])) {
            // Сохранить новый пароль
            $user = $this->request->session()->read($usrSession);

            $user = $this->Users->patchEntity($user, [
                'password'  => trim($this->request->data['password']),
                'hash'      => ''
            ]);

            if ($this->Users->save($user)) {
                $this->request->session()->delete($usrSession);
                $this->Flash->success(__('Пароль успешно изменен!'));
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('Ошибка при сохранении изменений'));
            }
        }
    }

    /**
     * Found user by email and send email
     * @param $data - array with user email
     * @return bool
     */
    private function checkRecovery($data) {
        $result = false;
        if (!empty($data['email'])) {
            $user = $this->Users->getByEmail($data['email']);
            if (!empty($user)) {
                $result =  true;
                $this->sendRecoveryEmail($user, $data['email']);
            } else {
                $this->Flash->error(__('Электронна пошта не знайдена'));
            }
        } else {
            $this->Flash->error(__('Адрес електронной почты не найден'));
        }
        return $result;
    }

    /**
     * Send email for recovery to customer
     */
    private function sendRecoveryEmail($user, $email) {

        $hash = User::getHash($user['username'].$user['first_name'].$user['gmail'].$user['skype']);
        $user = $this->Users->patchEntity($user, [
            'hash'  => $hash,
        ]);

        $recovery_link = 'http://'.$this->request->domain(). $this->recoveryLink .'?'.$this->haskVar.'='.$hash;

        if ($this->Users->save($user)) {

            $Mail = new Email('default');
            $emailRes = $Mail->from(['xain@onix-systems.com' => 'Onix HR Systems'])
                ->to($email)
                ->subject(__('Восстановление доступа к сайту {0}', 'Onix HR Systems'))
                ->send(__('Для того, что-бы восстановить пароль, перейдите по ссылке ').' ссылка: '.$recovery_link);
            $this->Flash->success(__('Листа відправленно'));

        } else {
            $this->Flash->error(__('Не вдалося зберегти налаштування'));
        }
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Positions', 'Skills', 'Specializations']
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $positions = $this->Users->Positions->find('list', ['limit' => 200]);
        $skills = $this->Users->Skills->find('list', ['limit' => 200]);
        $specializations = $this->Users->Specializations->find('list', ['limit' => 200]);
        $this->set(compact('user', 'positions', 'skills', 'specializations'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Positions', 'Skills', 'Specializations']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $positions = $this->Users->Positions->find('list', ['limit' => 200]);
        $skills = $this->Users->Skills->find('list', ['limit' => 200]);
        $specializations = $this->Users->Specializations->find('list', ['limit' => 200]);
        $this->set(compact('user', 'positions', 'skills', 'specializations'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
