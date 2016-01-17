<?php
/**
 * Created by PhpStorm.
 * User: xain
 * Date: 12.01.2016
 * Time: 23:10
 */

namespace App\Shell;

use Cake\Console\Shell;

class SkillsShell extends Shell {

    private $SkGroups = [];

    public function initialize() {

        $this->loadModel('Users');
        $this->loadModel('Skills');
        $this->loadModel('UsersSkills');
    }

    /**
     * Load Skills Groups from Google.Excel file
     * name "Summary of Evaluation of the specialist's skills - Список технологий с которыми работал.csv"
     *
     * #command call
     * bin\cake skills loadgroups tmp\summary-of-skills.csv
     */
    public function loadGroups() {

        $filename = null;

        $skillsGroups = $skills = $skillsToSave = [];

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

            $skill_line = explode(',', $txtline);

            $skill_line[1] = trim($skill_line[1]);
            $skill_line[2] = trim($skill_line[2]);
            $skill_line[4] = trim($skill_line[4]);

            // Save skills Group
            if (!empty($skill_line[1]) && !in_array($skill_line[1], $skillsGroups)) {
                $skillsGroups[] = $skill_line[1];
            }

            // Save skills and groups
            if (!empty($skill_line[2]) && !in_array($skill_line[2], $skills)) {
                $skills[] = $skill_line[2];

                $skillsToSave[] = [
                    'group' => $skill_line[1],
                    'skill' => $skill_line[2],
                    'link' => $skill_line[4]
                ];
            }
        }
        fclose($handle);
        // Save Skills Groups
        $this->saveSkillsGroups($skillsGroups);
        // Save Skiils and connections to Groups
        $this->saveSkills($skillsToSave);
    }

    /**
     * Save parsed groups of skills
     * @param array $groups
     * @return true if all save successful;
     */
    private function saveSkillsGroups($groups = []) {

        $this->out('Save Skills Groups!!!!');

        if (empty($groups)) return $this->out('Warning! No groups to save.');

        $this->loadModel('SkillsGroups');
        foreach ($groups as $item) {
            $skillsGroup = $this->SkillsGroups->newEntity();
            $skillsGroup = $this->SkillsGroups->patchEntity($skillsGroup, ['name' => $item]);
            if ($this->SkillsGroups->save($skillsGroup)) {
                $this->SkGroups[strtolower($skillsGroup['name'])] = $skillsGroup['id'];
            } else {
                $this->out('Not saved! Group: ' . $item);
                print_r($skillsGroup);
            }
        }
        return true;
    }

    /**
     * @param array $skillsToSave
     * @return true if all save successful
     */
    private function saveSkills($skillsToSave = []) {

        $this->out('Save Skills!!!!');

        if (empty($skillsToSave)) return $this->out('Error! Empty skills groups.');

        $this->loadModel('Skills');

        foreach ($skillsToSave as $item) {
            if (empty($this->SkGroups[strtolower($item['group'])])) {
                $this->out('Error! Group ID not found: '.$item['group']);
                continue;
            }
            $skill = $this->Skills->newEntity();
            $skill = $this->Skills->patchEntity($skill, [
                'name' => $item['skill'],
                'link' => $item['link'],
                'skills_groups_id'  => $this->SkGroups[strtolower($item['group'])]
            ]);
            if ($this->Skills->save($skill)) {

            } else {
                $this->out('Error! Skill not saved');
                print_r($skill);
            }
        }
        return true;
    }

    /**
     * Load information about users skills to the database
     * Data from this file https://docs.google.com/spreadsheets/d/1xX7H8xuoICtYt1sJLZjWGYWqFiqdbp4lkQy2GQ_V7oM/edit#gid=0
     *
     * Example: bin\cake skills loaduserssk tmp\summary-of-skills.csv
     *
     * @param CSV-file
     * @return true
     */
    public function loaduserssk () {
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
            $this->saveUserSkill($txtline);

        }
        fclose($handle);

        return true;
    }

    /**
     * @param $info_line - string with user skills
     * @return bool
     */
    private function saveUserSkill($info_line ) {
        $skLine = $this->parsCSVString($info_line);

        $this->out($info_line);

        $uskils = [
            'user_id'   => $this->getUserID($skLine['username']),
            'skill_id'  => $this->getSkillID($skLine['skill']),
            'level'         => $skLine['level'],
            'description'   => $skLine['user_description'],
            'project_repo'  => $skLine['project_repo'],
            'project_link'  => $skLine['project_link'],
        ];

        $skill = $this->UsersSkills->newEntity();
        $skill = $this->UsersSkills->patchEntity($skill, $uskils);

        if ($this->UsersSkills->save($skill)) {
            return $this->out($skill['id']);
        } else {
            print_r($skill);
        }

        return false;
    }

    /**
     * Get skills ID by name
     * @param $skill_name - the name fro
     * @return bool
     */
    private function getSkillID($skill_name) {

        $skill = $this->Skills->find('all', [
            'fields'    => ['id'],
            'conditions'    => ['name' => $skill_name],
            'contain'   => [],
        ])->first();

        if (!empty($skill)) {
            return $skill['id'];
        } else {
            return false;
        }

    }

    /**
     * @param string $info_line - line from csv file
     * @return array
     */
    private function parsCSVString($info_line) {
        $fnames = ['username', 'skills_group', 'skill', 'level', 'skill_link', 'user_description', 'project_repo', 'project_link', 'coefficient', '9', '10', '11', '12'];

        $tmp = explode(',', $info_line);
        $res = [];
        foreach ($tmp as $key=>$val) {
            $res[$fnames[$key]] = trim($val);
        }
        return $res;
    }

    /**
     * @param string $username, example 'first_name last_name'
     * @return bool
     */
    private function getUserID($username) {
        $udata = explode(' ', $username);

        $user = $this->Users->find('all', [
            'fields'        => ['id'],
            'conditions'    => ['first_name' => $udata[0], 'last_name' => $udata[1]],
            'contain'       => []
        ])->first();

        if (!empty($user)) {
            return $user['id'];
        } else {
            return false;
        }
    }
}