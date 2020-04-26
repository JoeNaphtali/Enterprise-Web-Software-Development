$(document).ready(function() {
  $('#summernote').summernote({
    tabsize: 2,
    height: 120,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'italic', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link', 'picture','hr']],
      ['view', ['fullscreen', 'help']]
    ]
  });
});

$(document).ready(function(){

  // if the user clicks the 'like' button
  $('.like-btn').on('click', function(){
    var idea_id = $(this).data('id');
    $clicked_btn = $(this);
    if ($clicked_btn.hasClass('material-icons-outlined')) {
      action = 'like';
    }
    else if ($clicked_btn.hasClass('material-icons')) {
      action = 'unlike';
    }
    $.ajax({
      type: 'post',
      data: {
        'action': action,
        'idea_id': idea_id
      },
      success: function(data){ 
        var res = JSON.parse(data);     
        if (action == "like") {
          $clicked_btn.removeClass('material-icons-outlined');
          $clicked_btn.addClass('material-icons');
        } else if(action == "unlike") {
          $clicked_btn.removeClass('material-icons');
          $clicked_btn.addClass('material-icons-outlined');
        }
        // Display number of likes and dislikes
        $clicked_btn.siblings('span.likes').text(res.likes);
        $clicked_btn.siblings('span.dislikes').text(res.dislikes);

        // Change button styling of the dislike button if user is reacting for the second time to an idea
        $clicked_btn.siblings('i.material-icons').removeClass('material-icons').addClass('material-icons-outlined');
      }
    })

  });

  // if the user clicks on the dislike button
  $('.dislike-btn').on('click', function(){
    var idea_id = $(this).data('id');
    $clicked_btn = $(this);

    if ($clicked_btn.hasClass('material-icons-outlined')) {
      action = 'dislike';
    }
    else if ($clicked_btn.hasClass('material-icons')) {
      action = 'undislike';
    }

    $.ajax({
      type: 'post',
      data: {
        'action': action,
        'idea_id': idea_id
      },
      success: function(data){
        var res = JSON.parse(data);
        if (action == "dislike") {
          $clicked_btn.removeClass('material-icons-outlined');
          $clicked_btn.addClass('material-icons');
        } else if(action == "undislike") {
          $clicked_btn.removeClass('material-icons');
          $clicked_btn.addClass('material-icons-outlined');
        }
        // display the number of likes and dislikes
        $clicked_btn.siblings('span.likes').text(res.likes);
        $clicked_btn.siblings('span.dislikes').text(res.dislikes);
          
        // Change button styling of the like button if user is reacting for the second time to an idea
        $clicked_btn.siblings('i.material-icons').removeClass('material-icons').addClass('material-icons-outlined');
      }
    })

  });

});