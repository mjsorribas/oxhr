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
            <table class="table table-striped table-bordered table-hover  dataTable" id="editable" role="grid" aria-describedby="editable_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                            <?= __('Name')?>
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style=""><?= __('Groups')?></th>
                        <th class="sorting" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style=""><?= __('Skills')?></th>
                        <th class="sorting" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style=""><?= __('Level')?></th>                        
                        <th class="sorting" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style=""><?= __('Sources')?></th> 
                    </tr>   
                </thead>
                <tbody>
                    <?php if (!empty($usersSkills)):  $i=0;?>                    
                    <?php foreach ($usersSkills as $num => $item): ?>   
                    <?php //we($item)?>                                     
                    <tr class="gradeA odd" role="row">
                        <td><?= $this->Html->link($item['user']->first_name.' '.$item['user']->last_name, ['controller'=>'users', 'action'=>'view', $item['user']->username]);?></td>
                        <td><?= $SkillsGroups[$item['skill']->skills_groups_id]?></td>
                        <td><?= $this->Html->link($item['skill']->name, $item['skill']->link, ['target'=>'_blank'])?></td>
                        <td class="center"><?= $item['level']?></td>
                        <td><?= $item['description'];?></td>
                        <?php /*
                        <div class="btn btn-outline btn-success one-skill-button" 
                            data-developers="" data-skill-description="">
                            <?= $skill?> <sapn title="Developers:"><?= count($item['developers'])?></sapn>, <sapn title="Examples:"><?= count($item['info'])?></sapn>
                        </div>
                        */ ?>
                    </tr>
                    <?php endforeach; ?>                    
                    <?php else: ?>
                    
                    <?php endif ?>
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
