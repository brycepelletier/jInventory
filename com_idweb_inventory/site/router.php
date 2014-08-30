<?php

/**
 * @version     1.0.0
 * @package     com_idweb_inventory
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Bryce Pelletier <bryce@idwebstudios.com> - http://www.idwebstudios.com
 */
// No direct access
defined('_JEXEC') or die;

/**
 * @param	array	A named array
 * @return	array
 */
function Idweb_inventoryBuildRoute(&$query) {
    $segments = array();

    if (isset($query['task'])) {
        $segments[] = implode('/', explode('.', $query['task']));
        unset($query['task']);
    }
    if (isset($query['view'])) {
        $segments[] = $query['view'];
        unset($query['view']);
    }
    if (isset($query['id'])) {
        $segments[] = $query['id'];
        unset($query['id']);
    }

    return $segments;
}

/**
 * @param	array	A named array
 * @param	array
 *
 * Formats:
 *
 * index.php?/idweb_inventory/task/id/Itemid
 *
 * index.php?/idweb_inventory/id/Itemid
 */
function Idweb_inventoryParseRoute($segments) {
    $vars = array();

    // view is always the first element of the array
    $vars['view'] = array_shift($segments);

    while (!empty($segments)) {
        $segment = array_pop($segments);
        if (is_numeric($segment)) {
            $vars['id'] = $segment;
        } else {
            $vars['task'] = $vars['view'] . '.' . $segment;
        }
    }

    return $vars;
}