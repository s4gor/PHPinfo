<?php

if(is_writable('../')) {
    if(isset($_POST['backup'])) {
        $backup = fopen('../.htaccess.bak', 'wb');
        $htaccess = file_get_contents('../.htaccess');
        fwrite($backup, '#BACKED UP by phpinfo() WP' . PHP_EOL);
        fwrite($backup, $htaccess);
        fclose($backup);
	    echo '<script>    window.addEventListener("DOMContentLoaded", () => {
        document.getElementById("phpinfo-output").innerHTML = "FILE HAS BEEN BACKED UP!";
        document.getElementById("phpinfo-output").style.display = "block";
    });</script>';

    } elseif(isset($_POST['restore'])) {
        $backup_file = file_get_contents('../.htaccess.bak');
        $htaccess = fopen('../.htaccess', 'w');
        fwrite($htaccess, $backup_file);
        fclose($htaccess);

	    echo '<script>    window.addEventListener("DOMContentLoaded", () => {
        document.getElementById("phpinfo-output").innerHTML = "FILE HAS BEEN RESTORED!";
        document.getElementById("phpinfo-output").style.display = "block";
    });</script>';

    } elseif(isset($_POST['save'])) {
        $custom_value = htmlspecialchars($_POST['htaccess']);

        $files = scandir('../');

        if(!in_array('htaccess-phpinfo.txt', $files)) {
            $previous_contents = fopen('../htaccess.txt', 'wb');
            $content = file_get_contents('../.htaccess');
            fwrite($previous_contents, $content . PHP_EOL . PHP_EOL . '# BEGIN htaccess-phpinfo');
            fclose($previous_contents);
            $custom_file = fopen('../htaccess-phpinfo.txt', 'wb');
            fwrite($custom_file, $custom_value);
            fclose($custom_file);
            $handle = fopen('../htaccess-phpinfo.txt', 'r');
            $custom_values = '';
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    $custom_values .= 'php_value ' . $line;
                }
                fclose($handle);
                $handle = fopen('../htaccess-phpinfo-new.txt', 'wb');
                fwrite($handle, $custom_values);
                fclose($handle);
            }
            $htaccess = fopen('../.htaccess', 'w');
            $new_content = file_get_contents('../htaccess-phpinfo-new.txt');
            $previous_contents = file_get_contents('../htaccess.txt');
            fwrite($htaccess, $previous_contents . PHP_EOL . $new_content);
            fclose($htaccess);
            unlink('../htaccess-phpinfo-new.txt');
        } else {
            $custom_file = fopen('../htaccess-phpinfo.txt', 'w+');
            fwrite($custom_file, $custom_value);
            fclose($custom_file);
            $handle = fopen('../htaccess-phpinfo.txt', 'r');
            $custom_values = '';
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    $custom_values .= 'php_value ' . $line;
                }
                fclose($handle);
                $handle = fopen('../htaccess-phpinfo-new.txt', 'wb');
                fwrite($handle, $custom_values);
                fclose($handle);
            }
            $htaccess = fopen('../.htaccess', 'w');
            $previous_contents = file_get_contents('../htaccess.txt');
            $new_content = file_get_contents('../htaccess-phpinfo-new.txt');
            fwrite($htaccess, $previous_contents . PHP_EOL . $new_content);
            fclose($htaccess);
            unlink('../htaccess-phpinfo-new.txt');
        }
        echo '<script>    window.addEventListener("DOMContentLoaded", () => {
        document.getElementById("phpinfo-output").innerHTML = "FILE HAS BEEN SAVED!";
        document.getElementById("phpinfo-output").style.display = "block";
    });</script>';
    }
} else {
    echo '<div id="htaccess-warning" style="font-size: 20px;">need write permissions on root directory. Can\'t perform the action</div>';
}
?>

<div id="phpinfo-wp">.

<!--    heading info-->
    <div id="info-phpinfo-WP">
        <h1 id="title-phpinfo-WP"><span id="heading-phpinfo-WP">phpinfo();</span> WP</h1>
    </div>

