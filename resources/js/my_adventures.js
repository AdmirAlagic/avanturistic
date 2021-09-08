$(document).ready(function(){
 
   $('.deleteAdventure').on('click', function(e){
       e.preventDefault();
       $this = $(this);
       var postId = $this.data('post_id');
        swal.fire({
            title: 'Are you sure you want to delete this adventure?',
            text: 'You wont be able revert this.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes'
         }).then(function (result) {
                if(result.dismiss != 'cancel'){
                    
                    $.ajax({
                        url: '/deletePost',
                        method: 'POST',
                        dataType: 'json',
                        data: {post_id: postId},
                        success: function (data) {
                            $this.closest('.my-post-edit').parent().fadeOut(300, function() { $(this).remove(); });
                        }
                    })
             }
         });
   })
});