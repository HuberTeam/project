    var player;
    function flv_load() {  
            console.log('isSupported: ' + flvjs.isSupported());  
            var urlinput = document.getElementsByName('urlinput')[0];  
            var xhr = new XMLHttpRequest();  
            xhr.open('GET', urlinput.value, true);  
            xhr.onload = function (e) {  
                  
                var element = document.getElementsByName('videoElement')[0];  
                if (typeof player !== "undefined") {  
                    if (player != null) {  
                        player.unload();  
                        player.detachMediaElement();  
                        player.destroy();  
                        player = null;  
                    }  
                }  
                
                player = flvjs.createPlayer({  
                    type: 'mp4',  
                    url: urlinput.value  
                });  
                player.attachMediaElement(element);  
                player.load();  
            }  
            xhr.send();  
        }  
  
        function flv_start() {  
            player.play();  
        }  
  
        function flv_pause() {  
            player.pause();  
        }  
  
        function flv_destroy() {  
            player.pause();  
            player.unload();  
            player.detachMediaElement();  
            player.destroy();  
            player = null;  
        }  
  
        function flv_seekto() {  
            var input = document.getElementsByName('seekpoint')[0];  
            player.currentTime = parseFloat(input.value);  
        }  
  
        function getUrlParam(key, defaultValue) {  
            var pageUrl = window.location.search.substring(1);  
            var pairs = pageUrl.split('&');  
            for (var i = 0; i < pairs.length; i++) {  
                var keyAndValue = pairs[i].split('=');  
                if (keyAndValue[0] === key) {  
                    return keyAndValue[1];  
                }  
            }  
            return defaultValue;  
        }  
  
        var urlInputBox = document.getElementsByName('urlinput')[0];  
        var url = decodeURIComponent(getUrlParam('src', urlInputBox.value));  
        urlInputBox.value = url;  
          
        document.addEventListener('DOMContentLoaded', function () {  
            flv_load();  
        });  