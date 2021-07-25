<div id="phpinfo-WP">
	<div id="info-phpinfo-WP">
		<h1 id="title-phpinfo-WP"><span id="heading-phpinfo-WP">phpinfo()</span> WP</h1>
		<p>A simple plugin to look up PHP's configuration</p>
	</div>
	<?php
	ob_start ();
	phpinfo (INFO_ALL & ~INFO_LICENSE & ~INFO_CREDITS);
	$info = ob_get_contents ();
	ob_end_clean ();
	echo ( str_replace ( "module_Zend Optimizer", "module_Zend_Optimizer", preg_replace ( '%^.*<body>(.*)</body>.*$%ms', '$1', $info ) ) ) ;

	?>
    <button id="topButton-phpinfo-WP" title="Go to top"><img src="<?php echo plugin_dir_url(__FILE__) . '../assets/images/top.png'; ?>" alt="Top" id="topButtonImage-phpinfo-WP"></button>
</div>
<?php

$this->thankyou();