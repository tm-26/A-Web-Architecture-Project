var coll = document.getElementsByClassName("collapsible_table");
    var i;

    for (i = 0; i < coll.length; i++) {
        (coll[i].getElementsByClassName("collapsible"))[0].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.closest('table').nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }