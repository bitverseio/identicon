<?php

namespace Bitverse\Identicon\Generator;

use Bitverse\Identicon\Color\Color;

/**
 * @todo A color factory should be injected allowing to pass
 *       strings to setBackgroundColor
 */
abstract class BaseGenerator implements GeneratorInterface
{
    /**
     * @var Color
     */
    private $backgroundColor;

    /**
     * @var Color
     */
    private $foregroundColor;

    /**
     * {@inheritDoc}
     */
    public function setBackgroundColor($color)
    {
        if ($color instanceof Color) {
            $this->backgroundColor = $color;
            return;
        }

        $this->backgroundColor = Color::parseHex($color);
    }

    /**
     * {@inheritDoc}
     */
    public function setForegroundColor($color)
    {
        if ($color instanceof Color) {
            $this->foregroundColor = $color;
            return;
        }

        $this->foregroundColor = Color::parseHex($color);
    }

    /**
     * Returns the background color.
     *
     * @return Color
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * Returns the background color.
     *
     * @return Color
     */
    public function getForegroundColor()
    {
        return $this->foregroundColor;
    }

    /**
     * Returns a unique color based on the hash.
     *
     * @param string $hash
     *
     * @return Color
     */
    public function getColor($hash)
    {
        return Color::parseHex('#' . substr($hash, 0, 6));
    }

    /**
     * {@inheritDoc}
     */
    abstract public function generate($hash);
}
