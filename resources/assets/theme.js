import 'bootstrap/js/dist/collapse';

(function () { 
    let videos = document.querySelectorAll('video');
    videos.forEach(video => (video.onplay = stopPlay));

    function stopPlay(ev) {
        videos.forEach(video => {
            if (!video.paused && ev.target !== video) video.pause();
        })
    }
})();