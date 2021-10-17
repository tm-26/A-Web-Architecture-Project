var currImage = 0;
    slideshowSwitch();
            
    function slideshowSwitch(){
        var x = document.getElementsByClassName("slides");
        for (var i = 0; i < x.length; i++){
            x[i].style.display = "none"; // all slideshow images are set to display: none 
        }
        
        /*  if currImage, which is the index of the current slideshow image, is greater than the index of the last image,
            currImage is reset to 0 which is the index of the first image*/
        if (currImage > x.length - 1){
            currImage = 0
        }
        
        x[currImage].style.display = "block";  // the image with index currImage is displayed
        currImage++;
        setTimeout(slideshowSwitch, 5000); // slideshowSwitch() is called again after 5 seconds
    } 

    $(document).ready(function(){
        $("#hamburger").click(function(){
            /*  if the hamburger has class "open", it will remove it and vice-versa if it doesn't have class "open";
                depending on whether it has class "open", certain properties will affect the hamburger */
            var classChange = $(this).hasClass("open")
            if (classChange == true){
                $(this).removeClass("open");
            }
            else{
                $(this).addClass("open");
            }

            /*  openMenu, which initially cannot be seen, will have its width toggled from 0%
                to its actual size when the hamburger icon is clicked on */
            $("#openMenu").animate({
                width: 'toggle'
            });         
        });
    });  