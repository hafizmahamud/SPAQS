let sidebar = document.querySelector(".sidebar, .sidebarTUNAS, .sidebarAWAS");
let closeBtn = document.querySelector("#btn");
let searchBtn = document.querySelector(".bx-search");

closeBtn.addEventListener("click", ()=>{
  sidebar.classList.toggle("open");
  menuBtnChange();//calling the function(optional)
});
closeBtn.addEventListener("click", ()=>{
  sidebarTUNAS.classList.toggle("open");
  tunasmenuBtnChange();//calling the function(optional)
});
closeBtn.addEventListener("click", ()=>{
  sidebarAWAS.classList.toggle("open");
  awasmenuBtnChange();//calling the function(optional)
});


// following are the code to change sidebar button(optional)
function menuBtnChange() {
 if(sidebar.classList.contains("open")){
   closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
 }else {
   closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
 }
}
// following are the code to change sidebar button(optional)
function tunasmenuBtnChange() {
  if(sidebarTUNAS.classList.contains("open")){
    closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
  }else {
    closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
  }
 }
// following are the code to change sidebar button(optional)
function awasmenuBtnChange() {
  if(sidebarAWAS.classList.contains("open")){
    closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
  }else {
    closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
  }
 }
