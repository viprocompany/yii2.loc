<?php

namespace app\modules\admin\controllers;


/**
 * Default controller for the `admin` module
 */
//меняем раширение на AppAdminController - наш кастомный класс-контроллер нашего модуля, чтобы закрыть все наши контролееры модуля извне
class DefaultController extends AppAdminController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
