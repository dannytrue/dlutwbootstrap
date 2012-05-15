<?php
namespace DluTwBootstrap\View\Helper\Navigation;

abstract class AbstractButtonHelper extends AbstractHelper
{
    const TYPE_VERTICAL = 'vertical';

    const TYPE_GROUP    = 'group';

    /* *********************** METHODS *************************** */

    protected function decorateContainer($content,
                                         \Zend\Navigation\Container $container,
                                         $renderIcons = true,
                                         $activeIconInverse = true,
                                         array $options = array()) {
        if(array_key_exists('type', $options) && $options['type'] == self::TYPE_GROUP) {
            $html   = '<div class="btn-group">'
                    . "\n" . $content
                    . "\n</div>";
        } else {
            $html   = $content;
        }
        return $html;
    }

    protected function decorateNavHeader($content,
                                         \Zend\Navigation\Page\AbstractPage $item,
                                         $renderIcons = true,
                                         $activeIconInverse = true,
                                         array $options = array()) {
        return $content;
    }

    protected function decorateDivider($content,
                                       \Zend\Navigation\Page\AbstractPage $item,
                                       array $options = array()) {
        return $content;
    }

    protected function decorateLink($content,
                                    \Zend\Navigation\Page\AbstractPage $page,
                                    $renderIcons = true,
                                    $activeIconInverse = true,
                                    array $options = array()) {
        if(array_key_exists('type', $options) && $options['type'] == self::TYPE_VERTICAL) {
            $html   = '<p>'
                    . $content
                    . '</p>';
        } else {
            $html   = $content;
        }
        return $html;
    }

    protected function decorateDropdown($content,
                                        \Zend\Navigation\Page\AbstractPage $page,
                                        $renderIcons = true,
                                        $activeIconInverse = true,
                                        array $options = array()) {
        $html   = '<div class="btn-group">'
                . $content
                . "\n</div>";
        return $html;
    }

    protected function renderLink(\Zend\Navigation\Page\AbstractPage $page,
                                  $renderIcons = true,
                                  $activeIconInverse = true,
                                  array $options = array()) {
        $class  = $page->getClass();
        $this->addWord('btn', $class);
        if($page->isActive(true)) {
            $this->addWord('active', $class);
        }
        $page->setClass($class);
        $html   = parent::renderLink($page, $renderIcons, $activeIconInverse, $options);
        return $html;
    }

    protected function renderDropdown(\Zend\Navigation\Page\AbstractPage $page,
                                      $renderIcons = true,
                                      $activeIconInverse = true,
                                      array $options = array()) {
        $class  = $page->getClass();
        $this->addWord('btn', $class);
        if($page->isActive(true)) {
            $this->addWord('active', $class);
        }
        $page->setClass($class);
        $html   = parent::renderDropdown($page, $renderIcons, $activeIconInverse, $options);
        return $html;
    }
}