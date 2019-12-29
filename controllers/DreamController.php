<?php

namespace app\controllers;

use app\components\gui\ActionItem;
use app\components\gui\Breadcrumb;
use app\components\gui\js\Script;
use Yii;
use app\models\dj\Dream;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DreamController implements the CRUD actions for Dream model.
 */
class DreamController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
	{
		$this->addBreadcrumb(new Breadcrumb('Dream Journal', '/'));

		return parent::beforeAction($action);
	}

	/**
     * Lists all Dream models.
     * @return mixed
     */
    public function actionIndex()
    {
		$this->addActionItem(new ActionItem('New', '/dream/new', 'primary'));
		$this->addBreadcrumb(new Breadcrumb('Overview', '', true));

		//Register scripts needed for dreams
		$this->getScriptRegistrar()->registerScript(
			new Script('tagsinput/tagsinput-typeahead.js')
		);
		$this->getScriptRegistrar()->registerScript(
			new Script('summernote.js')
		);


    	$dreams = Dream::find()->orderBy('dreamt_at DESC')->all();

		$dreamsByDay = [];

		if(count($dreams))
		{
			$currentDay = $dreams[0]->getFormattedDate() ?? '';
			foreach($dreams as $dream)
			{
				$dreamDay = $dream->getFormattedDate();
				if($dreamDay != $currentDay)
				{
					$currentDay = $dreamDay;
					$dreamsByDay[] = NULL;
				}
				$dreamsByDay[] = $dream;
			}
		}

        return $this->render('index', [
            'dreams' => $dreamsByDay
        ]);
    }

    /**
     * Displays a single Dream model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Dream model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dream();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Dream model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Dream model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dream model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Dream the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dream::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
