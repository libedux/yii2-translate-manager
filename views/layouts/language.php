<?php
/**
 * @author Lajos Molnár <lajax.m@gmail.com>
 *
 * @since 1.0
 */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use lajax\translatemanager\bundles\TranslateManagerAsset;

/*
 * @var \yii\web\View $this
 * @var string $content
 */
TranslateManagerAsset::register($this);
$this->registerJs(<<<JS
    $('.alert-success').animate({opacity: 1.0}, 3000).fadeOut('slow');
JS
);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <style>

        .navbar-brand img {
            height: 110%;
        }

    </style>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandUrl' => '/translatemanager/language/list',
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
        'brandLabel' => '<img src="../../../../../images/logo.jpg"  class="img-responsive"/>',
    ]);
    $menuItems = [
        ['label' => Yii::t('language', 'Language'), 'items' => [
            ['label' => Yii::t('language', 'List of languages'), 'url' => ['/translatemanager/language/list']],
            ['label' => Yii::t('language', 'Create'), 'url' => ['/translatemanager/language/create']],
        ]],
        ['label' => Yii::t('language', 'Scan'), 'url' => ['/translatemanager/language/scan']],
        ['label' => Yii::t('language', 'Optimize'), 'url' => ['/translatemanager/language/optimizer']],
        ['label' => Yii::t('language', 'Im-/Export'), 'items' => [
            ['label' => Yii::t('language', 'Import'), 'url' => ['/translatemanager/language/import']],
            ['label' => Yii::t('language', 'Export'), 'url' => ['/translatemanager/language/export']],
        ],],
        ['label' => Yii::t('language', 'Admin Panel'), 'url' => ['/'], 'linkOptions' => ['target' => '_blank']],
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?=
        Breadcrumbs::widget([
            'homeLink' => [
                'label' => 'Home',
                'url' => '/my/url',
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])
        ?>
        <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . ' alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message . '</div>';
        } ?>
        <?= Html::tag('h1', Html::encode($this->title)) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Tenniscall | TranslateManager <?= date('Y') ?></p>
        <div class="dropdown dropup pull-right">
            <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown" style="padding: 0">
                <?= '<img src="/images/' . Yii::$app->language . '.png" height="20px"; width="20px">' . ' ' . \common\helpers\AppHelper::getCountryName(Yii::$app->language); ?>

                <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <?php foreach (Yii::$app->params['supportedLanguages'] as $lang): ?>

                    <li><a href="/site/set-lang?langInfo=<?= $lang ?>"><img
                                    src="/images/<?= $lang ?>.png" height="20px" ;
                                    width="20px"> <?= \common\helpers\AppHelper::getCountryName($lang) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
