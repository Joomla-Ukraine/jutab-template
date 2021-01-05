<?php
/**
 * JU Tab
 *
 * @package          Joomla.Site
 * @subpackage       JU Tab
 *
 * @author           Denys Nosov, denys@joomla-ua.org
 * @copyright        2017-2021 (C) Joomla! Ukraine, http://joomla-ua.org. All rights reserved.
 * @license          GNU General Public License version 2 or later; see _LICENSE.php
 */

defined('_JEXEC') or die;

require_once __DIR__ . '/config.php';

$cck = CCK_Rendering::getInstance($this->template);

if($cck->initialize() === false)
{
	return;
}

// Prepare
$attributes          = $cck->id_attributes ? ' ' . $cck->id_attributes : '';
$attributes          = $cck->replaceLive($attributes);
$global_position_tpl = $cck->getStyleParam('global_position_tpl', 1);

// Render
if($cck->id_class !== '')
{
	echo '<div class="' . trim($cck->id_class) . '"' . $attributes . '>';
}

$tmpl = $cck->path . '/positions/' . ($global_position_tpl == 1 ? '' : $cck->type . '/') . 'default.php';
if(is_file($tmpl))
{
	ob_start();
	require $tmpl;
	$html = ob_get_clean();

	echo $html;
}
else
{
	echo '<div style="display: block; border: 1px solid #ccc; padding: 10px; color: green; margin: 20px 0; background: #fff">Template not found! <br><code>' . $tmpl . '</code></div>';
}

if($cck->id_class !== '')
{
	echo '</div>';
}

// Finalize
$cck->finalize();