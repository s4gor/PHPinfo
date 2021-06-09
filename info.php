<div id="phpinfo">
    <h1>PHP Info</a></h1>
    <h2 class="builder">
        {;} with <span class="love">&#9829;</span> by <a href="https://www.github.com/s4gor" target="_blank">Imran Hossain Sagor</a>
    </h2>
	<?php
	ob_start ();
	phpinfo (INFO_ALL & ~INFO_LICENSE & ~INFO_CREDITS);
	$info = ob_get_contents ();
	ob_end_clean ();
	echo ( str_replace ( "module_Zend Optimizer", "module_Zend_Optimizer", preg_replace ( '%^.*<body>(.*)</body>.*$%ms', '$1', $info ) ) ) ;

	?>
</div>
