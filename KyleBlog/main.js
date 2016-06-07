$(function() {
  
    //Adds another file input field when the admin wants to add another photo
    $("#add-photo-button").click(function() {
        $("#photo-insert").append('<div id="insert-file-field"><input type="file" name="images[]" onchange="previewimage(this);"/><button id="remove-photo-button" type="button">Remove</button></div>');
    });
    
    //Removes the file input field when the user clickes the remove button associated with that field.
    $(document).on("click", "#remove-photo-button", function() {
        $(this).parent('div').remove();
    });
    
});

/*
*   This function lets the admin preview each image they upload before submitting.
*/
function previewimage(input) {
        var reader = new FileReader();
        
        reader.onload=function(e) {
            //To change the pic that is previewed if the admin changes the file in the input.
            $(input).parent().find('img').first().remove();
            //View the pic that the admin attatched for that specific input
            $(input).parent().append('<div><img src="'+e.target.result+'"></div>');
        };
        
        reader.readAsDataURL(input.files[0]);
}
