<?php

namespace app\controllers;

use app\components\gui\ActionItem;
use app\components\gui\Breadcrumb;
use app\components\gui\js\Script;
use app\models\dj\DreamCategory;
use app\models\dj\DreamType;
use Rhumsaa\Uuid\Uuid;
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
		$access = $this->getDefaultAccess();
		return $access;
	}

    public function beforeAction($action)
	{
		//Register scripts needed for dreams
		$this->getScriptRegistrar()->registerScript(
			new Script('tagsinput/tagsinput-typeahead.js')
		);

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
		$this->getView()->title = 'View Dream';

		$this->addActionItem(new ActionItem('New', '/dream/new', 'primary'));
		$this->addActionItem(new ActionItem('Edit', '/dream/edit/' . $id, 'secondary'));
		$this->addActionItem(new ActionItem('Delete', '/dream/delete/' . $id, 'danger'));

		$this->addBreadcrumb(new Breadcrumb('View', '', true));

        return $this->render('view', [
            'dream' => $this->findModel($id),
			'dreamTypes' => DreamType::find()->excludeNormal()->all(),
			'dreamTypesDisabled' => true
        ]);
    }

    /**
     * Creates a new Dream model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionNew()
    {
		$this->getView()->title = 'New Dream';
		$this->addBreadcrumb(new Breadcrumb('New', '', true));

		$dream = new Dream();
		$dream->user_id = 1;

		$request = Yii::$app->request;
		if($request->getIsPost())
		{
			$postData = $request->post($dream->formName(), []);
			$categoryIdString = $postData['categories'] ?? "";
			$categories = explode(',', $categoryIdString);
			$types = $postData['types'] ?? [];

			if($postData)
			{
				$dream->attributes = $postData;
				if($dream->save())
				{
					//Add new categories
					if($categories)
					{
						foreach($categories as $category)
						{
							$dreamCategory = DreamCategory::find()->andWhere(['id' => $category])->one();
							if($dreamCategory)
							{
								$dream->link('categories', $dreamCategory);
							}
						}
						$dream->save();
					}

					//Add types
					if($types)
					{
						foreach($types as $typeId => $on)
						{
							$dreamType = DreamType::find()->andWhere(['id' => $typeId])->one();
							if($dreamType)
							{
								$dream->link('types', $dreamType);
							}
						}
						$dream->save();
					}

					return $this->redirect(['view', 'id' => $dream->getId()]);
				}
			}
		}

        return $this->render('_form', [
            'dream' => $dream,
			'dreamTypes' => DreamType::find()->excludeNormal()->all(),
			'dreamTypesDisabled' => false,
			'categoryIdString' => ''
        ]);
    }

    /**
     * Updates an existing Dream model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEdit($id)
    {
		$this->getView()->title = 'Edit Dream';

		$this->addActionItem(new ActionItem('New', '/dream/new', 'primary'));
		$this->addActionItem(new ActionItem('Cancel', '/dream/view/' . $id, 'secondary'));

		$this->addBreadcrumb(new Breadcrumb('Edit', '', true));

        $dream = $this->findModel($id);

		//Add dream to dream categories
		$categories = [];
		foreach($dream->categories as $category)
		{
			$categories[] = $category->getId();
		}
		$categoryIdString = implode(',', $categories);

		$request = Yii::$app->request;
		if($request->getIsPost())
		{
			$postData = $request->post($dream->formName(), []);
			$categoryIdString = $postData['categories'] ?? "";
			$categories = explode(',', $categoryIdString);
			$types = $postData['types'] ?? [];

			if($postData)
			{
				//Remove all previous categories
				$dream->unlinkAll('categories', true);

				//Add new categories
				foreach($categories as $category)
				{
					$dreamCategory = DreamCategory::find()->andWhere(['id' => $category])->one();
					if($dreamCategory)
					{
						$dream->link('categories', $dreamCategory);
					}
				}
				$dream->attributes = $postData;

				//Remove all previous types
				$dream->unlinkAll('types', true);

				//Add new types
				foreach($types as $typeId => $on)
				{
					$dreamType = DreamType::find()->andWhere(['id' => $typeId])->one();
					if($dreamType)
					{
						$dream->link('types', $dreamType);
					}
				}

				if($dream->save())
				{
					return $this->redirect(['view', 'id' => $dream->getId()]);
				}
			}
		}

        return $this->render('_form', [
            'dream' => $dream,
			'dreamTypes' => DreamType::find()->excludeNormal()->all(),
			'dreamTypesDisabled' => false,
			'categoryIdString' => $categoryIdString
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
    protected function findModel($id): Dream
    {
    	$id = Uuid::fromString($id)->getBytes();
        if (($model = Dream::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
