<?

include 'config.php';

if (isset($_POST['lang'])) {
    require_once 'lang/' . $_POST['lang'] . '.php';
} else {
    require_once 'lang/en_EN.php';
}if (isset($_POST['fldr']) && !empty($_POST['fldr'])) {
    $subdir = trim($_POST['fldr'], '/') . '/';
}
else
    $subdir = '';
$cur_dir = $upload_dir . $subdir;


$response = '';
if (isset($_FILES['qqfile'])) {
    if ($_FILES['qqfile']['size'] > $MaxSizeUpload) {
        $response = array('error' => lang_Error_Upload);
    } else {
        $file_ext = substr($_FILES['qqfile']['name'], -3);
        if ($file_ext == 'peg' || $file_ext == 'ocx' || $file_ext == 'lsx')
            $file_ext = substr($_FILES['qqfile']['name'], -4);
        if (in_array($file_ext, $ext)) {
            //$name=time().'.'.$file_ext;
            $name=mb_convert_case ( $_FILES['qqfile']['name'] , MB_CASE_LOWER );
            $temp = $_FILES['qqfile']['tmp_name'];
            
            move_uploaded_file($temp, $root . $cur_dir . $name);
            //unlink($temp);
            $response = array('success' => true, 'file' => $name, 'size' => $_FILES['qqfile']['size'], 'max' => $MaxSizeUpload);
        } else {
            $response = array('error' => lang_Error_extension);
        }
    }
}
echo json_encode($response);
?>
