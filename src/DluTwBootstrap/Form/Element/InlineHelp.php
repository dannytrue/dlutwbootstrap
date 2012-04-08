<?php
namespace DluTwBootstrap\Form\Element;

interface InlineHelp
{
    /**
     * Sets inline help
     * @param string $inlineHelp
     */
    public function setInlineHelp($inlineHelp);

    /**
     * Returns the inline help
     * @return string
     */
    public function getInlineHelp();
}