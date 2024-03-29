<div class="row m-b-lg m-t-lg">
    <div class="col-md-6">

        <div class="profile-image">
    <!--        <img src="img/a4.jpg" class="img-circle circle-border m-b-md" alt="profile">-->
            <?= $this->Html->image('users/profile-placeholder.png', ['class' => 'img-circle circle-border m-b-md', 'alt' => $user->first_name. ' '.$user->last_name]);?>

        </div>
        <div class="profile-info">
            <div class="">
                <div>
                    <h2 class="no-margins">
                        <?= $user->first_name. ' '.$user->last_name; ?>
                    </h2>
                    <h4> <?= !empty($user->specializations[0]->name)?$user->specializations[0]->name:'- '.__('должность не установленна').' -';?> </h4>
                    <small>
                        Описание сотрудника.
                    </small>
                    <p></p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <table class="table small m-b-xs">
            <tbody>
            <tr>
                <td>
                    <strong><?= $user->year_in_company?></strong> <?= __('years in company');?>
                </td>
                <td>
                    <strong><?= $user->age; ?></strong> <?= __('age');?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>&mdash;</strong> Comments
                </td>
                <td>
                    <strong>&mdash;</strong> Articles
                </td>
            </tr>
            <tr>
                <td>
                    <strong>&mdash;</strong> Tags
                </td>
                <td>
                    <strong>&mdash;</strong> Friends
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="col-md-3">
        <small>Sales in last 24h</small>
        <h2 class="no-margins">206 480</h2>
        <div id="sparkline1"><canvas width="386" height="50" style="display: inline-block; width: 386px; height: 50px; vertical-align: top;"></canvas></div>
    </div>
</div>