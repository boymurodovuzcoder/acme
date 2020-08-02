<?php
use yii\bootstrap\Dropdown;

class LanguageDropdown extends Dropdown
{
    private static $_labels;

    private $_isError;

    public function init()
    {
        $route = Yii::$app->controller->route;
        $appLanguage = Yii::$app->language;
        $params = $_GET;
        $this->_isError = $route === Yii::$app->errorHandler->errorAction;

        array_unshift($params, '/' . $route);

        foreach (Yii::$app->urlManager->languages as $language) {
            $isWildcard = substr($language, -2) === '-*';
            if (
                $language === $appLanguage ||
                // Also check for wildcard language
                $isWildcard && substr($appLanguage, 0, 2) === substr($language, 0, 2)
            ) {
                continue;   // Exclude the current language
            }
            if ($isWildcard) {
                $language = substr($language, 0, 2);
            }
            $params['language'] = $language;
            $this->items[] = [
                'label' => self::label($language),
                'url' => $params,
            ];
        }
        parent::init();
    }

    public function run()
    {
        // Only show this widget if we're not on the error page
        if ($this->_isError) {
            return '';
        } else {
            return parent::run();
        }
    }

    public static function label($code)
    {
        if (self::$_labels === null) {
            self::$_labels = [
                'de' => 'Deutch',
                'en' => 'English',
                'ru' => 'Русский',
            ];
        }

        return isset(self::$_labels[$code]) ? self::$_labels[$code] : null;
    }
}

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
            ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']],
            ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
                ),
                ['label'=>LanguageDropdown::label(Yii::$app->language), 'items' =>LanguageDropdown::widget()]
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
    <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php if(!empty(Yii::$app->session->getFlash('success'))): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?= Yii::$app->session->getFlash('success') ?>
            </div>
        <?php endif; ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
