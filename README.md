WLCR Wordpress Starter Theme
===
This theme was adapted from http://underscrores.me

It is a skeleton theme that includes Foundation (both css and javascript).


* Like Underscores.me, licensed under GPLv2 or later. :) Use it to make something cool.

Getting Started
---------------

If you want to create your own theme from this one, download 'wlcr/wp-foundation-starter' from GitHub. To change the name of the theme you'll need to do a five-step find and replace on the name in all the templates.

1. Search for `'wlcr'` (inside single quotations) to capture the text domain.
2. Search for `wlcr_` to capture all the function names.
3. Search for `Text Domain: wlcr` in style.css.
4. Search for <code>&nbsp;wlcr</code> (with a space before it) to capture DocBlocks.
5. Search for `wlcr-` to capture prefixed handles.

OR

* Search for: `'wlcr'` and replace with: `'myproject'`
* Search for: `wlcr_` and replace with: `myproject_`
* Search for: `Text Domain: wlcr` and replace with: `Text Domain: myproject` in style.css.
* Search for: <code>&nbsp;wlcr</code> and replace with: <code>&nbsp;MyProject</code>
* Search for: `wlcr-` and replace with: `myproject-`

Then, update the stylesheet header in `style.css` and the links in `footer.php` with your own information. Next, update or delete this readme.
