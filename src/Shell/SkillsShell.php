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
     * @param CSV-file
     * @return true
     */
    public function loadusers () {
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
     * @param string $info_line - string with user skills
     * @return bool
     */
    private function saveUserSkill(string $info_line ) {
        $result = false;
        $skLine = $this->parsCSVString($info_line);

        $uskils = [
            'user_id'   => $this->getUserID($skLine['username']),
            'skill_id'  => $this->getSkillID($skLine['skill']),
        ];


        return $result;
    }

    private function getSkillID(string $skill_name) {


    }

    /**
     * @param string $info_line - line from csv file
     * @return array
     */
    private function parsCSVString(string $info_line) {
        $fnames = ['username', 'skills_group', 'skill', 'level', 'skill_link', 'user_description', 'project_repo', 'project_link'];

        $tmp = explode(',', $info_line);
        foreach ($tmp as $key=>$val) {
            $tmp[$fnames[$key]] = trim($val);
        }
        return $tmp;
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