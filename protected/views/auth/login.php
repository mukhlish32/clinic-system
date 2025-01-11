<?php $this->pageTitle = 'Login'; ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center mt-sm-5 mb-4 text-white-50">
                <div>
                    <a href="<?php echo Yii::app()->homeUrl; ?>" class="d-inline-block auth-logo">
                        <!-- You can put a logo here -->
                        <img src="<?php echo Yii::app()->baseUrl . '/images/logo/logo-horizontal-white.png'; ?>" alt="" height="50">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mt-4 card-bg-fill">
                <div class="card-body p-4">
                    <div class="text-center mt-2">
                        <a href="<?php echo Yii::app()->homeUrl; ?>" class="d-inline-block auth-logo">
                            <img src="<?php echo Yii::app()->baseUrl . '/images/logo/logo-horizontal.png'; ?>" alt="Vendor Logo" style="width: 150px; height: auto;">
                        </a>
                    </div>
                    <div class="p-2 mt-4">
                        <? $this->renderPartial('//partials/notifications'); ?>

                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'login-form',
                            'enableClientValidation' => true,
                            'clientOptions' => array(
                                'validateOnSubmit' => true,
                            ),
                            'htmlOptions' => array('class' => 'form-horizontal'),
                        ));
                        ?>

                        <div class="mb-3">
                            <?php echo $form->label($model, 'username', array('class' => 'form-label')); ?>
                            <span style="color:red;">*</span>
                            <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'required' => true)); ?>
                            <?php echo $form->error($model, 'username'); ?>
                        </div>

                        <div class="mb-3">
                            <?php echo $form->label($model, 'password', array('class' => 'form-label')); ?>
                            <span style="color:red;">*</span>
                            <div class="position-relative auth-pass-inputgroup mb-3">
                                <?php echo $form->passwordField($model, 'password', array('class' => 'form-control pe-5 password-input', 'required' => true)); ?>
                                <button type="button" class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none" id="password-addon">
                                    <i class="ri-eye-fill align-middle"></i>
                                </button>
                            </div>
                            <?php echo $form->error($model, 'password'); ?>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-success w-100" type="submit">LOGIN</button>
                        </div>

                        <?php $this->endWidget(); ?>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
    <!-- end row -->
</div>

<?php
// Registering external JS files
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/assets/velzon/libs/particles.js/particles.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/assets/velzon/js/pages/particles.app.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/assets/velzon/js/pages/password-addon.init.js', CClientScript::POS_END);

// Inline JS for password toggle functionality
Yii::app()->clientScript->registerScript('password-toggle', "
    $(document).ready(function () {
        $('#password-addon').on('click', function () {
            var input = $('#password-input');
            var type = input.attr('type') === 'password' ? 'text' : 'password';
            input.attr('type', type);
            $(this).toggleClass('ri-eye-off-fill');
        });
    });
", CClientScript::POS_READY);
?>