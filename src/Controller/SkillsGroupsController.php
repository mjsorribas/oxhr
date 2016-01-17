<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SkillsGroups Controller
 *
 * @property \App\Model\Table\SkillsGroupsTable $SkillsGroups
 */
class SkillsGroupsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('skillsGroups', $this->paginate($this->SkillsGroups));
        $this->set('_serialize', ['skillsGroups']);
    }

    /**
     * View method
     *
     * @param string|null $id Skills Group id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $skillsGroup = $this->SkillsGroups->get($id, [
            'contain' => []
        ]);
        $this->set('skillsGroup', $skillsGroup);
        $this->set('_serialize', ['skillsGroup']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $skillsGroup = $this->SkillsGroups->newEntity();
        if ($this->request->is('post')) {
            $skillsGroup = $this->SkillsGroups->patchEntity($skillsGroup, $this->request->data);
            if ($this->SkillsGroups->save($skillsGroup)) {
                $this->Flash->success(__('The skills group has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The skills group could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('skillsGroup'));
        $this->set('_serialize', ['skillsGroup']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Skills Group id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $skillsGroup = $this->SkillsGroups->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $skillsGroup = $this->SkillsGroups->patchEntity($skillsGroup, $this->request->data);
            if ($this->SkillsGroups->save($skillsGroup)) {
                $this->Flash->success(__('The skills group has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The skills group could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('skillsGroup'));
        $this->set('_serialize', ['skillsGroup']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Skills Group id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $skillsGroup = $this->SkillsGroups->get($id);
        if ($this->SkillsGroups->delete($skillsGroup)) {
            $this->Flash->success(__('The skills group has been deleted.'));
        } else {
            $this->Flash->error(__('The skills group could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
