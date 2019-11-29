// $(function() {
//     var THUMBNAIL_WIDTH = 20,
//         GALLERY = $('.left-feed-custom');
//
//     GALLERY.find('.thumb').on('click', function() {
//         loadClickedImage($(this).data('thumb-id'));
//     });
//     GALLERY.find('#prev-btn').on('click', function() {
//         slidePrev();
//     });
//     GALLERY.find('#next-btn').on('click', function() {
//         slideNext();
//     });
//     $(document).keydown(function(e){
//         switch(e.keyCode) {
//             // Left arrow press
//             case 37:
//                 slidePrev();
//                 break;
//             // Right arrow press
//             case 39:
//                 slideNext();
//                 break;
//             default:
//                 break;
//         }
//     });
//
//     var slideNext = function() {
//             console.log('slideNext image ')
//         var active = GALLERY.find('.img-wrapper.active');
//         console.log('next')
//         if (active.length === 0) {
//             active = GALLERY.find('.img-wrapper:last');
//         }
//
//         // Setting next image & thumb properties
//         loadNextImage(active);
//     };
//
//     var loadNextImage = function(active) {
//             console.log('loadNextImage image ', active)
//         // var next =  active.next(".img-wrapper").length ? active.next(".img-wrapper") : GALLERY.find('.img-wrapper:first'),
//         //     nextThumb = GALLERY.find('[data-thumb-id="' + next.data('img-id') + '"]');
//
//             // var next_id = GALLERY.find('[data-thumb-id="2"]');
//             let active_thumb = GALLERY.find('.thumbs li.active');
//             let next_thumb_id = (GALLERY.find('.thumbs li').length > active_thumb.data('thumb-id'))? active_thumb.data('thumb-id') + 1 : 1 ;
//             console.log('thumb id is ',next_thumb_id, GALLERY.find('.thumbs').length, active_thumb.data('thumb-id'), active_thumb)
//     // var nextThumb = GALLERY.find('[data-thumb-id="' + next.data('img-id') + '"]');
//             var nextThumb = GALLERY.find('[data-thumb-id="' + next_thumb_id + '"]');
//         // Setting next image & thumb properties
//         GALLERY.find('.thumb').removeClass('active');
//         nextThumb.addClass('active');
//         active.addClass('last-active');
//
//         // Transitioning to next image & thumbnail
//         scrollThumbnails(nextThumb);
//         // next.css({opacity: 0.0})
//         //     .addClass('active')
//         //     .animate({opacity: 1.0}, 1000, function() {
//         //         active.removeClass('active last-active');
//         //     });
//     };
//
//     var slidePrev = function() {
//             console.log('slider prev')
//         var active = GALLERY.find('.img-wrapper.active');
//
//         if (active.length === 0) {
//             active = GALLERY.find('.img-wrapper:last');
//         }
//
//         // Setting next image & thumb properties
//         loadPrevImage(active);
//     };
//
//     var loadPrevImage = function(active) {
//             console.log('loadPrevImage ')
//             let active_thumb = GALLERY.find('.thumbs li.active');
//             let prev_thumb_id = (GALLERY.find('.thumbs li').length > active_thumb.data('thumb-id') && active_thumb.data('thumb-id') > 1)? active_thumb.data('thumb-id') - 1 : 1 ;
//
//         // var prev =  active.prev(".img-wrapper").length ? active.prev(".img-wrapper") : GALLERY.find('.img-wrapper:last'),
//         //     prevThumb = GALLERY.find('[data-thumb-id="' + prev.data('img-id') + '"]');
// console.log('prev_thumb_id', prev_thumb_id)
//         var prevThumb = GALLERY.find('[data-thumb-id="' + prev_thumb_id + '"]');
//         // Setting next image & thumb properties
//         GALLERY.find('.thumb').removeClass('active');
//         prevThumb.addClass('active');
//         active.addClass('last-active');
//
//         // Transitioning to next image & thumbnail
//         scrollThumbnails(prevThumb);
//         prev.css({opacity: 0.0})
//             .addClass('active')
//             .animate({opacity: 1.0}, 1000, function() {
//                 active.removeClass('active last-active');
//             });
//     };
//
//     var loadClickedImage = function(id) {
//         var image =  GALLERY.find('[data-img-id="' + id + '"]'),
//             imgThumb = GALLERY.find('[data-thumb-id="' + id + '"]'),
//             currActive = GALLERY.find('.img-wrapper.active');
//
//         // Setting image & thumb properties
//         GALLERY.find('.thumb').removeClass('active');
//         currActive.addClass('last-active').removeClass('active');
//         imgThumb.addClass('active');
//
//         // Transitioning to image & thumbnail
//         scrollThumbnails(imgThumb);
//         image.css({opacity: 0.0})
//             .addClass('active')
//             .animate({opacity: 1.0}, 1000, function() {
//                 currActive.removeClass('last-active');
//             });
//     };
//
//     var scrollThumbnails = function(thumb) {
//             console.log('thumb ',thumb)
//         var offset, // used for thumbnail offset
//             first,  // stores first thumbnail object
//             x = thumb.position().left + parseInt(thumb.css('margin-left'), 20);
//
//         // Checking current thumbnail offset
//         if(x < 0) {
//             first = GALLERY.find('.thumb:first');
//             offset = parseInt(first.css('margin-left'), 20) - x;
//             first.animate({
//                 marginLeft: offset
//             }, 1000);
//         } else {
//             x = thumb.position().left;
//             var currOffset = ( x + THUMBNAIL_WIDTH ) - thumb.parent().width();
//             if(currOffset > 0) {
//                 first = GALLERY.find('.thumb:first');
//                 offset = parseInt(first.css('margin-left'), 20) - currOffset;
//                 first.animate({
//                     marginLeft: offset
//                 }, 1000);
//             }
//         }
//     };
// }());
//
// ////right side slider///////////////
// $(function() {
//         var THUMBNAIL_WIDTH = 20,
//             GALLERY = $('.right-feed-custom');
//
//         GALLERY.find('.thumb').on('click', function() {
//                 loadClickedImage($(this).data('thumb-id'));
//         });
//         GALLERY.find('#prev-btn').on('click', function() {
//                 slidePrev();
//         });
//         GALLERY.find('#next-btn').on('click', function() {
//                 slideNext();
//         });
//         $(document).keydown(function(e){
//                 switch(e.keyCode) {
//                     // Left arrow press
//                         case 37:
//                                 slidePrev();
//                                 break;
//                     // Right arrow press
//                         case 39:
//                                 slideNext();
//                                 break;
//                         default:
//                                 break;
//                 }
//         });
//
//         var slideNext = function() {
//                 console.log('slideNext image ')
//                 var active = GALLERY.find('.img-wrapper.active');
//                 console.log('next')
//                 if (active.length === 0) {
//                         active = GALLERY.find('.img-wrapper:last');
//                 }
//
//                 // Setting next image & thumb properties
//                 loadNextImage(active);
//         };
//
//         var loadNextImage = function(active) {
//                 console.log('loadNextImage image ', active)
//                 // var next =  active.next(".img-wrapper").length ? active.next(".img-wrapper") : GALLERY.find('.img-wrapper:first'),
//                 //     nextThumb = GALLERY.find('[data-thumb-id="' + next.data('img-id') + '"]');
//
//                 // var next_id = GALLERY.find('[data-thumb-id="2"]');
//                 let active_thumb = GALLERY.find('.thumbs li.active');
//                 let next_thumb_id = (GALLERY.find('.thumbs li').length > active_thumb.data('thumb-id'))? active_thumb.data('thumb-id') + 1 : 1 ;
//                 console.log('thumb id is ',next_thumb_id, GALLERY.find('.thumbs').length, active_thumb.data('thumb-id'), active_thumb)
//                 // var nextThumb = GALLERY.find('[data-thumb-id="' + next.data('img-id') + '"]');
//                 var nextThumb = GALLERY.find('[data-thumb-id="' + next_thumb_id + '"]');
//                 // Setting next image & thumb properties
//                 GALLERY.find('.thumb').removeClass('active');
//                 nextThumb.addClass('active');
//                 active.addClass('last-active');
//
//                 // Transitioning to next image & thumbnail
//                 scrollThumbnails(nextThumb);
//                 // next.css({opacity: 0.0})
//                 //     .addClass('active')
//                 //     .animate({opacity: 1.0}, 1000, function() {
//                 //         active.removeClass('active last-active');
//                 //     });
//         };
//
//         var slidePrev = function() {
//                 console.log('slider prev')
//                 var active = GALLERY.find('.img-wrapper.active');
//
//                 if (active.length === 0) {
//                         active = GALLERY.find('.img-wrapper:last');
//                 }
//
//                 // Setting next image & thumb properties
//                 loadPrevImage(active);
//         };
//
//         var loadPrevImage = function(active) {
//                 console.log('loadPrevImage ')
//                 let active_thumb = GALLERY.find('.thumbs li.active');
//                 let prev_thumb_id = (GALLERY.find('.thumbs li').length > active_thumb.data('thumb-id') && active_thumb.data('thumb-id') > 1)? active_thumb.data('thumb-id') - 1 : 1 ;
//
//                 // var prev =  active.prev(".img-wrapper").length ? active.prev(".img-wrapper") : GALLERY.find('.img-wrapper:last'),
//                 //     prevThumb = GALLERY.find('[data-thumb-id="' + prev.data('img-id') + '"]');
//                 console.log('prev_thumb_id', prev_thumb_id)
//                 var prevThumb = GALLERY.find('[data-thumb-id="' + prev_thumb_id + '"]');
//                 // Setting next image & thumb properties
//                 GALLERY.find('.thumb').removeClass('active');
//                 prevThumb.addClass('active');
//                 active.addClass('last-active');
//
//                 // Transitioning to next image & thumbnail
//                 scrollThumbnails(prevThumb);
//                 prev.css({opacity: 0.0})
//                     .addClass('active')
//                     .animate({opacity: 1.0}, 1000, function() {
//                             active.removeClass('active last-active');
//                     });
//         };
//
//         var loadClickedImage = function(id) {
//                 var image =  GALLERY.find('[data-img-id="' + id + '"]'),
//                     imgThumb = GALLERY.find('[data-thumb-id="' + id + '"]'),
//                     currActive = GALLERY.find('.img-wrapper.active');
//
//                 // Setting image & thumb properties
//                 GALLERY.find('.thumb').removeClass('active');
//                 currActive.addClass('last-active').removeClass('active');
//                 imgThumb.addClass('active');
//
//                 // Transitioning to image & thumbnail
//                 scrollThumbnails(imgThumb);
//                 image.css({opacity: 0.0})
//                     .addClass('active')
//                     .animate({opacity: 1.0}, 1000, function() {
//                             currActive.removeClass('last-active');
//                     });
//         };
//
//         var scrollThumbnails = function(thumb) {
//                 console.log('thumb ',thumb)
//                 var offset, // used for thumbnail offset
//                     first,  // stores first thumbnail object
//                     x = thumb.position().left + parseInt(thumb.css('margin-left'), 20);
//
//                 // Checking current thumbnail offset
//                 if(x < 0) {
//                         first = GALLERY.find('.thumb:first');
//                         offset = parseInt(first.css('margin-left'), 20) - x;
//                         first.animate({
//                                 marginLeft: offset
//                         }, 1000);
//                 } else {
//                         x = thumb.position().left;
//                         var currOffset = ( x + THUMBNAIL_WIDTH ) - thumb.parent().width();
//                         if(currOffset > 0) {
//                                 first = GALLERY.find('.thumb:first');
//                                 offset = parseInt(first.css('margin-left'), 20) - currOffset;
//                                 first.animate({
//                                         marginLeft: offset
//                                 }, 1000);
//                         }
//                 }
//         };
// }());


$(document).ready(function(){

    $('.left_slide').slick({
        dots: false,
        arrows: true,
        speed: 300,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 2,
        slidesToScroll: 1,
        responsive: [
            {
              breakpoint: 1200,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
              }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true
                }
            }
        ]
    });

    $('.right_slide').slick({
        dots: false,
        arrows: true,
        speed: 300,
        infinite: true,
        autoplay: true, 
        autoplaySpeed: 2000,
        slidesToShow: 2,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true
                }
            }
        ]
    });
});