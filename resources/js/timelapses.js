document.addEventListener("DOMContentLoaded", function() {
    var lazyVideos = [].slice.call(document.querySelectorAll("video.lazy"));
   
    if ("IntersectionObserver" in window) {
      var lazyVideoObserver = new IntersectionObserver(function(entries, observer) {
        entries.forEach(function(video) {
          
          if (video.isIntersecting) {
            for (var source in video.target.children) {
              var videoSource = video.target.children[source];
              if (typeof videoSource.tagName === "string" && videoSource.tagName === "SOURCE") {
                videoSource.src = videoSource.dataset.src;
              }
            }
            if(!video.target.classList.contains('loaded')){
                video.target.load();
              
                video.target.classList.add("loaded");
            }
            video.target.play();
           
           /*  lazyVideoObserver.unobserve(video.target); */
         
          } else {
        
            video.target.pause();
            video.target.muted = true;
            var i = video.target.parentNode.querySelector('.volume > i.fa-volume-up');
         
            if(i != null){
                i.classList.remove('fa-volume-up');
                i.classList.add('fa-volume-mute')
            }
           
           
           
        }
        });
      }, {threshold:0.7});
  
      lazyVideos.forEach(function(lazyVideo) {
        lazyVideoObserver.observe(lazyVideo);
      });
    }
    
  });

  $(document).on('click','.deleteTimelapse', function(e){
    e.preventDefault();
    $this = $(this);
    var timelapseId = $this.data('timelapse_id');
     swal.fire({
         title: 'Are you sure you want to delete this timelapse?',
         text: 'You wont be able revert this.',
         type: 'warning',
         showCancelButton: true,
         confirmButtonText: 'Yes'
      }).then(function (result) {
             if(result.dismiss != 'cancel'){
                 
                 $.ajax({
                     url: '/deleteTimelapse',
                     method: 'POST',
                     dataType: 'json',
                     data: {timelapse_id: timelapseId},
                     success: function (data) {
                         $this.parent().parent().parent().fadeOut(300, function() { $(this).remove(); });
                     }
                 })
          }
      });
})