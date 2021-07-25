<?php

if(is_writable('../')) {
    if(isset($_POST['backup'])) {
        $backup = fopen('../.htaccess.bak', 'wb');
        $htaccess = file_get_contents('../.htaccess');
        fwrite($backup, '#BACKED UP by phpinfo() WP' . PHP_EOL);
        fwrite($backup, $htaccess);
        fclose($backup);
        echo '<script>window.addEventListener("DOMContentLoaded", () => {
    window.alert("File has been backed up");
});</script>';
    } elseif(isset($_POST['restore'])) {
        $backup_file = file_get_contents('../.htaccess.bak');
        $htaccess = fopen('../.htaccess', 'w');
        fwrite($htaccess, $backup_file);
        fclose($htaccess);
        echo '<script>window.addEventListener("DOMContentLoaded", () => {
    window.alert("File has been restored");
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

    }
} else {
    echo '<div id="htaccess-warning" style="font-size: 20px;">need write permissions on root directory. Can\'t perform the action</div>';
}
?>
<div id="htaccess-phpinfo">
    <h1 class="htaccess-header-phpinfo">Hyper Text Access</h1>
    <p id="htaccess-phpinfo-des"><b>This is only for <span style="color: #777BB3;">Apache Server</span></b>. Use this form to set, change value of PHP configurations. You can change any value of PHP's configuration. All you have to do is to follow the rules how to use it. Just write the directive name like, upload_max_filesize. and the write the value. <b>e.g. upload_max_filesize 200M</b>. To change or set another directive, in new line, write the directive, a space, then the value. To understand this thing better, see placeholder</p>
    <div id="htaccess-warning">Do Not Use It Frequently. Make sure you write correct syntax otherwise server will break down</div>
    <form action="<?= $_SERVER['PHP_SELF'] . '?page=htaccess_phpinfo'; ?>" METHOD="post">
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

<?php

$this->thankyou();