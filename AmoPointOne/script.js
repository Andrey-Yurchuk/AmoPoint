document.addEventListener('DOMContentLoaded', function(){
    document.querySelector('input[name="fileToUpload"]').addEventListener('change', function(){
        const file = this.files[0];
        const circle = document.querySelector('.circle');

        if (file) {
            circle.classList.remove('red');
            circle.classList.add('green');
        } else {
            circle.classList.remove('green');
            circle.classList.add('red');
        }
    });
});

function validateFile() {
    const fileInput = document.querySelector('input[name="fileToUpload"]');
    const circle = document.querySelector('.circle');

    if (fileInput.files.length > 0) {
        document.getElementById('uploadForm').submit();
    } else {
        circle.classList.remove('green');
        circle.classList.add('red');
    }
}