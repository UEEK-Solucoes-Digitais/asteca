// import Swiper bundle with all modules installed
import Swiper from 'swiper/bundle';

// import styles bundle
import 'swiper/css/bundle';

window.pathArray = window.location.pathname.split('/');
window.currentLocation = pathArray[1];

window.openModal = function (modal) {
	if (modal != "") {
		$("#" + modal).addClass("show")
		$("body").css({
			overflow: 'hidden',
		})
	}
}

window.closeModal = function (modal) {
	if (modal != "") {
		$("#" + modal).removeClass("show")
		$("body").css({
			overflow: 'auto',
		})
	}
}

$(".custom-modal .background, .custom-modal .close-modal").on("click", function () {
	let id = $(this).parents(".custom-modal").attr("id")

	closeModal(id)
})

window.removeEffects = function () {

	if ($(window).width() < 1200) {
		$('.rightShow').removeClass('rightShow').addClass("sequenced-bottom");
		$('.leftShow').removeClass('leftShow').addClass("sequenced-bottom");
		$('.slide-left').removeClass('slide-left').addClass("sequenced-bottom");
		$('.slide-right').removeClass('slide-right').addClass("sequenced-bottom");
		$('.slide-up').removeClass('slide-up').addClass("sequenced-bottom");
	}
}

window.setEffects = function () {

	window.sr = ScrollReveal({ reset: false, distance: '80px' });
	sr.reveal('.efeito');
	sr.reveal('.fadeIn', { duration: 1400 });

	sr.reveal('.rightShow', {
		origin: 'right',
		duration: 1300
	});

	sr.reveal('.leftShow', {
		origin: 'left',
		duration: 1300
	});

	sr.reveal('.topShow', {
		origin: 'top',
		duration: 1300
	});

	sr.reveal('.bottomShow', {
		origin: 'bottom',
		duration: 1300
	});

	var slideBottom = {
		distance: '200%',
		origin: 'bottom',
		duration: 1300,
		reset: false,
		interval: 50,
	};
	ScrollReveal().reveal('.slide-up', slideBottom);


	var slideLeft = {
		distance: '200%',
		origin: 'left',
		duration: 1300,
		reset: false,
		interval: 50,
	};
	ScrollReveal().reveal('.slide-left', slideLeft);

	var slideRight = {
		distance: '200%',
		origin: 'right',
		duration: 1300,
		reset: false
	};
	ScrollReveal().reveal('.slide-right', slideRight);

	var slideTop = {
		distance: '200%',
		origin: 'top',
		duration: 1300,
		reset: false
	};
	ScrollReveal().reveal('.slide-top', slideTop);

	var slideSequencedLeft = {
		origin: 'left',
		reset: false,
		duration: 1300,
		interval: 300
	};
	ScrollReveal().reveal('.sequenced-left', slideSequencedLeft);

	var slideSequencedRight = {
		origin: 'right',
		reset: false,
		duration: 1200,
		interval: 300
	};
	ScrollReveal().reveal('.sequenced-right', slideSequencedRight);

	var slideSequencedTop = {
		origin: 'top',
		reset: false,
		duration: 1300,
		interval: 300
	};
	ScrollReveal().reveal('.sequenced-top', slideSequencedTop);

	var slideSequencedBottom = {
		origin: 'bottom',
		reset: false,
		duration: 1300,
		interval: 300
	};
	ScrollReveal().reveal('.sequenced-bottom', slideSequencedBottom);

}

window.clickOnLinksBehavior = function () {
	$('a[href*="#"]').not('[href="#"]').not('[href="#0"]').not('[data-toggle]').click(function (event) {
		if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

			if (target.length) {

				event.preventDefault();

				$('html, body').animate({
					scrollTop: target.offset().top
				}, 600);
			}
		}
	});
}

window.checkViewport = function () {

	var scrollPos = $(document).scrollTop();

	if (currentLocation == "") {
		if (scrollPos < 40) {
			$("header").removeClass("scroll")
		} else {
			$("header").addClass("scroll")
		}

	} else {
		$("header").addClass("scroll")
	}
}

window.closeMenuByBackground = function () {
	$(".nav-default .background").on("click", function () {
		$(this).parents("nav").toggleClass("menu-mobile-opened")
		checkMenuOpened();
	})
}

