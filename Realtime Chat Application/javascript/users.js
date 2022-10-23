// This js file is for the search bar in users page
const searchBar = document.querySelector(".users .search input"),
searchBtn = document.querySelector(".users .search button");

searchBtn.onclick = () => {
    // This method belongs to DOMTokenList object, and is used to toggle between the classes
    // The focus() method gives focus to an element (if it can be focused).
    
    // searchBar.classList.toggle("active");
    // searchBar.focus(); 
    // searchBtn.classList.toggle("active");

    // function above does the same as the below one
    searchBtn.classList.toggle("active");

    if (searchBar.classList.contains("active")){
        searchBar.classList.remove("active");
    }else{
        searchBar.classList.add("active");
        searchBar.focus(); 
    }
}