var selectedItem = document.getElementById("session");
selectedItem.onchange = function() {
    var selectedOption = this.options[this.selectedIndex];
    if (selectedOption != "nothing") {
        window.open(selectedOption.value);
    }
}

function bar() {
    document.getElementById('right-content').style.display = "block";
    var element = document.getElementById("right-content");
    element.classList.toggle("content");
}