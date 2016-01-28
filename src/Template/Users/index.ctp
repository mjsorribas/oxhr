<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Editable Table in- combination with jEditable</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="">
                    <a onclick="fnClickAddRow();" href="javascript:void(0);" class="btn btn-primary ">Add a new row</a>
                </div>
                <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <!--<div class="col-sm-6">
                            <div class="dataTables_length" id="editable_length"><label>Show <select
                                        name="editable_length" aria-controls="editable" class="form-control input-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> entries</label></div>
                        </div>-->
                        <div class="col-sm-6">
                            <div id="editable_filter" class="dataTables_filter">
                                <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="editable"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered table-hover  dataTable" id="editable"
                                   role="grid" aria-describedby="editable_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="editable" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="User Name" style="width:50px;"><?= $this->Paginator->sort('id') ?></th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="editable" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="User Name">
                                        Name
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="editable" rowspan="1" colspan="1"
                                        aria-label="<?= __('Внутренняя электронная почта');?>">
                                        Email
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="editable" rowspan="1" colspan="1"
                                        aria-label="Gmail: activate to sort column ascending"
                                        >Gmail
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="editable" rowspan="1" colspan="1"
                                        aria-label="Skype: activate to sort column ascending">
                                        Skype
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="editable" rowspan="1" colspan="1"
                                        aria-label="Table #: activate to sort column ascending">
                                        Table #
                                    </th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>

                                </thead>

                                <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr class="gradeA odd" role="row">
                                        <td class="center"><?= $this->Number->format($user->id) ?></td>
                                        <td><?= h($user->first_name. ' ' .$user->last_name) ?></td>
                                        <td><?= h($user->email) ?></td>
                                        <td><?= h($user->gmail) ?></td>
                                        <td><?= h($user->skype) ?></td>
                                        <td><?= h($user->table_num) ?></td>
                                        <td class="actions">
                                            <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                                <!--<tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">Rendering engine</th>
                                    <th rowspan="1" colspan="1">Browser</th>
                                    <th rowspan="1" colspan="1">Platform(s)</th>
                                    <th rowspan="1" colspan="1">Engine version</th>
                                    <th rowspan="1" colspan="1">CSS grade</th>
                                </tr>
                                </tfoot>-->
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="editable_info" role="status" aria-live="polite">Showing 1
                                to 10 of 57 entries
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="editable_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button previous disabled" id="editable_previous"><a href="#"
                                                                                                            aria-controls="editable"
                                                                                                            data-dt-idx="0"
                                                                                                            tabindex="0">Previous</a>
                                    </li>
                                    <li class="paginate_button active"><a href="#" aria-controls="editable"
                                                                          data-dt-idx="1" tabindex="0">1</a></li>
                                    <li class="paginate_button "><a href="#" aria-controls="editable" data-dt-idx="2"
                                                                    tabindex="0">2</a></li>
                                    <li class="paginate_button "><a href="#" aria-controls="editable" data-dt-idx="3"
                                                                    tabindex="0">3</a></li>
                                    <li class="paginate_button "><a href="#" aria-controls="editable" data-dt-idx="4"
                                                                    tabindex="0">4</a></li>
                                    <li class="paginate_button "><a href="#" aria-controls="editable" data-dt-idx="5"
                                                                    tabindex="0">5</a></li>
                                    <li class="paginate_button "><a href="#" aria-controls="editable" data-dt-idx="6"
                                                                    tabindex="0">6</a></li>
                                    <li class="paginate_button next" id="editable_next"><a href="#"
                                                                                           aria-controls="editable"
                                                                                           data-dt-idx="7" tabindex="0">Next</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>


<!-- --------------------------------------------------------------------------------- -->
