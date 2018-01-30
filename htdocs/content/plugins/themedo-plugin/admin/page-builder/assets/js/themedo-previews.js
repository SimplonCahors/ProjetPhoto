/*
* Previews of builder elements
*/
( function($) {

	var themedoPreview		= {};
	window.themedoPreview 	= themedoPreview;
	
	
	/**
	* Caller for respective element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updatePreview = function ( thisRef, model, subElements ) {
		if(typeof model.get('css_class') != 'undefined' && model.get('css_class').indexOf('avalon_td_layout_column') > -1) {
			return;
		}

		switch( model.get( 'php_class' ) ) { //switch case on name of element
			case 'avalon_td_AlertBox':
				themedoPreview.updateAlertPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_WpBlog':
				themedoPreview.updateBlogPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_ButtonBlock':
				themedoPreview.updateButtonPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_CheckList':
				themedoPreview.updateChecklistPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_Client':
				themedoPreview.updateClientPreview( thisRef, model, subElements );
			break;
			
			case 'avalon_td_ClientSlider':
				themedoPreview.updateClientSliderPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_ContentBoxes':
				themedoPreview.updateContentBoxesPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_CounterBox':
				themedoPreview.updateCounterBoxPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_FlipBoxes':
				themedoPreview.updateFlipBoxesPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_FontAwesome':
				themedoPreview.updateFontAwesomePreview( thisRef, model, subElements );
			break;

			case 'avalon_td_themedoSlider':
				themedoPreview.updatethemedoSliderPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_GoogleMap':
				themedoPreview.updateGoogleMapPreview( thisRef, model, subElements );
			break;
			
			case 'avalon_td_Gallery':
				themedoPreview.updateGalleryPreview( thisRef, model, subElements );
			break;
			
			case 'avalon_td_Supersized':
				themedoPreview.updateSupersizedPreview( thisRef, model, subElements );
			break;
				
			case 'avalon_td_Kenburns':
				themedoPreview.updateKenburnsPreview( thisRef, model, subElements );
			break;
			
			case 'avalon_td_FlowGallery':
				themedoPreview.updateFlowGalleryPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_ImageFrame':
				themedoPreview.updateImageFramePreview( thisRef, model, subElements );
			break;

			case 'avalon_td_ImageCarousel':
				themedoPreview.updateImageCarouselPreview( thisRef, model, subElements );
			break;
			
			case 'avalon_td_Intro':
				themedoPreview.updateIntroPreview( thisRef, model, subElements );
			break;
			
			case 'avalon_td_LightBox':
				themedoPreview.updateLightBoxPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_LayerSlider':
				themedoPreview.updateLayerSliderPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_MenuAnchor':
				themedoPreview.updateMenuAnchorPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_Modal':
				themedoPreview.updateModalPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_Person':
				themedoPreview.updatePersonPreview( thisRef, model, subElements );
			break;
			
			case 'avalon_td_WorkStep':
				themedoPreview.updateWorkStepPreview( thisRef, model, subElements );
			break;
			
			case 'avalon_td_Service':
				themedoPreview.updateServicePreview( thisRef, model, subElements );
			break;
			
			case 'avalon_td_Servicepack':
				themedoPreview.updateServicepackPreview( thisRef, model, subElements );
			break;
			
			case 'avalon_td_Comparison':
				themedoPreview.updateComparisonPreview( thisRef, model, subElements );
			break;
			
			case 'avalon_td_Hotspot':
				themedoPreview.updateHotspotPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_PostSlider':
				themedoPreview.updatePostSliderPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_PricingTable':
				themedoPreview.updatePricingTablePreview( thisRef, model, subElements );
			break;

			case 'avalon_td_ProgressBar':
				themedoPreview.updateProgressBarPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_RecentPosts':
				themedoPreview.updateRecentPostsPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_GalleryBlock':
				themedoPreview.updateGalleryBlockPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_RevolutionSlider':
				themedoPreview.updateRevSliderPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_Separator':
				themedoPreview.updateSeparatorPreview( thisRef, model, subElements );
			break;
			
			case 'avalon_td_Servicetabs':
				themedoPreview.updateServicetabsPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_SharingBox':
				themedoPreview.updateSharingBoxPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_Slider':
				themedoPreview.updateSliderPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_SoundCloud':
				themedoPreview.updateSoundCloudPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_Tabs':
				themedoPreview.updateTabsPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_Table':
				themedoPreview.updateTablePreview( thisRef, model, subElements );
			break;

			case 'avalon_td_TaglineBox':
				themedoPreview.updateTaglineBoxPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_Testimonial':
				themedoPreview.updateTestimonialPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_themedoText':
				themedoPreview.updateTextBlockPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_CustomTitle':
				themedoPreview.updateCustomTitlePreview( thisRef, model, subElements );
			break;

			case 'avalon_td_Accordion':
				themedoPreview.updateAccordionPreview( thisRef, model, subElements );
			break;
			
			case 'avalon_td_Toggle':
				themedoPreview.updateTogglePreview( thisRef, model, subElements );
			break;
			
			case 'avalon_td_Expandable':
				themedoPreview.updateExpandablePreview( thisRef, model, subElements );
			break;

			case 'avalon_td_Vimeo':
				themedoPreview.updateVimeoPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_WooShortcodes':
				themedoPreview.updateWooShortcodesPreview( thisRef, model, subElements );
			break;

			case 'avalon_td_Youtube':
				themedoPreview.updateYoutubePreview( thisRef, model, subElements );
			break;

			default:
				$(thisRef.el).find('.innerElement').html( model.get('innerHtml') );
		}
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateAlertPreview = function( thisRef, model, subElements ) {

		var innerHtml 	=  model.get('innerHtml');
		var icon		= '';
		//for icon
		switch(subElements[0].value ) {
			case 'general':
				icon = 'fa fa-lg fa-info-circle';
			break;
			case 'error':
				icon = 'fa fa-lg fa-exclamation-triangle';
			break;
			case 'success':
				icon = 'fa fa-lg fa-check-circle';
			break;
			case 'notice':
				icon = 'fa fa-lg fa-lg fa-cog';
			break;
			case 'custom':
				icon = 'fa '+subElements[4].value;
			break;
		}
		innerHtml 		= innerHtml.replace( $(innerHtml).find('sub.sub').html() , subElements[6].value );
		innerHtml 		= innerHtml.replace( $(innerHtml).find('i').attr('class') , icon );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateBlogPreview = function( thisRef, model, subElements ) {

		var innerHtml 	=  model.get('innerHtml');
		innerHtml 		= innerHtml.replace( $(innerHtml).find('span.blog_layout').html() , subElements[0].value );
		if(subElements[0].value == 'grid') {
			innerHtml 		= innerHtml.replace( $(innerHtml).find('font.blog_columns').html() , '<br /> columns = ' + subElements[19].value );
		} else {
			innerHtml 		= innerHtml.replace( $(innerHtml).find('font.blog_columns').html(), '' );
		}

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateButtonPreview = function( thisRef, model, subElements ) {

		var innerHtml 	=  model.get('innerHtml');
		var buttonStyle	= '';
		//for button color
		switch( subElements[1].value ) {
			case 'custom':
				var topC = ( subElements[8].value == 'transparent' ) ? '#ebeaea' : subElements[8].value;
				var botC = subElements[9].value;
				var acnC = subElements[12].value;
				buttonStyle = "background: "+topC+";background: -moz-linear-gradient(top,  "+topC+" 0%, "+botC+" 100%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,"+topC+"), color-stop(100%,"+botC+"));background: -webkit-linear-gradient(top,  "+topC+" 0%,"+botC+" 100%);background: -o-linear-gradient(top,  "+topC+" 0%,"+botC+" 100%);background: -ms-linear-gradient(top,  "+topC+" 0%,"+botC+" 100%);background: linear-gradient(to bottom,  "+topC+" 0%,"+botC+" 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='"+topC+"', endColorstr='"+botC+"',GradientType=0 );border: 1px solid #fff;color: #fff;border: 1px solid "+acnC+";color: "+acnC+";";
				innerHtml 		= innerHtml.replace( $(innerHtml).find('a.button').attr('style') , buttonStyle );
				innerHtml 		= innerHtml.replace( $(innerHtml).find('a.button').attr('class') , 'button custom' );
			break;

			default:
				buttonStyle		= "button "+subElements[1].value;
				innerHtml 		= innerHtml.replace( $(innerHtml).find('a.button').attr('class') , buttonStyle );
			break;
		}
		innerHtml 		= innerHtml.replace( $(innerHtml).find('span.themedo-button-text').html() , subElements[7].value );


		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateChecklistPreview = function( thisRef, model, subElements ) {

		var innerHtml 		=  model.get('innerHtml');
		var totalElements 	= subElements[7].elements.length;
		var previewData		= '';
		var counter			= 0;
		for ( i = 0; i <  totalElements; i ++) {
			element		= subElements[7].elements[i];
			value		= '';
			//fot HTML
			if( /<[a-z][\s\S]*>/i.test( element[1].value ) ) {
				value = $(element[1].value).text();
			}else {
				value = element[1].value;
			}

			if( element[1].value != '' ) {
				previewData+= '<li><i ';
				if( element[0].value != '' ) {
					previewData+= 'class="fa '+element[0].value+'"></i>';
				} else {
					previewData+= 'class="fa '+subElements[0].value+'"></i>';
				}
				previewData+=  value;
				previewData+= '</li>';
				counter++;
			}
			if( counter == 3 ) { break; }
		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.checklist_elements').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateClientPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[8].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[8].elements[i];
			previewData+= '<li>';
			previewData+= ' <img src="'+element[1].value+'">';
			previewData+= '</li>';

			if( i == 3 ) break;
		}

		innerHtml = innerHtml.replace( $(innerHtml).find('ul.client_content').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateClientSliderPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[3].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[3].elements[i];
			previewData+= '<li>';
			previewData+= ' <img src="'+element[2].value+'">';
			previewData+= '</li>';

			if( i == 4 ) break;
		}

		innerHtml = innerHtml.replace( $(innerHtml).find('ul.client_slider_elements').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateContentBoxesPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.content_boxes_layout').html() , subElements[1].value );
		innerHtml			= innerHtml.replace( $(innerHtml).find('font.content_boxes_columns').html() , subElements[2].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateCounterBoxPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('font.counter_box_columns').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateFlipBoxesPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('font.flip_boxes_columns').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateFontAwesomePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var previewData		= '';
		var iconElement		= '';
		//for icon
		if( !subElements[0].value.trim() ) {
			iconElement = '<i class="themedoa-flag" style="color:'+subElements[3].value+'"></i>';
		} else {
			iconElement = '<i class="fa '+subElements[0].value+'" style="color:'+subElements[3].value+'"></i>';
		}
		//for circle
		if( subElements[1].value == 'yes' ) {
			previewData = '<h3 style="background:'+subElements[4].value+'">'+iconElement+'</h3>';
		} else {
			previewData = iconElement;
		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.avalon_td_iconbox_icon').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updatethemedoSliderPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.avalon_td_slider_name').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateGoogleMapPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.google_map_address').html() , subElements[16].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateImageFramePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('div.img_frame_section').html() , '<img src="'+subElements[9].value+'">' );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateImageCarouselPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[12].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[12].elements[i];
			previewData+= '<li>';
			previewData+= ' <img src="'+element[2].value+'">';
			previewData+= '</li>';

			if( i == 4 ) break;

		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.image_carousel_elements').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateGalleryPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[6].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[6].elements[i];

			//if name exists
			if ( element[0].value != '' ) {
				previewData+= '<li>';
				previewData+= ' <img src="'+element[0].value+'">';
				previewData+= '</li>';
	
				
			}
			
			if( i == 3 ) break;
			
			//if company exists
			/*if( element[0].value != '' ) {
				previewData+= ', '+element[0].value+'<br>';
			} else {
				previewData+= ', <br>';
			}*/
		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.gallery_content').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateSupersizedPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[6].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[6].elements[i];

			//if name exists
			if ( element[0].value !== '' ) {
				previewData+= '<li>';
				previewData+= ' <img src="'+element[0].value+'">';
				previewData+= '</li>';
	
				
			}
			
			if( i === 3 ) {break;}
			
			//if company exists
			/*if( element[0].value != '' ) {
				previewData+= ', '+element[0].value+'<br>';
			} else {
				previewData+= ', <br>';
			}*/
		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.gallery_content').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	};
	
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateKenburnsPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[6].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[6].elements[i];

			//if name exists
			if ( element[0].value !== '' ) {
				previewData+= '<li>';
				previewData+= ' <img src="'+element[0].value+'">';
				previewData+= '</li>';
	
				
			}
			
			if( i === 3 ) {break;}
			
			//if company exists
			/*if( element[0].value != '' ) {
				previewData+= ', '+element[0].value+'<br>';
			} else {
				previewData+= ', <br>';
			}*/
		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.gallery_content').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	};
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateFlowGalleryPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[6].elements.length;
		var previewData		= '';
		
		if(totalElements !== '' || totalElements !== 'undefined' || totalElements !== null){
			for ( i = 0; i < totalElements; i ++) {
				element 	= subElements[6].elements[i];
	
				//if name exists
				if ( element[0].value !== '' ) {
					previewData+= '<li>';
					previewData+= ' <img src="'+element[0].value+'">';
					previewData+= '</li>';
				}
				if( i === 3 ) {break;}
			}
		}
		
		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.gallery_content').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	};
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateLayerSliderPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.layer_slider_id').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateMenuAnchorPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.anchor_name').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateModalPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.modal_name').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updatePersonPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('div.img_frame_section').html() , '<img src="'+subElements[2].value+'">' );
		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.person_name').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	
	
	themedoPreview.updateComparisonPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('div.img_frame_section').html() , '<img src="'+subElements[0].value+'"> <img src="'+subElements[1].value+'">' );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	
	
	
	
	themedoPreview.updateHotspotPreview = function( thisRef, model, subElements ) {
		
		
		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[5].elements.length;
		var previewData		= '';
		var counter			= 0;
		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[5].elements[i];
			if( element[6].value != '' ) {
				previewData+= '<li> - '+element[6].value+'</li>';
				counter++;
			}

			if( counter == 3 ) break;

		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.list_elements').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	
	// SERVICE
	themedoPreview.updateWorkStepPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.workstep_name').html() , subElements[1].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	
	
	
	// SERVICE
	themedoPreview.updateServicePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('div.img_frame_section').html() , '<img src="'+subElements[0].value+'">' );
		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.service_name').html() , subElements[1].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	
	
	// SERVICE PACK
	themedoPreview.updateServicepackPreview = function( thisRef, model, subElements ) {
		
		
		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[9].elements.length;
		var previewData		= '';
		var counter			= 0;
		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[9].elements[i];
			if( element[0].value != '' ) {
				previewData+= '<li> - '+element[0].value+'</li>';
				counter++;
			}

			if( counter == 3 ) break;

		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.list_elements').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updatePostSliderPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		//for attachment layout
		if( subElements[0].value == 'attachments' ) {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('span.cat_container').attr('style') , 'display:none' );
		} else {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('span.cat_container').attr('style') , 'display:' );
		}
		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.post_slider_layout').html() , subElements[0].value );

		var cat				= ( !subElements[2].value.trim() ) ? 'all' : subElements[2].value;
		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.post_slider_cat').html() , cat );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updatePricingTablePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var columns			= subElements[4].value.match(/pricing_column/g);

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.pricing_table_style').html() , subElements[0].value );
		innerHtml 			= innerHtml.replace( $(innerHtml).find('font.pricing_table_columns').html() , columns.length / 2 );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateProgressBarPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.progress_bar_text').html() , subElements[9].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateRecentPostsPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('.recent_posts span').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateGalleryBlockPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');


		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.gallery_block_layout').html() , subElements[0].value );

		var cats 			= themedoParser.getUniqueElements(subElements[1].value).join();
		cats 				= ( cats == '' ? 'All' : cats);
		innerHtml 			= innerHtml.replace( $(innerHtml).find('font.gallery_block_cats').html() , cats );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateRevSliderPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.rev_slider_name').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateSeparatorPreview = function( thisRef, model, subElements ) {

		var innerHtml 			= model.get('innerHtml');
		var sep_css, icon_css	= '';
		subElements[0].value 	= ( !subElements[0].value.trim() ) ? 'none' : subElements[0].value;
		innerHtml 				= innerHtml.replace( $(innerHtml).find('section').attr('class') , 'separator ' + subElements[0].value.replace("|", "_") );

		switch( subElements[0].value ) {

			case 'none':
				//do nothing
			break;

			case 'double':
				  sep_css	= 'border-bottom: 1px solid '+subElements[3].value+';border-top: 1px solid '+subElements[3].value+';';
			break;

			case 'double|dashed':
				sep_css		= 'border-bottom: 1px dashed '+subElements[3].value+';border-top: 1px dashed '+subElements[3].value+';';
			break;

			case 'double|dotted':
				sep_css		= 'border-bottom: 1px dotted '+subElements[3].value+';border-top: 1px dotted '+subElements[3].value+';';
			break;

			case 'shadow':
				sep_css		= 'background:radial-gradient(ellipse at 50% -50% , '+subElements[3].value+' 0px, rgba(255, 255, 255, 0) 80%) repeat scroll 0 0 rgba(0, 0, 0, 0)';
			break;

			default:
				sep_css		= 'background:'+subElements[3].value+';';
			break;

		}

		// width
		if( subElements[8].value != '' ) {
			sep_css += 'width:'+subElements[7].value+';';

			// alignment
			if( subElements[9].value == 'left' ) {
				sep_css += 'margin-left:5%;margin-right:0;';
			} else if ( subElements[9].value == 'right' ) {
				sep_css += 'float:right;margin-right:5%;';
			}
		}

		if( subElements[3].value != '' || subElements[8].value != '' ) {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('section').attr('style') , sep_css );
		}

		//for icon
		if( subElements[0].value != 'none' && subElements[0].value != '' && subElements[5].value != '' ) {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('i:eq(1)').attr('class') , "icon fa "+subElements[5].value);
		} else {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('i:eq(1)').attr('class') , "fake_class");
		}
		//color for circle border
		if ( subElements[6].value != 'no' ) {
			icon_css 			= "color:"+subElements[3].value+";border-color:"+subElements[3].value+';';
		} else {
			icon_css 			= "color:"+subElements[3].value+";border-color:transparent;";
		}

		//color for circle bg
		if ( subElements[7].value != '' ) {
			icon_css 			+= "background-color:"+subElements[7].value;
		}

		innerHtml 				= innerHtml.replace( $(innerHtml).find('i:eq(1)').attr('style') , icon_css );

		//for upper content
		if( subElements[0].value != 'none' ) {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('span.upper_container').attr('style') , 'display:none' );
		} else {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('span.upper_container').attr('style') , '' );
		}
		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateSharingBoxPreview  = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.sharing_tagline').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateSliderPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[5].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[5].elements[i];

			previewData+= '<li>';
			if( element[0].value == 'video' ) {
				previewData+= '<h1 class="video_type">Video</h1>';
			} else if ( element[0].value == 'image' ) {
				previewData+= ' <img src="'+element[1].value+'">';
			}
			previewData+= '</li>';

			if( i == 4 ) break;

		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.slider_elements').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateSoundCloudPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.soundcloud_url').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateTabsPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[6].elements.length;
		var previewData		= '';
		var counter			= 0;
		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[6].elements[i];
			if( element[0].value != '' ) {
				previewData+= '<li>'+element[0].value+'</li>';
				counter++;
			}

			if( counter == 3 ) break;

		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.tabs_elements').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateTablePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.table_style').html() , subElements[0].value );
		innerHtml 			= innerHtml.replace( $(innerHtml).find('font.table_columns').html() , subElements[1].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateTaglineBoxPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.tagline_title').html() , subElements[15].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateTestimonialPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[4].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[4].elements[i];

			//if name exists
			if ( element[0].value != '' ) {
				previewData+= '- ' + element[0].value + ',<br /> ';
			}
			//if company exists
			/*if( element[0].value != '' ) {
				previewData+= ', '+element[0].value+'<br>';
			} else {
				previewData+= ', <br>';
			}*/
		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.testimonial_content').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateServicetabsPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[4].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[4].elements[i];

			//if name exists
			if ( element[0].value != '' ) {
				previewData+= '- ' + element[0].value + '<br /> ';
			}
			//if company exists
			/*if( element[0].value != '' ) {
				previewData+= ', '+element[0].value+'<br>';
			} else {
				previewData+= ', <br>';
			}*/
		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.servicetabs_content').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	
	
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateTextBlockPreview = function( thisRef, model, subElements ) {

		var text_block 		= $.parseHTML( subElements[0].value );
		var text_block_html = '';
		var insert_icon = '';

		$(text_block).each(function() {
			if($(this).get(0).tagName != 'IMG' && typeof $(this).get(0).tagName != 'undefined') {
				var childrens = $($(this).get(0)).find('*');
				var child_img = false;
				if(childrens.length >= 1) {
					$.each(childrens, function() {
						if($(this).get(0).tagName == 'IMG') {
							child_img = true;
						}
					});
				}
				if(child_img == true) {
					text_block_html += $(this).outerHTML();
				} else {
					text_block_html += $(this).text();
				}
			} else {
				text_block_html += $(this).outerHTML();
			}
		});

		if(text_block_html.indexOf('[/pricing_table]') > -1) {
			insert_icon = '<span class="text-block-icon"><i class="themedoa-icon themedoa-dollar"></i>Pricing Table</span>';
		}

		if(subElements[0].value.indexOf('<div class="table-1">') > -1 || subElements[0].value.indexOf('<div class="table-2">') > -1) {
			insert_icon = '<span class="text-block-icon"><i class="themedoa-icon themedoa-table"></i>Table</span>';
		}

		if(
			typeof wp.shortcode.next('woocommerce_order_tracking', text_block_html) == 'object' ||
			typeof wp.shortcode.next('add_to_cart', text_block_html) == 'object' ||
			typeof wp.shortcode.next('product', text_block_html) == 'object' ||
			typeof wp.shortcode.next('products', text_block_html) == 'object' ||
			typeof wp.shortcode.next('product_categories', text_block_html) == 'object' ||
			typeof wp.shortcode.next('product_category', text_block_html) == 'object' ||
			typeof wp.shortcode.next('recent_products', text_block_html) == 'object' ||
			typeof wp.shortcode.next('featured_products', text_block_html) == 'object' ||
			typeof wp.shortcode.next('woocommerce_shop_messages', text_block_html) == 'object'
			) {
			insert_icon = '<span class="text-block-icon"><i class="themedoa-icon themedoa-shopping-cart"></i>Woo Shortcodes</span>';
		}

		innerHtml   = $( '<div class="fake-wrapper">' + model.get('innerHtml') + '</div>' ).find( 'span' ).append( insert_icon + '<small>'+text_block_html+'</small>' ).parents('.fake-wrapper').html();

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateCustomTitlePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var value			= '';
		//HTML check
		if( /<[a-z][\s\S]*>/i.test( subElements[0].value ) ) {
			value = $(subElements[0].value).text();
		}else {
			value = subElements[0].value;
		}
		//for text
		if( value != '' ) {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('sub.title_text').html() , value );
		}
		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateIntroPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var value			= '';
		
		value = subElements[0].value;
		
		innerHtml 			= innerHtml.replace( $(innerHtml).find('.intro_text').html() , value );
		
		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateAccordionPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[5].elements.length;
		var previewData		= '';
		var counter			= 0;

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[5].elements[i];
			if( element[0].value != '' ) {
				previewData+= '<li>'+element[0].value+'</li>';
				counter++;
			}

			if( counter == 3 ) break;

		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.toggles_content').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}

	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateTogglePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[5].elements.length;
		var previewData		= '';
		var counter			= 0;

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[5].elements[i];
			if( element[0].value != '' ) {
				previewData+= '<li>'+element[0].value+'</li>';
				counter++;
			}

			if( counter == 3 ) break;

		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.toggles_content').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateExpandablePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('.expandable_section').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}

	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateVimeoPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.viemo_url').html() , "https://vimeo.com/"+subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateWooShortcodesPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.woo_shortcode').html() , subElements[1].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	themedoPreview.updateYoutubePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.youtube_url').html() , "http://www.youtube.com/"+subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
  })(jQuery);

