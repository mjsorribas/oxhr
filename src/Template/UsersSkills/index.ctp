<div class="col-lg-12">
    <div class="row ibox float-e-margins">
        
        <div class="col-lg-9">  
                                  
            <!-- Block Title -->
            <div class="ibox-title">
                <h5><?= __('Users Skills') ?></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!-- 
                        <li><a href="#">Config option 1</a></li>
                        <li><a href="#">Config option 2</a></li>
                        -->
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <!-- END Block Title -->            
            <!-- Content Block -->
            <div class="ibox-content">
            <table id="company-skills" class="table table-striped table-bordered table-hover  dataTable" id="editable" role="grid" aria-describedby="editable_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" style="width:130px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                            <?= __('Name')?>
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width:136px;"><?= __('Groups')?></th>
                        <th class="sorting" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width:157px;"><?= __('Skills')?></th>
                        <th class="sorting" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width:35px;"><?= __('Level')?></th>                        
                        <th class="sorting" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style=""><?= __('Sources')?></th> 
                    </tr>
                    <tr>
                        <td class="table-select">
                            <?= $this->Form->input('select_user', ['options' => $users, 'label'=>false, 'id'=>'usersFilter', 'empty' => '- All - ', 'default' => null]);?>
                        </td>
                        <td>
                            <?= $this->Form->input('select_group', ['options' => $skillsGroups, 'label'=>false, 'id'=>'groupFilter', 'empty' => '- All - ', 'default' => null]);?>
                        </td>
                        <td>
                            <?= $this->Form->input('select_skills', ['options' => $skills, 'label'=>false, 'id'=>'skillsFilter', 'empty' => '- All - ', 'default' => null]);?>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usersSkills)):  $i=0;?>
                    <?php foreach ($usersSkills as $num => $item): ?>   
                    <?php //we($item)?>                                     
                    <tr class="gradeA odd" role="row">
                        <td class="user-id-<?= $item['user']->id?>"><?= $this->Html->link($item['user']->first_name.' '.$item['user']->last_name, ['controller'=>'users', 'action'=>'view', $item['user']->username]);?></td>
                        <td class="sgroup-id-<?= $item['skill']->skills_groups_id;?>"><?= !empty($skillsGroups[$item['skill']->skills_groups_id])?$skillsGroups[$item['skill']->skills_groups_id]:$item['skill']->skills_groups_id?></td>
                        <td class="skill-id-<?= $item['skill']->id?>"><?= $this->Html->link($item['skill']->name, $item['skill']->link, ['target'=>'_blank'])?></td>
                        <td class="center"><?= $item['level']?></td>
                        <td><?= $item['description'];?></td>
                    </tr>
                    <?php endforeach; ?>                    
                    <?php else: ?>
                    
                    <?php endif;  ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th rowspan="1" colspan="1"><?= __('Name')?></th>
                        <th rowspan="1" colspan="1"><?= __('Groups')?></th>
                        <th rowspan="1" colspan="1"><?= __('Skills')?></th>
                        <th rowspan="1" colspan="1"><?= __('Level')?></th>
                        <th rowspan="1" colspan="1"><?= __('Sources')?></th>
                    </tr>
                <tfoot>
             </table>  
             
             <div class="row">&nbsp;</div> 
                
            </div>
            <!-- END Content Block -->            
        </div>
        <!-- END Col-lg-9 -->
   </div>
</div>
<script>
$(function(){
   /* $("#usersFilter, #groupFilter, #skillsFilter").select2({});
    
    $("#usersFilter").change(function(){
        var userId = $(this).val()*1; 
        var rowClass = "tr.odd";
        
        if (userId > 0 ) {
            $(rowClass).hide();
            $(".user-id-"+userId).parent(rowClass).show();
        } else {
            $(rowClass).show();
        }
    });*/
    sklTbl.initRunFilter();
});

/**
 * Класс обработки поиска в таблице Скилов
 * @type {{}}
 */
var sklTbl = {

    // Selected user id from select-input field
    userID:      '',
    inputUserID: '#usersFilter',
    prefixUserID: '.user-id-',

    // Selected Skill Group id
    sGroupID: '',
    inputSkillGroupID: '#groupFilter',
    prefixSGroupID: '.sgroup-id-',

    // Selected Skill id Group
    skillID : '',
    inputSkillID: '#skillsFilter',
    prefixSkillID: '.skill-id-',

    // Skills Table ID
    sklTblID: '#company-skills',

    // Row class
    oneRowClass: 'tr.odd',

    initRunFilter: function() {
        var inputs = [
          this.inputUserID,
          this.inputSkillGroupID,
          this.inputSkillID
        ];
        $( inputs.join(',')).change(function(){
            sklTbl.filterTbl();
        });
    },

    /**
     * Filtering the table
     */
    filterTbl: function () {
        $(this.sklTblID+' '+this.oneRowClass).hide();
        $(this.getFilterSelector()).parent(this.oneRowClass).show();
    },

    /**
     *  Show all users skills
     */
    clearFilter: function() {
        $(this.sklTblID+' '+this.oneRowClass).show();
    },

    /**
     * Prepare selector to select the row to show
     */
    getFilterSelector: function() {

        this.getFilteredValue();

        var selector = [];

        if (this.userID != '') {
            selector.push(this.prefixUserID + this.userID);
        }

        if (this.sGroupID != '') {
            selector.push(this.prefixSGroupID + this.sGroupID);
        }

        if (this.skillID != '') {
            selector.push(this.prefixSkillID + this.skillID);
        }

        selector = selector.join(',');
        console.log(selector);
        return selector;
    },

    /**
     * Get data for filter
     */
    getFilteredValue: function () {
        // Get filter by user ID
        this.userID     = $(sklTbl.inputUserID).val();
        // Get filter by Skill Group ID
        this.sGroupID   = $(sklTbl.inputSkillGroupID).val();
        // Get filter by Skill ID
        this.skillID    = $(sklTbl.inputSkillID).val();

    }

};
</script>
    