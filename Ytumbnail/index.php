<?php
  if(isset($_POST['button'])){
    $imgUrl = $_POST['imgurl'];
    $ch = curl_init($imgUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $downloadImg = curl_exec($ch);
    curl_close($ch);
    header('Content-type: image/jpg');
    header('Content-Disposition: attachment;filename="thumbnail.jpg"');
    echo $downloadImg;
  }
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YouTube Downloader - Download YouTube Thumbnail</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="social.css">
</head>
<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <header>Download Thumbnail</header>
    <div class="url-input">
      <!-- <span class="title">Paste video url:</span> -->
      <div class="field">
        <input type="text" placeholder="https://www.youtube.com/watch?v=Bm7xbmLL8yU&t=137s" required>
        <input class="hidden-input" type="hidden" name="imgurl">
        <span class="bottom-line"></span>
      </div>
    </div>
    <div class="preview-area">
      <img class="thumbnail" src="" alt="">
      <i class="icon fab fa-youtube"></i>
      <span>Paste video url to see preview</span>
    </div>
    <button class="download-btn" type="submit" name="button"><i class="fas fa-cloud-download-alt"></i>  Download</button>
  </form>

  <div class="adminActions">
    <input type="checkbox" name="adminToggle" class="adminToggle" />
    <a class="adminButton" href="#!"><i class="fa fa-cog"></i></a>
    <div class="adminButtons">
        <a href="#" title="Download Code"><i class="fas fa-download"></i></a>
        <a href="https://github.com/irfan7o" target="_blank" title="Github" style="color:black"><i class="fab fa-github"></i></a>
        <a href="https://www.youtube.com/" target="_blank" title="Youtube" style="color:red"><i class="fab fa-youtube"></i></a>
    </div>
  </div>

  <script>
    const urlField = document.querySelector(".field input"),
    previewArea = document.querySelector(".preview-area"),
    imgTag = previewArea.querySelector(".thumbnail"),
    hiddenInput = document.querySelector(".hidden-input"),
    button = document.querySelector(".download-btn");

    urlField.onkeyup = ()=>{
      let imgUrl = urlField.value;
      previewArea.classList.add("active");
      button.style.pointerEvents = "auto";
      if(imgUrl.indexOf("https://www.youtube.com/watch?v=") != -1){
        let vidId = imgUrl.split('v=')[1].substring(0, 11);
        let ytImgUrl = `https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`;
        imgTag.src = ytImgUrl;
      }else if(imgUrl.indexOf("https://youtu.be/") != -1){
        let vidId = imgUrl.split('be/')[1].substring(0, 11);
        let ytImgUrl = `https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`;
        imgTag.src = ytImgUrl;
      }else if(imgUrl.match(/\.(jpe?g|png|gif|bmp|webp)$/i)){
        imgTag.src = imgUrl;
      }else{
        imgTag.src = "";
        button.style.pointerEvents = "none";
        previewArea.classList.remove("active");
      }
      hiddenInput.value = imgTag.src;
    }
  </script>

</body>
</html>
