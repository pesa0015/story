$(document).ready(function() {  

  // Icon Click Focus
  $('div.icon').click(function(){
    $('textarea#update').focus();
  });

  // Live Search
  // On Search Submit and Get Results
  function update() {
    var query_value = $('textarea#update').val();
    $('b#search-string').html(query_value);
    if(query_value !== ''){
      $.ajax({
        type: "POST",
        url: "functions/profile_live_update.php",
        data: { query: query_value },
        cache: false,
        success: function(html){
          
        }
      });
    }return false;    
  }
});