$(".nav-toggle .nav-button").on("click", function () {
	$(this).parents("nav").toggleClass("menu-mobile-opened")

	checkMenuOpened();
})

window.checkMenuOpened = function () {
	if ($(".nav-default").hasClass("menu-mobile-opened")) {
		$("body").css({
			overflow: 'hidden',
		})
	} else {
		$("body").css({
			overflow: 'auto',
		})
	}
}

window.closeMenuOnLinkClick = function () {
	$(".nav-mobile-links a").on("click", function () {
		$(this).parents("nav").toggleClass("menu-mobile-opened")
		checkMenuOpened();
	})
}

window.setLeftPosition = async function () {

	let defaultMarginLeft = $('.container').css('margin-left');

	if (defaultMarginLeft != 'auto') {

		defaultMarginLeft = defaultMarginLeft.replace('px', '');
		defaultMarginLeft = +defaultMarginLeft + 25;

	} else {

		defaultMarginLeft = '30';

	}

	$('.release-swiper.swiper-container').css('padding-left', defaultMarginLeft + 'px');

}

window.loadBannerSwiper = async function () {

	new Swiper('.banner-swiper.swiper-container', {
		slidesPerView: 4,
		direction: 'vertical',
	})
}

window.loadAboutSwiper = async function () {

	new Swiper('.about-swiper.swiper-container', {
		slidesPerView: 1,
		preloadImages: false,
		lazy: true,
		pagination: {
			el: '.swiper-pagination',
			type: 'bullets',
			clickable: true
		},
	})
}

window.loadPropertyGallerySwiper = async function () {

	new Swiper('.property-gallery.swiper-container', {
		slidesPerView: 3.2,
		preloadImages: false,
		spaceBetween: 15,
		lazy: true,
		breakpoints: {
			0: {
				slidesPerView: 1.2,
				spaceBetween: 10,
			},
			700: {
				slidesPerView: 3.2,
				spaceBetween: 10,
			},
		}
		// navigation: {
		// 	nextEl: '.swiper-button-next',
		// 	prevEl: '.swiper-button-prev',
		// },
	})
}

window.loadReleaseSwiper = async function () {

	new Swiper('.release-swiper.swiper-container', {
		preloadImages: false,
		lazy: true,
		breakpoints: {
			0: {
				slidesPerView: 1.2,
				spaceBetween: 15,
			},
			700: {
				slidesPerView: 3.2,
				spaceBetween: 20,
			},
			1200: {
				slidesPerView: 4.2,
				spaceBetween: 20,
			},
			1400: {
				slidesPerView: 5.2,
				spaceBetween: 20,
			},
		}
	})
}

window.clickOnBannerOption = function () {
	$(".change-banner-image-js").on("click", function () {
		if (!$(this).hasClass("active")) {
			const banner = $(this).data("value");
			const button = $(this);

			$.ajax({
				url: getBannerRoute,
				type: "POST",
				data: { id: banner, _token: token_value },
				dataType: 'json',
				success: function (retorno) {
					$("#banner h1").text(retorno.banner.title)
					$("#banner .text").html(retorno.banner.text)
					$("#banner .btn-geral").text(retorno.banner.btn_text)
					$("#banner .btn-geral").attr("href", retorno.banner.btn_link)

					$("#banner picture source[type='image/webp']").attr("srcset", `${url_site}/img/uploads/banners/${retorno.banner.image_webp}`)
					$("#banner picture source[type='image/png']").attr("srcset", `${url_site}/img/uploads/banners/${retorno.banner.image}`)
					$("#banner picture img").attr("src", `${url_site}/img/uploads/banners/${retorno.banner.image}`)

					$(".change-banner-image-js").removeClass("active")
					button.addClass("active")
				},
				error: function (retorno) {
					console.log('erro')
				}
			});
		}
	})
}

window.clickOnPropertyGalleryOption = function () {
	$(".change-gallery-image").on("click", function () {
		const bannerImage = $(this).find("img").attr("src")

		$(".property-gallery-area .image img").attr("src", bannerImage)
		$(".property-gallery-area .image a").attr("href", bannerImage)
	})
}

