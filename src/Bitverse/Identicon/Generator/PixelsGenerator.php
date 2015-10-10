<?php

namespace Bitverse\Identicon\Generator;

use Bitverse\Identicon\Color\Color;
use Bitverse\Identicon\SVG\Svg;
use Bitverse\Identicon\SVG\Rectangle;

class PixelsGenerator implements GeneratorInterface
{
    /**
     * @var Color
     */
    private $backgroundColor;

    /**
     * {@inheritDoc}
     */
    public function setBackgroundColor(Color $color)
    {
        $this->backgroundColor = $color;
    }

    /**
     * {@inheritDoc}
     */
    public function generate($hash)
    {
        $svg = (new Svg(480, 480))->addChild($this->getBackground());

        for ($i=0; $i<5; ++$i) {
            for ($j=0; $j<5; ++$j) {
                if ($this->showPixel($i, $j, $hash)) {
                    $svg->addChild($this->getPixel($i, $j, $this->getColor($hash)));
                }
            }
        }

        return (string) $svg;

    }

    private function getBackground()
    {
        return (new Rectangle(0, 0, 480, 480))
            ->setFillColor($this->backgroundColor)
            ->setStrokeWidth(0);
    }

    private function getPixel($x, $y, Color $color)
    {
        return (new Rectangle($x * 80 + 40, $y * 80 + 40, 80, 80))
            ->setFillColor($color)
            ->setStrokeWidth(0);
    }

    private function showPixel($x, $y, $hash)
    {
        return hexdec(substr($hash, 6 + abs(2-$x) * 5 + $y, 1)) % 2 === 0;
    }

    /**
     * Returns a unique color based on the hash.
     *
     * @param string $hash
     *
     * @return Color
     */
    private function getColor($hash)
    {
        return Color::parseHex('#' . substr($hash, 0, 6));
    }
}
