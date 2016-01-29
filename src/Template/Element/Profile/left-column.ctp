    <div class="ibox">
        <div class="ibox-content">
            <h3>About <?= $user->first_name. ' '.$user->last_name;?></h3>

            <p class="small">
                There are many variations of passages of Lorem Ipsum available, but the majority have
                suffered alteration in some form, by injected humour, or randomised words which don't.
                <br>
                <br>
                If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't
                anything embarrassing
            </p>

            <dl>
                <dt><?= __('Принят на работу');?>:</dt>
                <dd>12.05.2015</dd>
                <dt><?= __('День рождения');?>:</dt>
                <dd>12.05.1985</dd>
            </dl>

<?php
    $contacts = ['email', 'gmail', 'skype'];
?>
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?= __('Тип');?></th>
                        <th><?= __('Контакт');?></th>
                    </tr>
                    </thead>
                    <tbody>
                <?php foreach($contacts as $type):?>
                    <tr>
                        <td>1</td>
                        <td><?= __($type);?></td>
                        <td><?= $user->$type;?></td>
                    </tr>
                <?php endforeach;?>
                    </tbody>
                </table>

            <p class="small font-bold">
                <span><i class="fa fa-circle text-navy"></i> Online status</span>
            </p>

        </div>
    </div>

    <!--
    <div class="ibox">
        <div class="ibox-content">
            <h3>Followers and friends</h3>
            <p class="small">
                If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't
                anything embarrassing
            </p>
            <div class="user-friends">
                <a href=""><img alt="image" class="img-circle" src="img/a3.jpg"></a>
                <a href=""><img alt="image" class="img-circle" src="img/a1.jpg"></a>
                <a href=""><img alt="image" class="img-circle" src="img/a2.jpg"></a>
                <a href=""><img alt="image" class="img-circle" src="img/a4.jpg"></a>
                <a href=""><img alt="image" class="img-circle" src="img/a5.jpg"></a>
                <a href=""><img alt="image" class="img-circle" src="img/a6.jpg"></a>
                <a href=""><img alt="image" class="img-circle" src="img/a7.jpg"></a>
                <a href=""><img alt="image" class="img-circle" src="img/a8.jpg"></a>
                <a href=""><img alt="image" class="img-circle" src="img/a2.jpg"></a>
                <a href=""><img alt="image" class="img-circle" src="img/a1.jpg"></a>
            </div>
        </div>
    </div>

    <div class="ibox">
        <div class="ibox-content">
            <h3>Personal friends</h3>
            <ul class="list-unstyled file-list">
                <li><a href=""><i class="fa fa-file"></i> Project_document.docx</a></li>
                <li><a href=""><i class="fa fa-file-picture-o"></i> Logo_zender_company.jpg</a></li>
                <li><a href=""><i class="fa fa-stack-exchange"></i> Email_from_Alex.mln</a></li>
                <li><a href=""><i class="fa fa-file"></i> Contract_20_11_2014.docx</a></li>
                <li><a href=""><i class="fa fa-file-powerpoint-o"></i> Presentation.pptx</a></li>
                <li><a href=""><i class="fa fa-file"></i> 10_08_2015.docx</a></li>
            </ul>
        </div>
    </div>

    <div class="ibox">
        <div class="ibox-content">
            <h3>Private message</h3>

            <p class="small">
                Send private message to Alex Smith
            </p>

            <div class="form-group">
                <label>Subject</label>
                <input type="email" class="form-control" placeholder="Message subject">
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea class="form-control" placeholder="Your message" rows="3"></textarea>
            </div>
            <button class="btn btn-primary btn-block">Send</button>

        </div>
    </div>-->

</div>
