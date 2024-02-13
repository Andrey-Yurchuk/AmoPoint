document.addEventListener('DOMContentLoaded', function(){
    const typeSelect = document.querySelector('select[name="type_val"]');
    const inputFields = document.querySelectorAll('input[name^="input_"]');
    const buttonFields = document.querySelectorAll('input[name^="button_"]');

    typeSelect.addEventListener('change', function(){
        var selectedValue = this.value;

        inputFields.forEach(function(input){
            if(input.name === "input_" + selectedValue){
                input.style.display = "block";
            } else {
                input.style.display = "none";
            }
        });

        buttonFields.forEach(function(button){
            if(button.name === "button_" + selectedValue){
                button.style.display = "block";
            } else {
                button.style.display = "none";
            }
        });
    });
});