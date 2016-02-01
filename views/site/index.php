<?php

/* @var $this yii\web\View */

use yii\data\ArrayDataProvider;

$this->title = 'Idealista News Demo';
?>
<div class="site-index">

    <div class="jumbotron">
        <div class="box">
            <h1>Información sobre vivienda y economía</h1>
            <p class="lead">La actualidad inmobiliaria, económica y consejos sobre decoración.</p>
            <p><a class="btn btn-lg btn-pink" href="http://www.idealistanews.com">Entrar</a></p>
        </div>
    </div>
    <div class="container">
        <div class="body-content">

            <div class="row">
                <div class="col-md-12">
                    <div class="article">
                        <h2>La economía española cerró 2015 con su mayor crecimiento desde 2007 con un 3,2%</h2>

                        <p>El crecimiento del PIB español se concretó en un 3,2% al cierre de 2015, después del alza del
                            0,8%
                            registrado en el cuarto trimestre, según los datos provisionales publicados por el Instituto
                            Nacional de
                            Estadística (INE). Se trata de la cifra más alta desde 2007 y además coincide con el
                            pronóstico del Banco de España. </p>
                        <p><a class="btn btn-default"
                              href="http://www.idealista.com/news/finanzas-personales/inversion/2016/01/29/740784-la-economia-espanola-cerro2015-con-su-mayor-crecimiento-desde-2007-con-un-3">Leer
                                más</a>
                        </p>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-12">
                    <div class="article">
                        <h2>Informe 'Inmuebles de alquiler' en Enero 2016</h2>
                        <p>Datos tomados para la muestra</p>
                        <?php
                        $data = [
                            '1' => [
                                'id' => '1',
                                'community' => 'Andalucía',
                                'location' => '48',
                                'property' => '15.990'
                            ],
                            '2' => [
                                'id' => '2',
                                'community' => 'Aragón',
                                'location' => '3',
                                'property' => '1.538'
                            ],
                            '3' => [
                                'id' => '3',
                                'community' => 'Extremadura',
                                'location' => '5',
                                'property' => '45'
                            ],
                            '4' => [
                                'id' => '4',
                                'community' => 'Madrid',
                                'location' => '23',
                                'property' => '21.538'
                            ],
                            '5' => [
                                'id' => '5',
                                'community' => 'Galicia',
                                'location' => '16',
                                'property' => '2.390'
                            ],
                        ];

                        function filter($item)
                        {
                            $communityFilter = Yii::$app->request->getQueryParam('community');
                            $locationFilter = Yii::$app->request->getQueryParam('location');
                            $propertyFilter = Yii::$app->request->getQueryParam('property');

                            $return = true;

                            if (strlen($communityFilter) > 0) {
                                if (strstr($item['community'], $communityFilter) !== false) {
                                    $return *= TRUE;
                                } else {
                                    $return *= FALSE;
                                }
                            }

                            if (strlen($locationFilter) > 0) {
                                if ($item['location'] == $locationFilter) {
                                    $return *= TRUE;
                                } else {
                                    $return *= FALSE;
                                }
                            }

                            if (strlen($propertyFilter) > 0) {
                                if ($item['property'] == $propertyFilter) {
                                    $return *= TRUE;
                                } else {
                                    $return *= FALSE;
                                }
                            }
                                return $return;
                        }

                        $filteredData = array_filter($data, 'filter');

                        $provider = new ArrayDataProvider([
                            'allModels' => $filteredData,
                            'sort' => [
                                'attributes' => ['id', 'community', 'location', 'property'],
                            ],
                            'pagination' => [
                                'pageSize' => 10,
                            ],
                        ]);

                        $users = $provider->getModels();
                        $communityFilter = Yii::$app->request->getQueryParam('community', '');
                        $locationFilter = Yii::$app->request->getQueryParam('location', '');
                        $propertyFilter = Yii::$app->request->getQueryParam('property', '');
                        $searchModel = [
                            'id' => null,
                            'community' => $communityFilter,
                            'location' => $locationFilter,
                            'property' => $propertyFilter
                        ];
                        ?>

                        <?= \yii\grid\GridView::widget([
                            'dataProvider' => $provider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'community',
                                    'filter' => '<input class="form-control" name="community" value="'. $searchModel['community'] .'" type="text">',
                                    'value' => 'community',
                                    'label' => 'Comunidad'
                                ],
                                [
                                    'attribute' => 'location',
                                    'filter' => '<input class="form-control" name="location" value="'. $searchModel['location'] .'" type="text">',
                                    'value' => 'location',
                                    'label' => 'Municipios'
                                ],
                                [
                                    'attribute' => 'property',
                                    'filter' => '<input class="form-control" name="property" value="'. $searchModel['property'] .'" type="text">',
                                    'value' => 'property',
                                    'label' => 'Inmuebles'
                                ],
                            ],
                            'layout' => "{items}\n{pager}\n{summary}",
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
