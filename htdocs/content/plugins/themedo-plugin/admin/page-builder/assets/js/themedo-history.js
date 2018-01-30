/*
* adds undo and redo functionality to the themedo Page Builder
*/
( function($) { 
	var themedoHistoryManager 		= {};
	window.themedoHistoryManager 	= themedoHistoryManager;
	var themedoCommands 				= new Array('[]');
	//is tracking on or off?
	window.tracking					= 'on'
	//maximum steps allowed/saved
	var maxSteps					= 40;
	//current Index of step
	var currStep					= 0;
	
	/**
	 * get editor data and add to array
	 * @param 	NULL
	 * @return 	NULL
	 */
	themedoHistoryManager.captureEditor = function( ) {
		
		//if tracking is on
		if( themedoHistoryManager.isTrackingOn() ) {
			//get elements
			allElements = themedoHistoryManager.getAllElementsData();
			
			if ( currStep ==  maxSteps) { //if reached limit
				themedoCommands.shift(); //remove first index
			} else {
				currStep += 1; //else increment index
			}
			
			//add editor data to Array
			themedoCommands[currStep] = allElements;
			//update buttons
			themedoHistoryManager.updateButtons();
		}
	}
	/**
	 * get models of all elements visible in editor
	 * @param 	NULL
	 * @return 	{String}	JSON String of editor elements
	 */
	themedoHistoryManager.getAllElementsData = function() {
		
		var editorElements 		= document.querySelectorAll('#editor .item-wrapper');	
		var allElements 		= new Array();
		var uniqueEls			= new Array();


		for ( var i=0; i < editorElements.length; i++ )
		{
			var elementId 		= editorElements[i].id;
			
			if( elementId ) //if element exists
			{
				//get element model
				var element 		= app.editor.selectedElements.get(elementId);
				// get element order
				var elementIndex 	= i;
				//set element order
				element.attributes.index = elementIndex;
				//add element to stack
				allElements.push( element );
				
			}
		}
		//remove duplicates
		$.each( allElements, function( i, el ){
			if( $.inArray( el, uniqueEls ) === -1) uniqueEls.push( el );
		});
		//return JSON String of elements
		return JSON.stringify(uniqueEls);
	}
	/**
	 * set tracking flag ON.
	 * @param 	NULL
	 * @return 	NULL
	 */
	themedoHistoryManager.turnOnTracking = function( ) {
		window.tracking = 'on';
	}
	/**
	 * set tracking flag OFF.
	 * @param 	NULL
	 * @return 	NULL
	 */
	themedoHistoryManager.turnOffTracking = function( ) {
		window.tracking = 'off';
	}
	/**
	 * Get editor elements of current index for UNDO. Remove all elements currenlty visible in eidor and then reset models
	 * @param 	NULL
	 * @return 	NULL
	 */
	themedoHistoryManager.doUndo = function( ){
		
		if ( themedoHistoryManager.hasUndo() ) { //if no data or end of stack and nothing to undo
			//turn off tracking first, so these actions are not captured
			themedoHistoryManager.turnOffTracking();
			currStep 		-= 1;
			
			//data to undo
			var undoData 	= themedoCommands[currStep];
			if( undoData != '[]' ) { //if not empty state
				//remove all current editor elements first
				Editor.deleteAllElements();
				//reset models with new elements
				app.editor.selectedElements.reset( JSON.parse(undoData) );
				//turn on tracking
				themedoHistoryManager.turnOnTracking();
				//update buttons
				themedoHistoryManager.updateButtons();
			}
		}
		
	}
	/**
	 * Get editor elements of current index for REDO. Remove all elements currenlty visible in eidor and then reset models
	 * @param 	NULL
	 * @return 	NULL
	 */
	themedoHistoryManager.doRedo = function( ) {
		
		if ( themedoHistoryManager.hasRedo() ) { //if not at end and nothing to redo
			//turn off tracking, so these actions are not tracked
			themedoHistoryManager.turnOffTracking();
			//move index
			currStep	+= 1;;
			//get data to redo
			var RedoData = themedoCommands[currStep];
			//remove currently visible elements in editor
			Editor.deleteAllElements();
			//reset models with new elements
			app.editor.selectedElements.reset( JSON.parse(RedoData) );
			//turn on tracking, so future actions are tracked
			themedoHistoryManager.turnOnTracking();
			//update buttons
			themedoHistoryManager.updateButtons();
		}
		
	}
	/**
	 * check whether tracking is on or off
	 * @param 	NULL
	 * @return 	NULL
	 */
	themedoHistoryManager.isTrackingOn = function( ) {
		if ( window.tracking == 'on' ) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * log current data
	 * @param 	NULL
	 * @return 	NULL
	 */
	themedoHistoryManager.logStacks = function() {
		console.log( JSON.parse(themedoCommands) );
	}
	/**
	 * clear all commands and reset manager
	 * @param 	NULL
	 * @return 	NULL
	 */
	themedoHistoryManager.clear = function() {
		themedoCommands 	= new Array('[]');
		currStep 		= -1;
	}
	/**
	 * check if undo commands exist
	 * @param 	NULL
	 * @return 	NULL
	 */
	themedoHistoryManager.hasUndo = function () {
		return currStep !== 1;
	}
	/**
	 * check if redo commands exist
	 * @param 	NULL
	 * @return 	NULL
	 */
	themedoHistoryManager.hasRedo = function () {
		return currStep < ( themedoCommands.length - 1 );
	}
	/**
	 * get existing commands
	 * @param 	NULL
	 * @return 	{string}	actions
	 */
	themedoHistoryManager.getCommands = function () {
		return themedoCommands;
	}
	/**
	 * update buttons colors accordingly
	 * @param 	NULL
	 * @return 	NULL
	 */
	themedoHistoryManager.updateButtons = function () {
		//for undo button
		$( '#both_icon .themedoa-reply' ).css( 'color',themedoHistoryManager.hasUndo() ? "#008EC5" : "" );
		//for redo button
		$( '#both_icon .themedoa-forward' ).css( 'color', themedoHistoryManager.hasRedo() ? "#008EC5" : "" );
		
	}
	 
  })(jQuery);

