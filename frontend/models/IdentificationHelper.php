<?php

namespace frontend\models;

class IdentificationHelper
{
    public static function getForm($id,$attribute)
    {
        
        $result = '<form style="width:auto;height:auto;color:black;margin:0;" method="post"
         action="/control/update-identification?id=' . $id . '&attribute=' . $attribute . ' ">
                    <input type="hidden" name="_csrf-frontend" value="' . \Yii::$app->request->getCsrfToken() . '">
                    <input type="radio" id="sifatli" value="1" name=' .$attribute .' >
                    <label for="sifatli">Muvofiq</label><br>
                    <input type="radio" id="sifatsiz" value = "0"  name=' .$attribute .' >
                    <label for="sifatsiz">Nomuvofiq</label><br>
                    <button class="btn btn-success" type="submit">Saqlash</button>
                  </form>';
        return $result;

    }
}
