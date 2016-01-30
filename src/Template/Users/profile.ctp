<div class="wrapper wrapper-content animated fadeInRight">
    <?= $this->element('Profile/profile-top-line', ['user' => $user]); ?>

    <div class="row">
        <div class="col-lg-3">
            <?= $this->element('Profile/profile-contacts', ['user' => $user]); ?>
            <?= $this->element('Profile/profile-career', ['user' => $user]); ?>
            <?= $this->element('Profile/profile-career', ['user' => $user]); ?>
        </div>

        <div class="col-lg-5">
            <?= $this->element('Profile/profile-skills', ['user' => $user]); ?>
            <?= $this->element('Profile/profile-center-column', ['user' => $user]); ?>

        </div>

    </div>

</div>
