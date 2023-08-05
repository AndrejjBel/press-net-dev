const navScroll = () => {
    const masthead = document.getElementById('masthead')
    if ( masthead ) {
        const home = document.querySelector('.home')
        const body = document.querySelector('body')
        var prevScrollpos = window.pageYOffset;
        if ( home ) {
            if ( body.getBoundingClientRect().top < 0 ) {
                document.querySelector('.home #masthead').classList.remove('color-home')
            } else {
                document.querySelector('.home #masthead').classList.add('color-home')
            }
        }
        window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;
            if ( home ) {
                if ( body.getBoundingClientRect().top < 0 ) {
                    document.querySelector('.home #masthead').classList.remove('color-home')
                } else {
                    document.querySelector('.home #masthead').classList.add('color-home')
                }
            }
            if (prevScrollpos > currentScrollPos) {
                masthead.style.top = '0';
            } else {
                if (prevScrollpos > 80) {
                    masthead.style.top = '-80px';
                }
            }
            prevScrollpos = currentScrollPos;
        }
    }
}
navScroll()

const menuMobile = () => {
    const mobileToggle = document.querySelector('.menu-toggle')
    if ( mobileToggle ) {
        const navWrapper = document.querySelector('.header-generale__navigation')
        const liItemsHasChildren = document.querySelectorAll('li.menu-item-has-children')
        const topMenuClouse = document.querySelector('.menu-clouse')
        const overlay = document.querySelector('.js-overlay-modal')
        const body = document.querySelector('body')

        mobileToggle.addEventListener('click', () => {
            overlay.classList.add('active')
            navWrapper.style.display = 'block'
            navWrapper.style.height = '100vh'
            body.style.overflow = 'hidden'
        })

        topMenuClouse.addEventListener('click', () => {
            overlay.classList.remove('active')
            navWrapper.style.display = ''
            navWrapper.style.height = ''
            body.style.overflow = ''
        })

        document.body.addEventListener('keyup', function (e) {
            var key = e.keyCode;

            if (key == 27) {

                overlay.classList.remove('active')
                navWrapper.style.display = ''
                navWrapper.style.height = ''
                body.style.overflow = ''
            };
        }, false);


         if ( overlay ) {
            overlay.addEventListener('click', function() {
                overlay.classList.remove('active')
                navWrapper.style.display = ''
                navWrapper.style.height = ''
                body.style.overflow = ''
            });
        }

        liItemsHasChildren.forEach((item) => {
            item.addEventListener('click', function() {
                if ( window.innerWidth <= 991 ) {
                    item.children[1].classList.toggle('active')
                    item.children[2].classList.toggle('active')
                }
            })
        });
    }
}
menuMobile()

const navItemsParent = () => {
    const itemsHasChildren = document.querySelectorAll('#primary-nav-menu ul li.menu-item-has-children')
    if ( itemsHasChildren ) {
        itemsHasChildren.forEach((item) => {
            item.addEventListener('click', (e)=> {
                if ( item.children[0].attributes.href.value == '#' ) {
                    e.preventDefault();
                }
            })
        });

    }
}
navItemsParent()

const cookieHidden = () => {
    const cookieBar = document.querySelector('.cookie-bar')
    const btnCookie = document.querySelector('#cookie-yes')
    if ( cookieBar ) {
        let cookieUser = localStorage.getItem('climatCookieUser')
        if ( cookieUser !== 'yes' ) {
            cookieBar.classList.add('visible')
        }
        btnCookie.addEventListener('click', (e)=> {
            localStorage.setItem('climatCookieUser', 'yes' )
            cookieBar.classList.remove('visible')
        })
    }
}
cookieHidden()

document.addEventListener("DOMContentLoaded", function () {
  var eventCalllback = function (e) {
    var el = e.target,
    clearVal = el.dataset.phoneClear,
    pattern = el.dataset.phonePattern,
    matrix_def = "+7(___) ___-__-__",
    matrix = pattern ? pattern : matrix_def,
    i = 0,
    def = matrix.replace(/\D/g, ""),
    val = e.target.value.replace(/\D/g, "");
    if (clearVal !== 'false' && e.type === 'blur') {
      if (val.length < matrix.match(/([\_\d])/g).length) {
        e.target.value = '';
        return;
      }
    }
    if (def.length >= val.length) val = def;
    e.target.value = matrix.replace(/./g, function (a) {
      return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? "" : a
    });
  }
  //var phone_inputs = document.querySelectorAll('[data-phone-pattern]');
  var phone_inputs = document.querySelectorAll('.phone_mask');
  for (let elem of phone_inputs) {
    for (let ev of ['input', 'blur', 'focus']) {
      elem.addEventListener(ev, eventCalllback);
    }
  }
});

