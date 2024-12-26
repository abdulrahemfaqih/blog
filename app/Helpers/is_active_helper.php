<?php

function is_active($path) {
    $uri = service('uri');
    return ($uri->getSegment(1) == $path || $uri->getSegment(2) == $path) ? 'bg-gray-100' : '';
}