<!--    tab links-->

  <div class="tab">
    <button class="tablinks" id="htaccess-tab">.htaccess</button>
    <button class="tablinks" id="extension-tab">Extensions</button>
    <button class="tablinks" id="info-tab">phpinfo()</button>
  </div>

    <div id="phpinfo-output" style="display: none"></div>

    <div id="phpinfo-htaccess" class="tabcontent">

        <div id="htaccess-phpinfo">
            <p id="htaccess-phpinfo-des"><b>This is only for <span style="color: #777BB3;">Apache Server</span></b>. Use this form to set, change value of PHP configurations. You can change any value of PHP's configuration. All you have to do is to follow the rules how to use it. Just write the directive name without php_value tag like, upload_max_filesize. and the write the value. <b>e.g. upload_max_filesize 200M</b>. <br />To change or set another directive, in new line, write the directive, a space, then the value. To understand this thing better, see placeholder</p>
            <div id="htaccess-warning">Do not touch without proper knowledge. Make sure you write correct syntax otherwise server will break down!!!</div>
            <form action="<?= $_SERVER['PHP_SELF'] . '?page=phpinfo_wp'; ?>" METHOD="post">
            <textarea name="htaccess" id="htaccess-editor" placeholder="max_file_uploads 25
upload_max_filesize 60M"><?php
	            $files = scandir('../');
	            if(in_array('htaccess-phpinfo.txt', $files)) {
		            echo file_get_contents('../htaccess-phpinfo.txt');
	            }
	            ?></textarea><br>
                <button name="save" id="phpinfo-htaccess-save">Save</button>
                <button name="backup" id="phpinfo-htaccess-backup">Backup</button>
                <button name="restore" id="phpinfo-htaccess-restore">Restore</button>
            </form>
            <div id="htaccess-warning">Make sure, you take backup <b>.htaccess</b> file using backup button which can be restored later using restore button</div>
        </div>

    </div>

  <div id="phpinfo-extensions" class="tabcontent">
    <?php

    $extensions = ['bz2', 'curl', 'ffi', 'ftp', 'fileinfo', 'gd', 'gettext', 'gmp', 'intl', 'imap', 'ldap', 'mbstring', 'exif', 'mysqli', 'oci8_12c', 'oci8_19', 'odbc', 'openssl', 'pdo_firebird', 'pdo_mysql', 'pdo_oci', 'pdo_odbc', 'pdo_pgsql', 'pdo_sqlite', 'shmop', 'pgsql', 'snmp', 'soap', 'sockets', 'sodium', 'sqlite3', 'tidy', 'xsl', 'Core', 'PDO', 'Phar', 'Reflection', 'SPL', 'SimpleXML', 'apache2handler', 'bcmath', 'calendar', 'ctype', 'date', 'dom', 'filter', 'hash', 'iconv', 'json', 'libxml', 'mysqlnd', 'pcre', 'readline', 'session', 'standard', 'tokenizer', 'xml', 'xmlreader', 'xmlwriter', 'zip', 'zlib', 'imagick'];

    asort($extensions);


    function check_extension($extension) {
        $loaded_extensions = get_loaded_extensions();

        if(in_array($extension, $loaded_extensions)) {
            return "<li><input type='checkbox' id='phpinfo-extension' name='$extension' value='$extension' checked disabled><label for='$extension'>$extension</label></li>";
        } else {
            return "<li><input type='checkbox' name='$extension' value='$extension' id='phpinfo-extension' disabled><label for='$extension'>$extension</label></li>";
        }
    }

    echo '<ul class="phpinfo-extensions">';

    foreach($extensions as $extension) {
        echo check_extension($extension);
    }

    echo '</ul>';
    ?>
  </div>

    <div id="phpinfo-info" class="tabcontent">
        <div id="phpinfo-WP">
			<?php
			ob_start ();
			phpinfo (INFO_ALL & ~INFO_LICENSE & ~INFO_CREDITS);
			$info = ob_get_contents ();
			ob_end_clean ();
			echo ( str_replace ( "module_Zend Optimizer", "module_Zend_Optimizer", preg_replace ( '%^.*<body>(.*)</body>.*$%ms', '$1', $info ) ) ) ;

			?>
            <button id="topButton-phpinfo-WP" title="Go to top"><img src="<?php echo plugin_dir_url(__FILE__) . '../assets/images/top.png'; ?>" alt="Top" id="topButtonImage-phpinfo-WP"></button>
        </div>
    </div>

</div>

<?php

$this->thankyou();