// Модальные окна
!function(e){"function"!=typeof e.matches&&(e.matches=e.msMatchesSelector||e.mozMatchesSelector||e.webkitMatchesSelector||function(e){for(var t=this,o=(t.document||t.ownerDocument).querySelectorAll(e),n=0;o[n]&&o[n]!==t;)++n;return Boolean(o[n])}),"function"!=typeof e.closest&&(e.closest=function(e){for(var t=this;t&&1===t.nodeType;){if(t.matches(e))return t;t=t.parentNode}return null})}(window.Element.prototype);
document.addEventListener('DOMContentLoaded', function() {
    var modalButtons = document.querySelectorAll('.js-open-modal'),
    modal = document.querySelector('.modal'),
    overlay      = document.querySelector('.js-overlay-modal'),
    closeButtons = document.querySelectorAll('.js-modal-close');
    body          = document.querySelector('body'),
    modalButtons.forEach(function(item){
        item.addEventListener('click', function(e) {
            e.preventDefault();
            var modalId = this.getAttribute('data-modal'),
            modalElem = document.querySelector('.modal[data-modal="' + modalId + '"]');
            modalElem.classList.add('active');
            overlay.classList.add('active');
            // body.style.overflowY = 'hidden';
            if ( item.dataset.modal = 'add-request-form' ) {
                overlay.style.zIndex = 99;
            }
        }); // end click
    }); // end foreach
    closeButtons.forEach(function(item){
        item.addEventListener('click', function(e) {
            var parentModal = this.closest('.modal');
            parentModal.classList.remove('active');
            overlay.classList.remove('active');
            overlay.style.zIndex = '';
            body.style.overflowY = '';
        });
    }); // end foreach
    document.body.addEventListener('keyup', function (e) {
        var key = e.keyCode;
        if (key == 27) {
            if ( modal ) {
                modal.classList.remove('active');
                overlay.classList.remove('active');
                overlay.style.zIndex = '';
            }
            body.style.overflowY = '';
        };
    }, false);
    if (overlay) {
        overlay.addEventListener('click', function() {
            if ( modal ) {
                modal.classList.remove('active');
                overlay.style.zIndex = '';
            }
            this.classList.remove('active');
            body.style.overflowY = '';
        });
    }
}); // end ready (Модальные окна)

// jQuery
jQuery(document).ready( function($){

    function scrollToTop(pxShow, scrollSpeed){
        // pxShow - height on which the button will show
    	// scrollSpeed - how slow / fast you want the button to scroll to top.
        $(window).scroll(function(){
    	 if($(window).scrollTop() >= pxShow){
    		$(".btn-to-top").addClass('visible');
            $(".request-call").addClass('btn-top-vision');
    	 } else {
    		$(".btn-to-top").removeClass('visible');
            $(".request-call").removeClass('btn-top-vision');
    	 }
    	});
        $('a.scroll-to-top').on('click', function(){
            $('html, body').animate({scrollTop:0}, scrollSpeed);
            return false;
        });
    }
    scrollToTop(400, 400);

    function scrollAnimate(){
        $(document).on('click', 'a.animate-scroll[href^="#"]', function (event) {
            event.preventDefault();
            //var indent = $($.attr(this, 'href')).attr('data-top');
            var indent = $(this).attr('data-top');
            if (indent) {
                indent_top = indent;
            } else {
                indent_top = 0;
            }
            if ($($.attr(this, 'href')).length > 0) {
                $('html, body').animate({
                    scrollTop: $($.attr(this, 'href')).offset().top - indent_top
                }, 500);
            }
        });
    }
    scrollAnimate();

    // magnificPopup
    function mfpInit( index ) {
        $('.gallery-'+index).magnificPopup({
            type: 'image',
            delegate: '.mfp',
            tClose: 'Закрыть (Esc)',
            tLoading: 'Загрузка...',
            gallery:{
                enabled: true,
                tPrev: 'Назад',
                tNext: 'Вперед',
                tCounter: '%curr% из %total%'
            },
            image: {
                tError: '<a href="%url%">Изображение</a> не удалось загрузить.'
            },
            ajax: {
                tError: '<a href="%url%">Запрос</a> не выполнен.'
            }
        });
    }
    // mfpInit('1');
    // mfpInit('2');
    // mfpInit('3');
    // mfpInit('4');
    // mfpInit('5');
    // mfpInit('6');
    // mfpInit('7');
    // mfpInit('8');
    // mfpInit('9');
    // mfpInit('10');
    // mfpInit('11');
    // mfpInit('12');
    // mfpInit('13');
    // mfpInit('14');
    // mfpInit('15');
    // mfpInit('16');
    // mfpInit('17');
    // mfpInit('18');
    // mfpInit('19');
    // mfpInit('20');
    // mfpInit('all');

    // $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
	// 	disableOn: 700,
	// 	type: 'iframe',
	// 	mainClass: 'mfp-fade',
    //     tClose: 'Закрыть (Esc)',
	// 	removalDelay: 160,
	// 	preloader: false,
    //     fixedContentPos: true,
    //     fixedBgPos: true,
    //     overflowY: 'hidden',
	// });
    //
    // $('.image-popup-fit-width').magnificPopup({
	// 	type: 'image',
	// 	closeOnContentClick: true,
	// 	image: {
	// 		verticalFit: false
	// 	}
	// });
    //
    // $('.image-popup-vertical-fit').magnificPopup({
	// 	type: 'image',
	// 	closeOnContentClick: true,
	// 	mainClass: 'mfp-img-mobile',
	// 	image: {
	// 		verticalFit: true
	// 	}
    //
	// });

});
