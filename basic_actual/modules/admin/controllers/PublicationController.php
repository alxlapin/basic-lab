<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Publication;
use app\modules\admin\models\PublicationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PublicationController implements the CRUD actions for Publication model.
 */
class PublicationController extends Controller
{
    /**
     * @inheritdoc
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

    /**
     * Lists all Publication models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PublicationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 25;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Publication model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Publication model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Publication();
        $model->scenario = 'create';

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->attach = UploadedFile::getInstance($model, 'attach');
            if ($model->validate()) {
                $model->save();
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Updates an existing Publication model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';

        $model->provideConnectedInfo();
        $model->month = (new \DateTime($model->public_date))->format('m');
        $model->year = (new \DateTime($model->public_date))->format('Y');

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->attach = UploadedFile::getInstance($model, 'attach');
            if ($model->validate()) {
                $model->save();
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Deletes an existing Publication model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionMultiDelete()
    {
        if (Yii::$app->request->isAjax) {
            $values = Yii::$app->request->post('mass');
            if (!empty($values)) {
                Yii::$app->db->createCommand()->delete(Publication::tableName(), ['in', 'id', $values])->execute();
                return 'Files deleted';
            } else {
                return 'Nothing to delete';
            }
        }
    }

    /**
     * Finds the Publication model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Publication the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Publication::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
