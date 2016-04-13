var $grid;

$(function(){
  //laetud

  getTweets();

  $grid = $('#content').isotope({
    itemSelector: ".item" //üks kast
  });
});

function getTweets(){
  //ajax
  $.ajax({
    url: "getfeed.php",
    success: function(data){
      //string massiiviks
      var array = JSON.parse(data).statuses;
      console.log(array);
      printTweets(array);
    },
    error: function(error){
      console.log(error);
    }
  });
}

function printTweets(newTweets){
  var html = '';
  $(newTweets).each(function(i, tweet){
    //html += '<div>'+i+'</div>';
    html+='<div class="item">'+
      '<div class="profile-image" style="background-image:url('+tweet.user.profile_image_url.replace("_normal", "")+')"></div>'+
      '<p>'+tweet.user.name+'</p>'+
      '<p>'+tweet.text+'</p>'+
    '</div>';
  });
  //$("#content").append($(html));
  var tweetsHTML = $(html);
  $grid.prepend(tweetsHTML)
       .isotope('prepended', tweetsHTML)
       .isotope('layout');
}
