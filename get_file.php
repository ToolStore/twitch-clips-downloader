<?php

function getOriginalUrl($url){
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $a = curl_exec($ch); 
    $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); 
    
    return $url;
    }
function getContent( $twitch_url )
{
  
    $twitch_curl = curl_init();
  
	curl_setopt($twitch_curl, CURLOPT_URL, $twitch_url);
    curl_setopt($twitch_curl, CURLOPT_HEADER, 0);
    curl_setopt($twitch_curl, CURLOPT_AUTOREFERER, true); 
    curl_setopt($twitch_curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($twitch_curl, CURLOPT_FOLLOWLOCATION, 1);
    	$response = curl_exec($twitch_curl);
	curl_close($twitch_curl);
  
    
	return $response;
}



function getSize($file){
    $file = get_headers($file, true);

    $size = isset($file['Content-Length'])?(int) $file['Content-Length']:0;  

    return $size;


}


function changeUnit($bytes, $decimals = 1){
    $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}


?>
 
<?php
      require 'index.php';

	if (isset($_POST['twitch_download'])) {
		if (isset($_POST['twitch_url']) && !empty($_POST['twitch_url'])) {
			
         
            $url=$_POST['twitch_url'];
            $orgurl=getOriginalUrl($url);

            $result= getContent($orgurl);
          
            $video_check=explode('"thumbnailUrl":["',$result);
        
           if ($video_check[1]) {
               $vidd=explode('-preview',$video_check[1]);
               $video_array=array();
               $video=$vidd[0].".mp4";
           
               $vid720=str_replace('.mp4','-720.mp4',$video);
               $vid480=str_replace('.mp4','-480.mp4',$video);
               $vid360=str_replace('.mp4','-360.mp4',$video);
            array_push($video_array,$video,$vid720,$vid480,$vid360);
             ?>
             <h3 >Video Preview</h3>    
        <video width="320" height="240" controls >
        <source src="<?php echo $video?>" type="video/mp4">
        </video> 

                <table>
                    <thead>
                       <tr>
                           <th>Video</th>
                           <th>Size</th>
                           <th>size(p)</th>
                           <th>Format</th>
                           <th>View</th>
                       </tr>
                    </thead>
                    <tbody>
                   <?php 
                   
                   foreach ($video_array as $key => $video) {
                     ?>
                    <tr>
                            <td><a href="download.php?twitch_url=<?php echo urlencode($video)?>"> download</a></td>
                            <td><?php echo changeUnit(getSize($video)) ?></td>
                            <td><?php echo $video_array[0]==$video?'1080p HD':substr($video,strlen($video)-7,3).'p' ?></td>
                            <td>Video/MP4</td>
                            <td><a href="<?php echo $video;?>">view</a></td>
                        </tr>
                     <?php
                   }
                   
                   ?>
                      
                    </tbody>
                </table>
                 <?php 
   
           }
           
            else {
               echo nl2br("<br /> Supported url format:- \r\n https://clips.twitch.tv/TsundereElegantWaterDeIlluminati or \r\n https://www.twitch.tv/jerma985/clip/BitterFastEagleBlargNaut-jtoQCscX53OkIH1M");
           }

           
		}
		else { 
            echo "<br />Please input the URL";
		} 
	}

  
?>