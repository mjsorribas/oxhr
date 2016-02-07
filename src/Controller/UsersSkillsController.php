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
        $this->bread_crumbs = [
            'Company Skills' => null,
        ];

        $usersSkills = $this->UsersSkills->find('all', [
            'contain' => ['Users', 'Skills'],
            'conditions'    => ['Users.work_finish_date IS' => NULL]
        ])->toArray();


        $skillsGrouping = [];

        foreach ($usersSkills as $item) {
            $skillsGrouping[$item->skill->name]['skill']   = $item->skill;
            $skillsGrouping[$item->skill->name]['developers'][] = $item->user;
            $skillsGrouping[$item->skill->name]['info'][] = [
                'description'   => $item->description,
                'project_repo'  => $item->project_repo,
                'project_link'  => $item->project_link,
            ];
        }

        we($skillsGrouping);

        $this->set('skillsGrouping', $skillsGrouping);
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
            'contain' => ['Users', 'Skills']
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
        $users = $this->UsersSkills->Users->find('list', ['limit' => 200]);
        $skills = $this->UsersSkills->Skills->find('list', ['limit' => 200]);
        $this->set(compact('usersSkill', 'users', 'skills'));
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
        $users = $this->UsersSkills->Users->find('list', ['limit' => 200]);
        $skills = $this->UsersSkills->Skills->find('list', ['limit' => 200]);
        $this->set(compact('usersSkill', 'users', 'skills'));
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

    /**
     * Form to add new and update existed users skills
     */
    public function mySkills() {

    }
}
