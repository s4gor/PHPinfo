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
    <div id="license">
        <b>phpinfo(); WP | A simple plugin to get phpinfo() in wordpress site<br />
        Copyright (C) 2021 Imran Hossain Sagor</b><br />
        This program is free software: you can redistribute it and/or modify
                it under the terms of the GNU General Public License as published by
                the Free Software Foundation, either version 3 of the License, or any later version.

                This program is distributed in the hope that it will be useful,
                but WITHOUT ANY WARRANTY; without even the implied warranty of
                MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
                GNU General Public License for more details.
    </div>
</div>
