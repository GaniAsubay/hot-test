<?php

namespace app\modules\api\controllers;

use app\models\Comment;
use app\modules\api\forms\search\CommentApiSearch;
use app\modules\api\models\CommentApi;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Default controller for the `api` module
 */
class CommentController extends ActiveController
{

    public function behaviors()
    {
        $behaviors = parent::behaviors(); // TODO: Change the autogenerated stub
        $behaviors['contentNegotiator']['formats'] = ['application/json' => Response::FORMAT_JSON];

        return $behaviors;
    }

    /** @var Comment */
    public $modelClass = CommentApi::class;

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    protected function verbs()
    {
        return [
            'index' => ['GET'],
            'one' => ['GET'],
            'create' => ['POST'],
        ];
    }

    public function actions()
    {
        return []; // TODO: Change the autogenerated stub
    }

    /**
     * Renders the index view for the module
     * @return string
     */

    /**
     * @return void|\yii\data\ActiveDataProvider
     */
    public function actionIndex()
    {
        try {
            $searchModel = new CommentApiSearch();
            $data = $searchModel->search(\Yii::$app->request->queryParams);
            $this->response->statusCode = 200;
            return $data;
        } catch (\Exception $e) {
            $this->response->statusCode = $e->getCode();
            $this->response->data = ['message' => $e->getMessage()];
            return;
        }
    }

    /**
     * @param $id
     * @return Comment|void|null
     */
    public function actionView($id)
    {
        try {
            $model = CommentApi::findOne($id);
            if (!$model) {
                throw new NotFoundHttpException('Comment Not Found', 404);
            }
            $this->response->statusCode = 200;
            return $model;
        } catch (\Exception $e) {
            $this->response->statusCode = $e->getCode();
            $this->response->data = ['message' => $e->getMessage()];
        }
    }

    /**
     * Creates a new Comment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Comment();
        \Yii::$app->commentService->setAdditionalAttributes($model);
        if ($model->load($this->request->post(), '') && $model->save()) {
            $this->response->statusCode = 201;
            return $model;
        } else {
            $model->validate();
            return $model;
        }
    }
}
