<?php
namespace DluTwBootstrap\Form\Element;

interface PlaceholderText
{
    /**
     * Sets the placeholder text
     * @param string $placeholderText
     */
    public function setPlaceholderText($placeholderText);

    /**
     * Returns the placeholder text
     * @return string
     */
    public function getPlaceholderText();
}