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

if($cck->countFields('debug'))
{
	echo $cck->forcePosition('debug');
}

echo '<div align="center" style="color: #146295;">';

// Time & Memory
if($cck->profiler)
{
	echo $cck->profiler_log . $cck->profiler->mark('afterRender' . ucfirst($cck->mode)) . '<br />';
}

// Basic
echo '<br />-------- Debug :: Basic --------<br />';
echo 'Template: ' . $cck->name . '<br />';
echo 'Type: ' . $cck->type . '<br />';
echo 'Mode: ' . $cck->mode . '<br />';
echo 'Client: ' . $cck->client . '<br />';
echo 'Username: ' . $user->username . '<br />';

// Positions
echo '<br />-------- Debug :: Positions --------<br />';
foreach($cck->positions as $k => $v)
{
	echo $k . '=' . $cck->countFields($k) . '<br />';
}

// StyleParams
echo '<br />-------- Debug :: StyleParams --------<br />';
foreach($cck->params as $k => $v)
{
	echo $k . '=' . $cck->getStyleParam($k) . '<br />';
}

// Overloading
echo $cck->renderPozition('plop');

echo '</div>';