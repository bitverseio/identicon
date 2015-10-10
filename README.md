## PHP Identicon Generator

This is a PHP library which generates identicons based on a given string.
Currently only SVG format is supported as it offers the best combination of efficiency, quality, file size and ease of use.

### Installation

In order to use identicon in your project, add the following entry to your ```composer.json``` file:

```json
{
    "require": {
        "bitverse/identicon"
    }
}
```

### Usage

The code below, will create a rings-identicon from the string "hello world", and save it to ```helloworld.svg```.

```php
<?php

use Bitverse\Identicon\Identicon;
use Bitverse\Identicon\Generator\RingsGenerator;
use Bitverse\Identicon\Preprocessor\MD5Preprocessor;

$generator = new RingsGenerator();
$generator->setBackgroundColor($bg);

$identicon = new Identicon(new MD5Preprocessor(), $generator);

$icon = $identicon->getIcon('hello world');

file_put_contents('helloworld.svg', $icon);
```

#### Identicon object

Identicon is the main service that's responsible for providing the identicons based on a given string. In order to do that, it's required to pass a preprocessor and a generator into it's constructor.

You can then call the ```getIcon()``` function to create a new icon.

#### Preprocessor

A preprocessor is an object that implements ```Bitverse\Identicon\Preprocessor\PreprocessorInterface```.

The role of the preprocessor is to conduct any action on the string before it's passed to the ```generate()``` method of the generator. This includes hashing.

Currently, the library only includes ```MD5Preprocessor```, which hashes the given string using MD5 algorithm.

#### Generator

Generator is responsible for actually generating the icon from the hash produced by the preprocessor.

Any object can be a generator as long as it implements ```Bitverse\Identicon\Generator\GeneratorInterface```.

```RingsGenerator``` is the only generator included in the library at the moment. It produces identicons made out of a centerpiece and three rings of different lengths and rotation.

### Examples

Here are some examples for 'helloworld':

- ```MD5Preprocessor``` + ```RingsGenerator```:
