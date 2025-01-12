<?php $form = $this->beginWidget('CActiveForm', [
    'id' => 'permissions-form',
    'enableAjaxValidation' => false,
]); ?>

<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Setting Hak Akses</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Master</a>
                        </li>
                        <li class="breadcrumb-item active">Role</li>
                        <li class="breadcrumb-item active">Hak Akses</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="card shadow-sm">
        <div class="card-header card-primary d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-white">Setting Hak Akses: <?php echo CHtml::encode($model->nama); ?></h5>
        </div>

        <div class="card-body">
            <?php $this->renderPartial('//partials/_notifications'); ?>
            <?php foreach ($permissions as $index => $item): ?>
                <?php if ($item['controller'] == 'auth') continue; ?>

                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white" id="heading<?php echo $index; ?>">

                        <h4 class="mb-0">
                            <button class="btn btn-link b-0 fw-bold text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index; ?>" aria-expanded="true" aria-controls="collapse<?php echo $index; ?>">
                                <?php echo CHtml::encode($item['label']); ?>
                            </button>
                            <input type="checkbox" class="form-check-input float-end" id="checkAll<?php echo $index; ?>" onchange="toggleSubMenu(<?php echo $index; ?>)" <?php echo !empty($existingPermissions[$item['controller']]) ? 'checked' : ''; ?>>
                        </h4>
                    </div>

                    <div id="collapse<?php echo $index; ?>" class="collapse show" aria-labelledby="heading<?php echo $index; ?>">
                        <div class="card-body">
                            <!-- Submenu Checkboxes -->
                            <?php if (isset($item['subMenu']) && is_array($item['subMenu'])): ?>
                                <div class="sub-menu p-3 bg-light rounded">
                                    <?php foreach ($item['subMenu'] as $subIndex => $subItem): ?>
                                        <div class="card mb-2 shadow-sm">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <label class="form-check-label label-space" for="subMenu<?php echo $index . '-' . $subIndex; ?>">
                                                            <?php echo CHtml::encode($subItem['label']); ?>
                                                        </label>
                                                    </div>
                                                    <div class="col-4 text-end">
                                                        <?php foreach ($subItem['actions'] as $action): ?>
                                                            <label>
                                                                <input type="checkbox" class="form-check-input" name="permissions[<?php echo $subItem['controller']; ?>][<?php echo $action; ?>]" id="<?php echo $action . $index . '-' . $subIndex; ?>" value="<?php echo $action; ?>" <?php echo in_array($action, $existingPermissions[$subItem['controller']] ?? []) ? 'checked' : ''; ?>>
                                                                <?php 
                                                                     $formattedAction = preg_replace('/(?<!^)([A-Z])/', ' $1', $action); 
                                                                     echo ucfirst($formattedAction); 
                                                                ?>&nbsp;&nbsp;
                                                            </label>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="action-buttons text-end">
                <button type="button" class="btn btn-primary w-md mb-3" onclick="history.back()">Kembali</button>
                <!-- <?php echo CHtml::submitButton($model->isNewRecord ? 'Simpan' : 'Update', array('class' => 'btn btn-success w-md mb-3')); ?> -->
                <?php echo CHtml::submitButton('Simpan', array('class' => 'btn btn-success w-md mb-3')); ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>

<?php
Yii::app()->clientScript->registerScript('init-collapse', "
// Function to toggle submenu checkboxes
function toggleSubMenu(index) {
    var mainCheckBox = document.getElementById('checkAll' + index);
    var collapseBody = document.getElementById('collapse' + index);
    
    var subItemCheckboxes = collapseBody.querySelectorAll('input[type=\"checkbox\"]');
    
    subItemCheckboxes.forEach(function(subItemCheckbox) {
        if (subItemCheckbox !== mainCheckBox) {
            subItemCheckbox.checked = mainCheckBox.checked;
        }
    });
}

document.querySelectorAll('input[id^=\"checkAll\"]').forEach(function(mainCheckBox) {
    mainCheckBox.addEventListener('change', function() {
        var index = this.id.replace('checkAll', ''); // Extract index from ID
        toggleSubMenu(index);
    });
});

document.querySelectorAll('.collapse').forEach(function(collapseElement) {
    collapseElement.classList.add('show');
});
", CClientScript::POS_READY);


?>