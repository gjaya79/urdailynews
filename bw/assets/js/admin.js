// Expose jQuery to the global object
window.jQuery = window.$ = jQuery;

// main object
var BwAdmin = {
	
	init: function() {
		
		BwAdmin.import_sample_data();
		
		BwAdmin.dynamic_fonts();
		
		BwAdmin.bw_gallery.init();
		
		BwAdmin.dynamic_meta.init();
		
		BwAdmin.ot_custom_logic();
		
	},
	
	bw_gallery: {
		
		init: function() {
			
			BwAdmin.bw_gallery.create();
			
			if( $('#bw-gallery').length > 0 ) {
				BwAdmin.bw_gallery.get_preview();
			}
			
		},
		
		create: function() {
			if($('#bw-gallery-add').length > 0) {
				
				var frame = wp.media({
					displaySettings:    false,
					id:                 'bwgallery-frame',
					title:              'BwGallery',
					filterable:         'uploaded',
					frame:              'post',
					state:              'gallery-edit',
					library:            { type : 'image' },
					multiple:           true,  // Set to true to allow multiple files to be selected
					editing:            true,
					selection:          BwAdmin.bw_gallery.select()
				});
				
				$('#bw-gallery-add').on('click', function(e) {
					
					e.preventDefault();
					
					frame.on( 'update', function() {
						
						var controller = frame.states.get('gallery-edit');
						var library = controller.get('library');
						var ids = library.pluck('id');
						
						$('#bw-gallery-add input').val( ids.join(',') );
						
						BwAdmin.bw_gallery.get_preview();
					});
					
					frame.open();
					
				});
			}
		},
		
		get_preview: function() {
			
			var ids = '';
			ids = $('#bw-gallery-add input').val();

			$.ajax({
				type: "post",url: bw_admin_root.ajax, data: { action: 'bw_gallery_preview', attachments_ids: ids },
				beforeSend: function() {
					$('#bw-gallery-add i').removeClass('fa-camera-retro').addClass('icon-spin fa-refresh');
				},
				complete: function() {
					$('#bw-gallery-add i').removeClass('icon-spin fa-refresh').addClass('fa-camera-retro');
				},
				success: function( response ){
					var result = JSON.parse(response);
					if (result.success ) {
						$('#bw-gallery > ul').html(result.output);
					}
				}
			});
			
		},
		
		select: function() {
			var galleries_ids = $('#bw-gallery-add input').val(),
				shortcode = wp.shortcode.next( 'gallery', '[gallery ids="'+ galleries_ids +'"]' ),
				defaultPostId = wp.media.gallery.defaults.id,
				attachments, selection;
			// Bail if we didn't match the shortcode or all of the content.
			if ( ! shortcode )
				return;

			// Ignore the rest of the match object.
			shortcode = shortcode.shortcode;

			if ( _.isUndefined( shortcode.get('id') ) && ! _.isUndefined( defaultPostId ) )
				shortcode.set( 'id', defaultPostId );

			attachments = wp.media.gallery.attachments( shortcode );
			selection = new wp.media.model.Selection( attachments.models, {
				props:    attachments.props.toJSON(),
				multiple: true
			});

			selection.gallery = attachments.gallery;

			// Fetch the query's attachments, and then break ties from the
			// query to allow for sorting.
			selection.more().done( function() {
				// Break ties with the query.
				selection.props.set({ query: false });
				selection.unmirror();
				selection.props.unset('orderby');
			});

			return selection;
		}
		
	},
	
	ot_custom_logic: function() {
		
		$('#setting_header_html').hide();
		
		BwAdmin.ot_custom_logic_header_content( $( ".format-setting-inner .option-tree-ui-radio-images" )
			.index( $('#setting_header_type img.option-tree-ui-radio-image-selected').closest('.option-tree-ui-radio-images') ) );
		
		$('#setting_header_type img').on('click', function() {
			
			var radioIndex = $( ".format-setting-inner .option-tree-ui-radio-images" ).index( $(this).closest('.option-tree-ui-radio-images') );
			
			BwAdmin.ot_custom_logic_header_content( radioIndex );
			
		});
		
		// hide navigation color when color inverted
		$(document).ready(BwAdmin.ot_check_invert());
		$('#invert_header_nav_color').closest('.bw-on-off').on('click', function() {BwAdmin.ot_check_invert()});
		
		// hide header color when color inverted
		$(document).ready(BwAdmin.ot_check_invert_header());
		$('#header_white').closest('.bw-on-off').on('click', function() {BwAdmin.ot_check_invert_header()});
		
	},
	
	ot_check_invert: function() {
		
		if($('#invert_header_nav_color').is(':checked')) {
			
			$('#setting_header_nav_color').hide();
			
		}else{
			
			$('#setting_header_nav_color').show();
			
		}
		
	},
	
	ot_check_invert_header: function() {
		
		if($('#header_white').is(':checked')) {
			
			$('#setting_header_color').hide();
			
		}else{
			
			$('#setting_header_color').show();
			
		}
		
	},
	
	ot_custom_logic_header_content: function( radioIndex ) {
		
		if( radioIndex == 1 ) {
			$('#setting_header_html').show();
		}else{
			$('#setting_header_html').hide();
		}
		
	},
	
	dynamic_fonts: function() {
		
		$('.ot-bw-google-font').change(function() {
			
			BwAdmin.change_font($(this));
			
		});
		
		if($('.ot-bw-google-font').length > 0) {
			$('.ot-bw-google-font').each(function() {
				BwAdmin.change_font($(this));
			});
		}
		
	},
	
	change_font: function(element) {
		
		var $bwFont = element.closest('.ot-bw-google-font'),
			$bwPrev = $('.bw-font-review', $bwFont),
			font 	= $('.option-tree-ui-select option', element).filter(":selected").val(),
			fontClass = $('.option-tree-ui-select option', element).filter(":selected").attr('class');
		
		if(typeof font !== 'undefined') {
			if(font !== '' && font !== null) {
				
				var $fontRel = $('<link rel="stylesheet" type="text/css" />');
				$("head").append($fontRel);
				$bwPrev.removeClass('hide has_regulat has_bold has_italic has_bolditalic').addClass(fontClass);
				
				$fontRel
				.attr("href",'http://fonts.googleapis.com/css?family=' + font.replace(/ /,"+") )
				.load(function() {
					$bwPrev.find('p').css('font-family', font);
				});
				
			}else{
				$bwPrev.addClass('hide');
			}
		}
		
	},
	
	import_sample_data: function() {
		
		var $import = $('#bw-import-content');
		
		$(".bw-import-btn", $import).click(function(e) {
			
			e.preventDefault();
			
			if ( confirm('Importing the demo data will overwrite your current Theme Options settings. Proceed anyway?') == false ) { return; }
			
			$(".bw-import-btn", $import).hide();
			$(".bw-import-loading", $import).show();
			
			jQuery.ajax({
				
				type: "POST",

				url: bw_admin_root.ajax,
				
				//dataType: 'json',

				data: {
					'action': 'import_sample_data',
					'data': 'some_data'
				},

				success: function(data) {
					$(".bw-import-loading", $import).hide();
					$(".bw-import-info", $import).html(data).show();
				}
			});
		});
	},
	
	dynamic_meta: {
		
		dymanicBox: jQuery('.postbox:has(.ot-metabox-wrapper):has(.dynamic-meta)'),
		
		init: function() {
			
			BwAdmin.dynamic_meta.onFormatChange();
			BwAdmin.dynamic_meta.checkFormats(jQuery('#post-formats-select .post-format:checked').attr('id'));
			
		},
		
		hideAllBoxes: function() {
			
			jQuery('.format-settings', BwAdmin.dynamic_meta.dymanicBox).hide();
			jQuery('.show_to_all', BwAdmin.dynamic_meta.dymanicBox).closest('.format-settings').show();
			
		},
		
		onFormatChange: function() {
			
			jQuery('#post-formats-select .post-format').change(function() {
				BwAdmin.dynamic_meta.checkFormats(jQuery(this).attr('id'));
			});
		},
		
		checkFormats: function(format) {
			
			BwAdmin.dynamic_meta.hideAllBoxes();
			
			if(BwAdmin.dynamic_meta.dymanicBox.length) {
				
				jQuery('.' + format, BwAdmin.dynamic_meta.dymanicBox).closest('.format-settings').show();
				
			}
			
			BwAdmin.dynamic_meta.hideMain(format);
		},
		
		hideMain: function(format) {
			
			if(jQuery('.format-settings:visible', BwAdmin.dynamic_meta.dymanicBox).length > 0 || jQuery('.' + format, BwAdmin.dynamic_meta.dymanicBox).length > 0) {
				BwAdmin.dynamic_meta.dymanicBox.show();
			}else{
				BwAdmin.dynamic_meta.dymanicBox.hide();
			}
			
		}
		
	}
	
};

// call main object on document ready
$(document).ready(function() {
	BwAdmin.init();
});