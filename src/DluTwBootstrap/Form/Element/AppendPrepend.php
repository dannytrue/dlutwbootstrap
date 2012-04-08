<?php
namespace DluTwBootstrap\Form\Element;

interface AppendPrepend
{
    /**
     * Sets text to append after the control
     * @param string $text
     */
    public function setAppendText($text);

    /**
     * Returns text to append after the control
     * @return string
     */
    public function getAppendText();

    /**
     * Returns true when the control has the append text
     * @return boolean
     */
    public function hasAppendText();

    /**
     * Sets text to prepend before the control
     * @param string $text
     */
    public function setPrependText($text);

    /**
     * Returns text to prepend before the control
     * @return string
     */
    public function getPrependText();

    /**
     * Returns true when the control has the prepend text
     * @return boolean
     */
    public function hasPrependText();
}