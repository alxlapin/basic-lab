<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\TagSearch;
use Yii;

use app\models\Post;
use app\models\PostStorage;
use app\models\UploadForm;
use app\modules\admin\models\PostSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 25;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
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
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        $uploadModel = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->post_author_id = Yii::$app->user->id;
            $uploadModel->files = UploadedFile::getInstances($uploadModel, 'files');
            if ($model->validate() && $uploadModel->validate()) {
                $model->save();
                $fileInfo = $uploadModel->upload();
                if (!empty($fileInfo)) {
                    foreach ($fileInfo as $fileItem) {
                        $ps = new PostStorage();
                        $ps->post_id = $model->id;
                        $ps->file_name = $fileItem[0];
                        $ps->storage_path = $fileItem[1];
                        $ps->save();
                    }
                }
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'uploadModel' => $uploadModel,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->provideTagNames();
        $uploadModel = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->filesToBeDeleted = Yii::$app->request->post('filesToBeDeleted');
            $uploadModel->files = UploadedFile::getInstances($uploadModel, 'files');
            if ($model->validate() && $uploadModel->validate()) {
                $model->save();
                $fileInfo = $uploadModel->upload();
                if (!empty($fileInfo)) {
                    foreach ($fileInfo as $fileItem) {
                        $ps = new PostStorage();
                        $ps->post_id = $model->id;
                        $ps->file_name = $fileItem[0];
                        $ps->storage_path = $fileItem[1];
                        $ps->save();
                    }
                }
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'uploadModel' => $uploadModel,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
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
                Yii::$app->db->createCommand()->delete(Post::tableName(), ['in', 'id', $values])->execute();
                return 'Files deleted';
            } else {
                return 'Nothing to delete';
            }
        }
    }
    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionHi() {
        return 'Go';
    }

}
