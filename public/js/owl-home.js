$(document).ready(function() {
    $(".owl-events").owlCarousel({
        loop: !0,
        margin: 30,
        autoplay: 1,
        autoplayHoverPause: 1,
        slideBy: 1,
        mouseDrag: 1,
        dotsContainer: ".owl-events-dots",
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 3
            },
            768: {
                items: 3
            },
            992: {
                items: 3
            },
            1200: {
                items: 4
            }
        }
    })
});
