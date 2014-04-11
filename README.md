phileTwitter
===========

Parse content and wrap Twitter mentions and hashtags

### Features

* wrap `@` mentions
* wrap `#` tags
* control output (title, target, class name)

### Installation

* Install [Phile](https://github.com/PhileCMS/Phile)
* Clone this repo into `plugins/phileTwitter`
* add `$config['plugins']['phileTwitter'] = array('active' => true);` to your `config.php`

### Markdown Usage

All you have to do is use the `@` and `#` signs like you normally would in a tweet.

#### Basic Examples:

Put the code in there. Watch the HTML spew out.

```html
You can now mention twitter people like @james2doyle or even use hash tags like #philecms.
```

Output:

```html
<p>You can now mention twitter people like <a target="_blank" class="twitter-link" title="@james2doyle" href="http://twitter.com/james2doyle">@james2doyle</a> or even use hash tags like <a target="_blank" class="twitter-link" title="#philecms" href="https://twitter.com/search?q=%23philecms&amp;src=hash">#philecms</a>.</p>
```

#### Config

Here are the settings. See the above output for where everything goes.

```
'class' => 'twitter-link', // class to apply to the a tag, false is off
'target' => '_blank', // target for the a tag, false is off
'title' => true, // show a title on the a tag, false is off
```

### Why Use?

Clients are crazy. You want to make sure the HTML output is good and not a huge mess. It is a pretty good selling point for some people too. Doing things `automagically` always is.
