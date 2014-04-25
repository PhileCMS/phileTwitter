<?php
/**
 * Plugin class
 */
namespace Phile\Plugin\Phile\Twitter;

/**
 * Parse content and wrap mentions and hashtags
 */
class Plugin extends \Phile\Plugin\AbstractPlugin implements \Phile\Gateway\EventObserverInterface {
	/**
	 * the constructor
	 */
	public function __construct() {
		\Phile\Event::registerEvent('before_parse_content', $this);
	}

	/**
	 * parse text and wrap mentions and hashtags
	 * @param  string $text the content to be parsed
	 * @return string       resulting output
	 */
	private function parse_tweet($text) {
		// check to see what attrs we are appyling
		$class = ($this->settings['class']) ? " class=\"{$this->settings['class']}\" ": "";
		$target = ($this->settings['target']) ? " target=\"{$this->settings['target']}\" ": "";
		$title = ($this->settings['title']) ? " title=\"@$1\" ": "";
		// source http://goo.gl/S2rDdc
		$text = preg_replace(
			'@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@',
			'<a ' . $target . $class . $title . 'href="$1">$1</a>',
			$text);
		$text = preg_replace(
			'/@(\w+)/',
			'<a ' . $target . $class . $title . ' href="http://twitter.com/$1">@$1</a>',
			$text);
		$text = preg_replace(
			'/\s+#(\w+)/',
			' <a ' . $target . $class . str_replace('@', '#', $title) . 'href="https://twitter.com/search?q=%23$1&src=hash">#$1</a>',
			$text);
		return $text;
	}

	/**
	 * event method
	 *
	 * @param string $eventKey
	 * @param null   $data
	 *
	 * @return mixed|void
	 */
	public function on($eventKey, $data = null) {
		if ($eventKey == 'before_parse_content') {
			// assign the modified content back in the page
			// this happens before we go to the parser
			// it is easier to manipulate the raw text than the HTML
			$data['page']->setContent($this->parse_tweet($data['content']));
		}
	}
}
