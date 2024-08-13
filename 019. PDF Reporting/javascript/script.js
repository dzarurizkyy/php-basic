// JQUERY
$(function() {
  // Variable
  let mainTable = $("#table").clone();

  // Event
  $("#search_submit").hide();
  
  $("#search").on("keyup", () => {
    if (($("#search").val() !== "")) {  
      $("table").hide();
      $(".pagination").hide();
      $(".loading").show(); 
      fetchData(1); 
    } 
    else { 
      $("#table").replaceWith(mainTable); 
    }
  })
})

// Function
let fetchData = (page) => {
  $.get(`php/search.php?search=${$("#search").val()}&page=${page}`, (data) => {
    $(".loading").hide();
    $("#table").html(data);
  }) 
}
