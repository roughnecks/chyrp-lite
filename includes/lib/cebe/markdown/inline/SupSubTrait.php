<?php
/**
 * @copyright Copyright (c) 2023 Daniel Pimley
 * @license https://github.com/cebe/markdown/blob/master/LICENSE
 * @link https://github.com/cebe/markdown#readme
 */

namespace cebe\markdown\inline;

/**
 * Adds superscript and subscript inline elements
 */
trait SupSubTrait
{
	protected function parseSupMarkers()
	{
		return array('++');
	}

	/**
	 * Parses the strikethrough feature.
	 * @marker ++
	 */
	protected function parseSup($markdown)
	{
		if (preg_match('/^\+\+(.+?)\+\+/', $markdown, $matches)) {
			return [
				[
					'sup',
					$this->parseInline($matches[1])
				],
				strlen($matches[0])
			];
		}
		return [['text', $markdown[0] . $markdown[1]], 2];
	}

	protected function renderSup($block)
	{
		return '<sup>' . $this->renderAbsy($block[1]) . '</sup>';
	}

	protected function parseSubMarkers()
	{
		return array('--');
	}

	/**
	 * Parses the strikethrough feature.
	 * @marker ~~
	 */
	protected function parseSub($markdown)
	{
		if (preg_match('/^--(.+?)--/', $markdown, $matches)) {
			return [
				[
					'sub',
					$this->parseInline($matches[1])
				],
				strlen($matches[0])
			];
		}
		return [['text', $markdown[0] . $markdown[1]], 2];
	}

	protected function renderSub($block)
	{
		return '<sub>' . $this->renderAbsy($block[1]) . '</sub>';
	}

	abstract protected function parseInline($text);
	abstract protected function renderAbsy($blocks);
}
