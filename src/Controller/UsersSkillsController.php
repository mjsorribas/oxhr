<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UsersSkills Controller
 *
 * @property \App\Model\Table\UsersSkillsTable $UsersSkills
 */
class UsersSkillsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('usersSkills', $this->paginate($this->UsersSkills));
        $this->set('_serialize', ['usersSkills']);
    }

    /**
     * View method
     *
     * @param string|null $id Users Skill id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersSkill = $this->UsersSkills->get($id, [
            'contain' => []
        ]);
        $this->set('usersSkill', $usersSkill);
        $this->set('_serialize', ['usersSkill']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usersSkill = $this->UsersSkills->newEntity();
        if ($this->request->is('post')) {
            $usersSkill = $this->UsersSkills->patchEntity($usersSkill, $this->request->data);
            if ($this->UsersSkills->save($usersSkill)) {
                $this->Flash->success(__('The users skill has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The users skill could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('usersSkill'));
        $this->set('_serialize', ['usersSkill']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Skill id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usersSkill = $this->UsersSkills->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersSkill = $this->UsersSkills->patchEntity($usersSkill, $this->request->data);
            if ($this->UsersSkills->save($usersSkill)) {
                $this->Flash->success(__('The users skill has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The users skill could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('usersSkill'));
        $this->set('_serialize', ['usersSkill']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Skill id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersSkill = $this->UsersSkills->get($id);
        if ($this->UsersSkills->delete($usersSkill)) {
            $this->Flash->success(__('The users skill has been deleted.'));
        } else {
            $this->Flash->error(__('The users skill could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
