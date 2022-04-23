
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitch Clip downloader</title>
    <style>
        body{
            margin-left: 35%;
            
            padding: 10px;
        }
         {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

 td,  th {
  border: 1px solid #ddd;
  padding: 8px;
}

 tr:nth-child(even){background-color: #f2f2f2;}

 tr:hover {background-color: #ddd;}

 th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}

.bg-loader{
    top:0;
    left:0;
    width:100%;
    height:100%;
  
}

.loader {

  display: none;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(0,0,0,0.75) url(images/loading2.gif) no-repeat center center;
  z-index: 10000;
}

.loading {
    position: fixed;
   left:50%;
   top:50%;
  border: 8px dotted white;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  border-top-color: #f7f0ef ;
  border-right-color: #f7f0ef ;
  border-left-color: #999999;
  border-bottom-color: #999999;
  animation: spin 1s infinite ease-in;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(360deg);
  }
}

    </style>
</head>
<body>
    


    <div >
        <h2 >Twitch Clip Downloader</h2>
        <form action="get_file.php" method="POST" >
            <div >
                <label for="url" ></label>
                <input type="text" name="twitch_url" id="url"  placeholder="https://clips.twitch.tv/TsundereElegantWaterDeIlluminati" >
                <button type="submit" name="twitch_download" class="sbtn btn btn-secondary btn-c" onclick="spinner()">Download</button>
                 
                   <div class="loader ">
                        <div class="loading ">
                        </div>
                    </div>
                 
            </div>
 </form>
    </div>



  
 

</div>
<script type="text/javascript">
    function spinner() {
        document.getElementsByClassName("loader")[0].style.display = "block";
    }
</script>    
</body>
</html>



