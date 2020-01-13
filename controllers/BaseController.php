<?php


namespace app\controllers;


use app\components\gui\ActionItem;
use app\components\gui\Breadcrumb;
use app\components\gui\js\PackageStore;
use app\components\gui\js\Registrar;
use yii\filters\AccessControl;
use yii\web\Controller;

class BaseController extends Controller
{
	/** @var ActionItem[] $actionItems */
	protected $actionItems = NULL;

	/** @var Breadcrumb[] $breadcrumbs */
	protected $breadcrumbs = NULL;

	/** @var Registrar $scriptRegistrar */
	protected $scriptRegistrar = NULL;

	public function __construct($id, $module, $config = [])
	{
		parent::__construct($id, $module, $config);

		$this->breadcrumbs = new \ArrayObject();
		$this->actionItems = new \ArrayObject();

		//Setup scripts
		$this->scriptRegistrar = new Registrar();
		$packageStore = new PackageStore();
		$this->getScriptRegistrar()->registerPackage(
			$packageStore->getBootstrapPackage()
		);
	}

	public function getScriptRegistrar(): Registrar
	{
		return $this->scriptRegistrar;
	}

	public function addBreadcrumb(Breadcrumb $breadcrumb)
	{
		$this->breadcrumbs[] = $breadcrumb;
	}

	public function addActionItem(ActionItem $actionItem)
	{
		$this->actionItems[] = $actionItem;
	}

	/**
	 * Gets the default controller access which limits the interface
	 * to logged in users.
	 *
	 * @return array
	 */
	public function getDefaultAccess(): array
	{
		return [
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
					]
				]
			]
		];
	}

	public function render($view, $params = [])
	{
		//Set scripts
		$this->view->params['headerScripts'] = $this->getScriptRegistrar()->getHeaderScripts();
		$this->view->params['bodyScripts'] = $this->getScriptRegistrar()->getBodyScripts();
		$this->view->params['breadcrumbs'] = $this->breadcrumbs;
		$this->view->params['actionItems'] = $this->actionItems;

		return parent::render($view, $params);
	}
}