<?php

namespace backend\controllers\shopping;
use common\models\shopping\ShoppingNotice;
use common\models\shopping\NoticeSearch;
use common\models\shopping\InstructionSearch;
use common\models\shopping\ProductSearch;
use common\models\shopping\Instruction;
use yii\web\Controller;
use yii\filters\VerbFilter;
use Yii;

class ShoppingController extends Controller
{
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

    public function actionIndex()
    {
        $searchModel = new InstructionSearch(null);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('/shopping/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    

    public function actionNoticeView()
    {
        $searchModel = new InstructionSearch(null);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('/shopping/notice-view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    

    public function actionView($id)
    {
        return $this->render('/shopping/view', [
            'model' => Instruction::findOne($id),
        ]);
    }
    protected function findModel($id)
    {
        if (($model = ShoppingNotice::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
