$(document).ready(function() {
    $(".owl-events").owlCarousel({
        loop: !0,
        margin: 30,
        autoplay: 1,
        autoplayHoverPause: 1,
        slideBy: 1,
        mouseDrag: !1,
        dotsContainer: ".owl-events-dots",
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 2
            },
            1200: {
                items: 3
            }
        }
    })
});
