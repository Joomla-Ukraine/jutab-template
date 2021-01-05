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

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

defined('_JEXEC') or die;

require_once JPATH_LIBRARIES . '/jusebcck/vendor/autoload.php';

if($cck->countFields('header'))
{
	echo $cck->renderPosition('header');
}

if($cck->countFields('mainbody'))
{
	echo $cck->renderPosition('mainbody');
}

$data_tabs = [];
for($i = 1; $i <= 10; $i++)
{
	$title   = $cck->getStyleParam('tabname_' . $i, 'Tab ' . $i);
	$content = $cck->renderPosition('tab' . $i);

	if($cck->countFields('tab' . $i . '_colleft') || $cck->countFields('tab' . $i . '_colright'))
	{
		$content .= '
			<div class="uk-grid uk-grid-medium" data-uk-grid>
				<div class="' . ($cck->getStyleParam('tabcss_left' . $i) ? $cck->getStyleParam('tabcss_left' . $i) : 'uk-width-1-1@s uk-width-2-3@m') . '">
					' . $cck->renderPosition('tab' . $i . '_colleft') . '
				</div>
				<div class="' . ($cck->getStyleParam('tabcss_right' . $i) ? $cck->getStyleParam('tabcss_right' . $i) : 'uk-width-1-1@s uk-width-1-3@m') . '">
					' . $cck->renderPosition('tab' . $i . '_colright') . '
				</div>
			</div>
			';
	}

	if($content)
	{
		$data_tabs[] = [
			'title'   => $title ? Text::_($title) : 'Tab ' . $i,
			'content' => $content
		];
	}
}

?>
	<div class="uk-section-default uk-box-shadow-medium uk-padding-small uk-margin-top uk-form-stacked">
		<?php
		echo JUSebCCK\Tmpl\Tabs::render($data_tabs, [
			'tab'      => 'tm-tab-main',
			'tab-item' => '',
			'panel'    => 'uk-switcher',
			'content'  => 'tm-tab-small uk-overflow-hidden'
		]);
		?>
	</div>
<?php

if($cck->countFields('footer'))
{
	echo $cck->renderPosition('footer');
}

for($i = 1; $i <= 5; $i++)
{
	$suffix = ($i == 1) ? '' : $i;

	if($cck->countFields('modal' . $suffix))
	{
		HTMLHelper::_('bootstrap.modal', 'collapseModal' . $suffix);

		$class = $cck->getPosition('modal' . $suffix)->css;
		$class = ($class) ? ' ' . $class : '';

		?>
		<div class="modal hide fade<?php echo $class; ?>" id="collapseModal<?php echo $suffix; ?>">
			<?php echo $cck->renderPosition('modal' . $suffix); ?>
		</div>
		<?php

	}
}

if($cck->countFields('hidden') && ($buffer = $cck->renderPosition('hidden')))
{
	?>
	<div style="display: none;">
		<?php echo $buffer; ?>
	</div>
	<?php
}