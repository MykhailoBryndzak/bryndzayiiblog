<?php
namespace app\components;

use yii\web\UrlManager;
use app\models\Lang;

class LangUrlManager extends UrlManager
{
    public function createUrl($params)
    {
        if( isset($params['lang_id']) ){
            //���� ������ ������������� �����, �� ������ ������� ����� ���� � ��,
            //����� �������� � ������ �� ���������
            $lang = Lang::findOne($params['lang_id']);
            if( $lang === null ){
                $lang = Lang::getDefaultLang();
            }
            unset($params['lang_id']);
        } else {
            //���� �� ������ �������� �����, �� �������� � ������� ������
            $lang = Lang::getCurrent();
        }

        //�������� �������������� URL(��� �������� �������������� �����)
        $url = parent::createUrl($params);

        //��������� � URL ������� - ��������� ������������� �����
        if( $url == '/' ){
            return '/'.$lang->url;
        }else{
            return '/'.$lang->url.$url;
        }
    }
}