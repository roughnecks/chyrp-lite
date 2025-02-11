<?php
/**
 * @copyright Copyright (c) 2023 Daniel Pimley
 * @license https://github.com/cebe/markdown/blob/master/LICENSE
 * @link https://github.com/cebe/markdown#readme
 */

namespace cebe\markdown\inline;

/**
 * Adds highlight inline elements
 */
trait HighlightTrait
{
	protected function parseHighlightMarkers()
	{
		return array('==');
	}

	/**
	 * Parses the highlight feature.
	 * @marker ==
	 */
	protected function parseHighlight($markdown)
	{
		if (preg_match('/^==(.+?)==/', $markdown, $matches)) {
			return [
				[
					'highlight',
					$this->parseInline($matches[1])
				],
				strlen($matches[0])
			];
		}
		return [['text', $markdown[0] . $markdown[1]], 2];
	}

	protected function renderHighlight($block)
	{
		return '<mark>' . $this->renderAbsy($block[1]) . '</mark>';
	}

	abstract protected function parseInline($text);
	abstract protected function renderAbsy($blocks);
}
