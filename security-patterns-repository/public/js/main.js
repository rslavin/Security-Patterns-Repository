$(function(){
	$('.animated').autosize();
});

/*
$(document).ready(function () {
    var max_fields = 10; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var add_button = $(".add_field_button"); //Add button ID
    var keywordField = $("#keywordsField").val(); //Existing Keyword list
    var keywordArr = keywordField.split(','); //Convert to array

    //Populate the list
    for (var i = 0; i < keywordArr.length; ++i) {
        $(wrapper).append('<div><input id="keywordItem" type="text" value ="' + keywordArr[i] + '"/><a href="#" class="remove_field delete">Remove</a></div>');
    }

    var x = keywordArr.length; //initlal text box count
    $(add_button).click(function (e) { //on add input button click
        e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input id="keywordItem" type="text"/><a href="#" class="remove_field delete">Remove</a></div>'); //add input box
        }
    });

    $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    });

    // Once the save button is clicked, the keyword hidden field is updated with the new values.
    $("#saveButton").click(function () {
        var newList = [];
        //Get all the keywords and add it to the array
        $('#keywordList input').each(function () {
            //Validate if the keyword box as text
            if ($(this).val().length > 0) {
                 newList.push($(this).val());
            }     
        })
        $("#keywordsField").val(newList.join(','));
    });
});
*/