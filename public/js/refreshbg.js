function changeImg(imgNumber)	{
    var myImages = ['img/background/1.jpg', 'img/background/2.jpg', 'img/background/3.jpg', 'img/background/4.jpg'];
    var imgShown = document.body.style.backgroundImage;
    var newImgNumber =Math.floor(Math.random()*myImages.length);
    document.body.style.backgroundImage = 'url('+myImages[newImgNumber]+')';
  }
window.onload=changeImg;