window.geralPagination = function () {


	$(".geral-pagination").each(function () {
		let id = $(this).attr('id');

		$(`#${id}`).html('')

		let closestList = $(this).parent().find('.list-to-paginate')

		let items = closestList.find('.pagination-item')
		items = Array.from(items)

		console.log(items);

		if (items.length > 6) {
			$(`#${id}`).pagination({
				dataSource: items,
				pageSize: 6,
				showPageNumbers: true,
				showNext: true,
				showPrevious: true,
				prevText: '<iconify-icon icon="akar-icons:chevron-left"></iconify-icon>',
				nextText: '<iconify-icon icon="akar-icons:chevron-right"></iconify-icon>',
				callback: function (data, pagination) {
					closestList.html(data)
				}
			})
		}
	})
}

var resetCircles = function () {

	if ($('.progress-ring-circle').length > 0) {

		var circles = $(document).find('.progress-ring-circle');

		var radius = circles[0].r.baseVal.value;
		var circumference = radius * 2 * Math.PI;

		circles.css('stroke-dasharray', circumference + ' ' + circumference)
		circles.css('stroke-dashoffset', circumference);

	}

}

var allowAnimation = true;

var setProgress = function () {

	if (allowAnimation) {

		var time = 500;

		$('.circle').each(function (i) {

			var item = $(this);

			setTimeout(function () {

				let percent = item.find('input').val();

				if (percent != 0) {

					var circle = $('#circle');

					var radius = circle[0].r.baseVal.value;
					var circumference = radius * 2 * Math.PI;

					const offset = circumference - percent / 100 * circumference;

					// if ($(window).width() <= 768) {

					// 	$(circle[0])[0].cx.baseVal.value = 40;
					// 	$(circle[0])[0].cy.baseVal.value = 40;

					// }

					circle[0].style.strokeDashoffset = offset;
				}

			}, time);

			time += 500;

		})

		// allowAnimation = false;
	}
}

window.detectModalOpen = function () {
	$(".modal-with-swiper").on("show.bs.modal", function () {
		let swiper = $(this).find(".modal-swiper").attr('id')
		let swiperThumb = $(this).find(".modal-thumb-swiper").attr('id')

		setSwipers(swiper, swiperThumb, $(this))
	})
}

window.setSwipers = function (swiper, swiperThumb, modal) {

	var swiperThumb = new Swiper(`#${swiperThumb}`, {
		spaceBetween: 10,
		watchSlidesProgress: true,
		preloadImages: false,
		lazy: true,
		breakpoints: {
			0: {
				slidesPerView: 2,
			},
			700: {
				slidesPerView: 4,
			},
			1200: {
				slidesPerView: 6,
			},
		}
	});

	var swiperNormal = new Swiper(`#${swiper}`, {
		spaceBetween: 10,
		preloadImages: false,
		lazy: true,
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
		thumbs: {
			swiper: swiperThumb,
		},
	});

	modal.on("hide.bs.modal", function () {
		swiperThumb.destroy()
		swiperNormal.destroy()
	})
}

$(".property-type-select .cs-options li").on('click', function (e) {
	const value = $(this).data('value');
	const arr = value.split('-');
	const control = arr[0];
	const id = arr[1];

	let route = control == 'location' ? 'locacao' : 'lancamentos';

	window.location.href = `${window.pathArray[0]}/imoveis/${route}/${id}`;

})


$(window).scroll(function () {

	/* Caso o header possua estado de scroll*/
	checkViewport();

});


$(document).ready(async function () {
	/* para swipers que devem estar alinhados com o container */
	loadReleaseSwiper();
	await setLeftPosition()

	removeEffects();
	setEffects();
	clickOnLinksBehavior();

	/* Caso o header possua estado de scroll*/
	checkViewport();

	geralPagination();

	detectModalOpen();

	/* se tiver swipers: */
	await loadBannerSwiper();
	await loadAboutSwiper();
	await loadPropertyGallerySwiper();
	clickOnBannerOption();
	clickOnPropertyGalleryOption();

	resetCircles();
	setProgress();

	if ($(window).width() < 1200) {
		closeMenuByBackground();
		// adjustBody();
		closeMenuOnLinkClick()
	}
});
