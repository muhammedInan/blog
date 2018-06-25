<?php
/**
 * Created by PhpStorm.
 * User: WIN10
 * Date: 09/06/2018
 * Time: 02:34
 */

<?php

class MonExtension extends Twig_Extension
{

    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('markdown', [$this, 'markdownParse'], ['is_safe' => ['html']])
        ];
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('activeClass', [$this, 'activeClass'], ['needs_context' => true])
        ];
    }

    public function markdownParse($value)
    {
        return \Michelf\MarkdownExtra::defaultTransform($value);
    }

    public function activeClass(array $context, $page) {
        if (isset($context['current_page']) && $context['current_page'] === $page) {
            return ' active ';
        }
    }
}