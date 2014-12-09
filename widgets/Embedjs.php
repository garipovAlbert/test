<?php

namespace app\widgets;

use yii\web\View;
use yii\widgets\Block;

/**
 * @link https://github.com/mitrii/yii2-embedjs
 */
class Embedjs extends Block
{

    public $position = View::POS_READY;
    public $key;

    static function begin($config = [])
    {
        $config = is_array($config) ? $config : ['position' => $config];
        parent::begin($config);
    }

    public function run()
    {
        $block = ob_get_clean();

        $block = trim($block);

        $jsBlockPattern = '|^<script[^>]*>(?P<block_content>.+?)</script>$|is';
        if (preg_match($jsBlockPattern, $block, $matches)) {
            $block = $matches['block_content'];
        }

        $key = (empty($this->key)) ? md5($block) : $this->key;

        $this->view->registerJs($block, $this->position, $key);
    }

}