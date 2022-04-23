<?php
    if (isset($_REQUEST["twitch_url"])) {
        $image_url = urldecode($_REQUEST["twitch_url"]);
        $file_name = "Twitch_".basename($image_url);
             
        $ext        = strtolower(substr(strrchr($file_name, '.'), 1));
    
        switch($ext) {
           
        
            case 'mpeg':
            case 'mpg':
            case 'mpe':
                $cType = 'video/mpeg';
            break;
            case 'mp4':
                $cType = 'video/mp4';
            break;
            case 'mov':
                $cType = 'video/quicktime';
            break;
            case 'avi':
                $cType = 'video/x-msvideo';
            break;
    
            
    
            default:
                $cType = 'application/force-download';
            break;
        }
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Type: $cType");
        header("Content-Transfer-Encoding: binary");
       
        
        readfile($image_url);
    }
?>
