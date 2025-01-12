<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout = '//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array();

	public function checkAccess($menu, $action)
	{
		$roleId = Yii::app()->user->roleId;

		$permissions = Yii::app()->db->createCommand()
			->select('actions')
			->from('permission')
			->where('role_id=:roleId AND menu=:menu', [':roleId' => $roleId, ':menu' => $menu])
			->queryRow();

		if ($permissions) {
			$allowedActions = explode(',', $permissions['actions']);
			return in_array($action, $allowedActions);
		}

		return false;
	}

	public function requireAccess($menu, $action)
    {
        if (!$this->checkAccess($menu, $action)) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }
}
