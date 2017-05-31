<?php

/**
 * Kirby SEO checklist plugin
 *
 * @version   0.1.0
 * @author    Sander De la Marche <inbox@sanderdlm.be>
 * @copyright Sander De la Marche <inbox@sanderdlm.be>
 * @link      https://github.com/dreadnip/kirby-seo-checklist
 * @license   MIT
 */

require_once(__DIR__.DS.'vendor/autoload.php');
require_once(__DIR__.DS.'lib/seo.php');

$kirby->set('widget', 'seo-checklist', __DIR__ . '/widgets/seo-checklist');