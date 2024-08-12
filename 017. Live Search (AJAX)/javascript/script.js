// Variable
let search      = document.getElementById("search");  
let table       = document.getElementById("table");
let mainTable   = table.innerHTML;
let currentPage = 1;

// Event
search.addEventListener('keyup', () => {
  if(search.value !== "") {
    fetchData(search.value, currentPage)
  } else {
     table.innerHTML = mainTable
  } 
});

// Asynchronous Javascript (AJAX)
function fetchData(search, page){
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = () => {
    if (xhr.readyState === 4 && xhr.status === 200) {
      table.innerHTML = xhr.responseText;
    }
  }
  
  xhr.open("GET", `php/search.php?search=${search}&page=${page}`, true);
  xhr.send();
}

// Function
function changePage(page) {
  currentPage = page;
  fetchData(search.value, currentPage);
};