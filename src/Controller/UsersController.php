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

    public function beforeFilter(Event $event)
    {
//        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'signup', 'recovery']);
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
                $this->Cookie->write(self::COOKIE_UID, $user['cookieId']);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Неправильний логін чи пароль. Спробуйте ще раз!'));
        }

        $pass = 'adminP';
        $passhash = (new DefaultPasswordHasher)->hash($pass);
        $this->set(compact('pass','passhash'));
    }

    /**
     * Розлогінити користувача з сайту
     */
    public function logout() {
//        $this->Cookie->delete(self::COOKIE_UID);
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Реэстрація нових користувачів
     * @return \Cake\Network\Response|void
     */
    public function signup() {

        $uid = $this->Auth->user('id');
        $user = !empty($uid)?$this->Users->get($uid):null;

        if (!empty($user->email)) {
            $this->Flash->success(__('Ви вже зареєстровані'));
            $this->redirect('/');
        } else {
            $this->Flash->success(__('Можете зареєструватися'));
        }

        if ($this->request->is(['patch', 'post', 'put'])) {

            $this->request->data['hash'] = User::getHash($this->request->data['email'].$user->username);
            $this->request->data['password'] = User::getRandomPass();
            $user = $this->Users->patchEntity($user, $this->request->data);

            if ($this->Users->save($user)) {
                // Вислати посилання для підтвердження і пароль
                $this->Flash->success(__('Регестрація завершена вдало.'));
                //return $this->redirect('/');
            }
            $this->Flash->error(__('Помилака при реєстрації.'));
        }
        $this->set('user', $user);
    }

    /**
     * Recovery tha customer password by email address
     */
    public function recovery() {
        $result = false;

        we($this->request->query);

        if (!empty($this->request->data)) {
            if (!empty($this->request->data['email'])) {
                $user = $this->Users->getByEmail($this->request->data['email']);
                if (!empty($user)) {
                    $result =  true;
                    $this->sendRecoveryEmail($user, $this->request->data['email']);
                } else {
                    $this->Flash->error(__('Электронна пошта не знайдена'));
                }
            } else {
                $this->Flash->error(__('Адрес електронной почты не найден'));
            }
        }
        $this->set(compact('result'));
    }

    /**
     * Send email for recovery to customer
     */
    private function sendRecoveryEmail($user, $email) {
//      we($user['username'].$user['first_name'].$user['gmail'].$user['skype']);
        $hash = User::getHash($user['username'].$user['first_name'].$user['gmail'].$user['skype']);
        $user = $this->Users->patchEntity($user, [
            'hash'  => $hash,
        ]);

        $recovery_link = 'http://'.$this->request->domain().'/users/recovery?byhash='.$hash;

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
