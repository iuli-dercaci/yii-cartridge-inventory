<?php
/**
 * @author Iuli Dercaci <iuli.dercaci@site-me.info>
 * Date: 09.06.14
 */
$item = array_slice($data, -1, 1);
if (!empty($item)) {
    $title = key($item);
    $val = '<ul class="list-unstyled">';
    foreach ($item[$title] as $element) {
        $val .= sprintf('<li>%s: %s</li>', key($element), reset($element));
    }
    $val .= '</ul>';
    echo sprintf('<dt>%s:</dt><dd>%s</dd>', $title, $val);
}