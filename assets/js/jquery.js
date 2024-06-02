$(document).ready(function() {
    $('.option-parent').hover(
        function() {
            $('.option-child', this).fadeIn();
        }, 
        function() {
            $('.option-child', this).fadeOut();
        }
    );
});