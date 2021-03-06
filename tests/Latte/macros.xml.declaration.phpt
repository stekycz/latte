<?php

/**
 * Test: Latte\Engine: <?xml test.
 * @phpini     short_open_tag=on
 */

use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


function xml($v) { echo $v; }

$latte = new Latte\Engine;
$latte->setLoader(new Latte\Loaders\StringLoader);

Assert::match(<<<EOD
<?xml version="1.0" ?>
12ok

EOD

, $latte->renderToString(<<<EOD
<?xml version="1.0" ?>
<?php xml(1) ?>
<? xml(2) ?>
<?php echo 'ok' ?>
EOD
));


Assert::match(<<<EOD
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
<channel>
EOD

, $latte->renderToString(<<<EOD
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
<channel>
EOD
));
