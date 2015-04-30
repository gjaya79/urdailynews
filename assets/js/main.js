/*global jQuery:false*/
window.jQuery = window.$ = jQuery;

var $body = $('body');

var App = {
	
	start: function() {
		
		App.slider();
		
		App.bind();
		
		App.popularWidget();
		
		App.magnificPopup();
		
		App.lazyImages();
		
		App.navigation();
		
		App.gridLayouts();
		
		App.imageHoverEffects();
		
		App.stickyHeader();
		
		App.wrapperImage();
		
		App.parallaxHeader();
		
		App.mobileNav();
		
	},
	
	mobileNav: function() {
		
		$('#mobile-toggle').bind('click', function() {
			
			$body.toggleClass('mobile-visible');
			
			var windowHeight = $(window).height();
			
			if($('#wpadminbar')) {
				windowHeight -= $('#wpadminbar').height();
			}
			
			if($body.hasClass('mobile-visible')) {
				$('#wrapper').height( windowHeight ).addClass('overflow');
			}else{
				$('#wrapper').height( 'auto' ).removeClass('overflow');
			}
		});
		
	},
	
	parallaxHeader: function() {
		
		if( $('.header-parallax').length ) {
			
			$(window).scroll(function() {
				if( $(window).width() > 1024 ) {
					$('.header-parallax').css('background-position', '50% ' + ( $(window).scrollTop() * -0.5 ) + 'px');
				}
			});
			
		}
		
	},
	
	wrapperImage: function() {
		
		var $bg = $('#bw-bg');
		
		var wrapperBg = $bg.css('background-image');
		
		if( wrapperBg !== 'none' ) {
		
			var src = wrapperBg.replace(/(^url\()|(\)$|[\"\'])/g, '');
			
			img = $('<img>').attr('src', src).on('load', function() {
				$bg.addClass('visible');
			});
		}
		
	},
	
	stickyHeader: function() {
		
		if( $('#header .row-holder.enable-sticky').length ) {
			
			App.checkSticky();
			
			$(window).scroll(function() {
				
				App.checkSticky();
				
			});
		}
		
	},
	
	checkSticky: function() {
		
		if( $(window).scrollTop() > ( $('#header').height() + 50 ) ) {
			if( ! $('#header .row-holder').hasClass('sticky') ) {
				$('#header .row-holder').addClass('sticky');
			}
		}
		
		if( $(window).scrollTop() < ( $('#header').height() ) ) {
			$('#header .row-holder.sticky').removeClass('sticky');
		}
		
	},
	
	imageHoverEffects: function() {
		
		if( ! $body.hasClass( 'disable-image-hover' ) ) {
			
			jQuery(document).on('mouseenter', '.bw-over .article-thumb', function() {
				
				var $element = jQuery('.image-wrap', this);
				var $elementOver = jQuery('.over', this);
				
				TweenLite.to($element, 0.4, {scale: 1.04, ease:Back.easeOut});
				TweenLite.to($elementOver, 0.3, {alpha: 0.15});
					
			}).on('mouseout', '.bw-over .article-thumb', function() {
				TweenLite.to(jQuery('.image-wrap', this), 0.4, {scale: 1, ease:Quad.easeOut});
				TweenLite.to(jQuery('.over', this), 0.3, {alpha: 0});
			});
			
		}
		
	},
	
	gridLayouts: function() {
		
		if( $body.hasClass('enable-lazy-image') ) {
			
			$('.posts-grid img').load(function() {
				
				App.initGridLayout();
				
			});
			
		}else{
			
			App.initGridLayout();
			
		}
		
	},
	
	initGridLayout: function() {
		
		$('.posts-grid').isotope({
			itemSelector: '.post',
		});
		
	},
	
	navigation: function() {
		
		$('#navigation .menu > li').hoverIntent({
			over: App.showMegaMenu,
			out: App.hideMegaMenu,
			interval: 50,
			timeout: 100,
		});
		
	},
	
	showMegaMenu: function() {
        var self = $('.bw-megamenu', this);
        self.removeClass('hidden');
        setTimeout(function() {
			self.addClass('open');
        }, 50);
    },
	
    hideMegaMenu: function() {
        var self = $('.bw-megamenu', this);
        self.removeClass('open');
        setTimeout(function() {
			self.addClass('hidden');
        }, 200);
    },
	
	lazyImages: function() {
		
		$(document).ready(function() {
			
			if( $body.hasClass('enable-lazy-image') ) {
				
				$('img.lazy').unveil(0, function() {
					$(this).load(function() {
						$(this).delay(200).queue(function(next) {
							$(this).css('opacity', 1);
						});
					});
				});
				
			}
			
		});
		
	},
	
	magnificPopup: function() {
		$('.mp-item').magnificPopup({
			type: 'image',
			gallery: {enabled: true, preload: true},
			image: {
				/*titleSrc: function(item) {
					return item.el.children().attr('alt');
				}*/
			}
		});
	},
	
	bind: function() {
		
		// disable empty urls
		jQuery(document).on('click', 'a[href="#"]', function(e) {
			e.preventDefault();
		});
		
	},
	
	slider: function() {
		
		var $bwSlider = $('.bw-slider, .bw-widget-slider');
		
		if($bwSlider.length > 0) {
			
			var featuredSpeed;
			
			$(document).ready(function() {
				
				$bwSlider.each(function() {
					
					featuredSpeed = $(this).attr('data-speed') ? $(this).attr('data-speed') : false;
					
					$(this).owlCarousel({
						autoPlay:$(this).hasClass('auto-play') ? true : false,
						stopOnHover:true,
						navigation:true,
						pagination:$(this).hasClass('slider-pagination'),
						paginationSpeed:1000,
						goToFirstSpeed:2000,
						singleItem:true,
						autoHeight:true,
						transitionStyle: ( $(this).attr('data-transition') == 'slide' ) ? false : $(this).attr('data-transition'),
						navigationText:['',''],
						afterInit:function(e) {
							
							if( e.hasClass('billboard-slider') || e.hasClass('post-gallery') ) {
								
								e.parent().addClass('expand');
								
							}
							
						},
						afterMove:function(e) {
							
							if( e.hasClass('billboard-slider') ) {
								
								var $owl = e.data('owlCarousel');
								
								var $flipItem = $owl.$owlItems.eq($owl.currentItem);
								
								jQuery('.owl-item .info-holder', e).removeClass('flipInX animated');
								$('.info-holder', $flipItem).addClass('flipInX animated');
								
							}
							
						}
					});
				});
			});
		}
	},
	
	popularWidget: function() {
		
		var $tab = jQuery('.bw-polular-widget-holder .bw-sidebar-posts');
		var $holder = jQuery('.bw-polular-widget-holder');
		var $popularNav = jQuery('.bw-popular-widget-nav a');
		
		$tab.hide();
		jQuery('.bw-sidebar-posts:first', $holder).show(0);
		
		$popularNav.bind('click', function() {
			
			var $this = jQuery(this);
			
			var $popularHolder = jQuery(this).closest('.bw-polular-widget-holder');
			jQuery('.bw-popular-widget-nav a', $popularHolder).removeClass('active');
			$this.addClass('active');
			
			jQuery('.bw-sidebar-posts', $popularHolder).hide();
			jQuery('.bw-sidebar-posts.' + $this.attr('data-parent'), $popularHolder).fadeIn(300);
			
		});
		
	}
	
};

App.start();