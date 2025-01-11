<?php

class AuthController extends Controller
{
    public $layout = '//layouts/auth';
    public function actionLogin()
    {
        $model = new LoginForm;
        
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->login()) {
                $this->redirect(array('auth/dashboard'));
            }
        }
        $this->render('login', array('model' => $model));
    }

    public function actionDashboard()
    {
        if (Yii::app()->user->isGuest) {
            $this->redirect(array('auth/login'));
        }

        $this->layout = '//layouts/app';
        $role = Yii::app()->user->getState('role');
        $this->render('dashboard', array('role' => $role));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}
