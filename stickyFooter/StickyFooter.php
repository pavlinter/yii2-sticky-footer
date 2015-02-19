<?php

/**
 * @package yii2-stickyFooter
 * @author Pavels Radajevs <pavlinter@gmail.com>
 * @copyright Copyright &copy; Pavels Radajevs <pavlinter@gmail.com>, 2015
 * @version 1.0.0
 */

namespace pavlinter\stickyFooter;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * Class StickyFooter
 */
class StickyFooter extends Widget
{
    /**
     * @var string the id widget.
     */
    public $id;
    /**
     * @var array the HTML attributes for the widget container tag.
     */
    public $options = [];
    /**
     * @var array javascript settings
     */
    public $clientOptions = [];
    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();

        if (isset($this->options['id'])) {
            $this->id = $this->options['id'];
        } else {
            if ($this->id === null) {
                $this->id = $this->options['id'] = $this->getId();
            } else {
                $this->options['id'] = $this->id;
            }
        }
        echo Html::beginTag('div', $this->options) . "\n";
    }

    /**
     *
     */
    public function run()
    {
        echo Html::endTag('div');
        $view = $this->getView();
        $this->registerScript($view);
    }

    /**
     * @param $view \yii\web\View
     */
    public function registerScript($view)
    {
        StickyFooterAsset::register($view);
        $view->registerJs('jQuery("#' . $this->id .'").stickyFooter(' . Json::encode($this->clientOptions) . ');');
    }
}
