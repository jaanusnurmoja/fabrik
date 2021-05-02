<?php
/**
 * Google Map helper class
 *
 * @package     Joomla
 * @subpackage  Fabrik.helpers
 * @copyright   Copyright (C) 2005-2020  Media A-Team, Inc. - All rights reserved.
 * @license     GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

namespace Fabrik\Helpers;

// No direct access
defined('_JEXEC') or die('Restricted access');

use \stdClass;

/**
 * Google Map class
 *
 * @package     Joomla
 * @subpackage  Fabrik.helpers
 * @since       3.0
 */
class Googlemap
{
    /**
     * Set the google map style
     *
     * @param object $params Element/vis parameters (contains gmap_styles property as json string)
     *
     * @return  array  Styles
     * @since   3.0.7
     *
     */
    public static function styleJs($params)
    {
        $styles = $params->get('gmap_styles');
        $styles = is_string($styles) ? json_decode($styles) : $styles;

        if (!$styles)
        {
            return [];
        }

        // Map Feature type to style
        $features = $styles->style_feature;

        // What exactly to style in the feature type (road, fill, border etc)
        $elements = $styles->style_element;
        $styleKeys = $styles->style_styler_key;
        $styleValues = $styles->style_styler_value;

        // First merge any identical feature styles
        $stylers = [];

        for ($i = 0; $i < count($features); $i++)
        {
            $feature = ArrayHelper::getValue($features, $i);
            $element = ArrayHelper::getValue($elements, $i);
            $key = $feature . '|' . $element;

            if (!array_key_exists($key, $stylers))
            {
                $stylers[$key] = [];
            }

            $aStyle = new \stdClass;
            $styleKey = ArrayHelper::getValue($styleKeys, $i);
            $styleValue = ArrayHelper::getValue($styleValues, $i);

            if ($styleKey && $styleValue)
            {
                $aStyle->$styleKey = $styleValue;
                $stylers[$key][] = $aStyle;
            }
        }

        $return = [];

        foreach ($stylers as $styleKey => $styler)
        {
            $o = new \stdClass;
            $bits = explode('|', $styleKey);

            if ($bits[0] !== 'all')
            {
                $o->featureType = $bits[0];
            }

            $o->elementType = $bits[1];
            $o->stylers = $styler;
            $return[] = $o;
        }

        return $return;
    }
}
