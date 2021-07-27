(function ($) {
    $('.testimonial-read-more').on('click', function(){
        var read_more = $(this),
            testimonial_content = read_more.prev();
        testimonial_content.toggleClass('expanded');
        read_more.toggleClass('expanded');
    });
})(jQuery);