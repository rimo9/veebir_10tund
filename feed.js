$(function(){
  //laetud

  var content  = $("#content");

  getTweets();
});

function getTweets(){
  //ajax
  $.ajax({
    url: "getfeed.php",
    success: function(data){
      var array = JSON.parse(data).statuses;
      console.log(array);
    },
    error: function(error){
      console.log(error);
    }
  });
}
