/**
 *  @File           onload.js
 *  @Authors        Jose Flores
 *                  jose.flores.152@gmail.com
 *
 *  @Description    This is JavaScript/ jQuery Onload Script, it contains
 *                  the onload function
 *
 *  @changelog
 *  4/20/14         Moved constants to constant.js, functions to library.js
 *  3/20/14         Wrote onload function
 */


/**
 *  onload function
 *
 *  This is the onload function, this function executes at the end of
 *  page creation, before the user can interact with the website
 *
 *  This function is currently handling jQuery UI button and tab
 *  initialization
 */
$( function() {

    ////
    //  BUTTON SETUP
    ////

    /**
     *  enabling buttons
     *      a.button
     *      button
     */
    $( "input[type=submit], a.button, button" )
        .button()
            .click( function( event ) {
                event.preventDefault() ;
            }) ;

    ////
    //  DIALOG SETUP

    /**
     *  enabling jequery dialog
     */

    $( "#dialog" ).dialog( {
        modal : true ,
        autoOpen: false ,
        buttons : {
            Ok : function() {
                $( this ).dialog( "close" ) ;
            }
        }
    } ) ;


    ////

    ////
    //  TAB SETUP
    ///

    /**
     *  enabling tabs
     *      #tabs
     *
    tabs = $( "#tabs" ).tabs();

    // close icon: removing the tab on click
    tabs.delegate( "span.ui-icon-close", "click", function() {
        var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" ) ;

        $( "#" + panelId ).remove() ;

        tabs.tabs( "refresh" ) ;
    }) ;
    */



    $(document).click( '.toolbar-menu-title' , function() {
        $('.toolbar-menu ul li ul' ).addClass( 'display_none' ) ;
    });

    $(document).mouseover( '..toolbar-menu ul li' , function() {
        $('ul.display_none' ).removeClass( 'display_none' ) ;
    });
    var wrapper = $('<div/>').css({height:0,width:0,'overflow':'hidden'});
    var fileInput = $(':file').wrap(wrapper);
    fileInput.change(function(){
        $this = $(this);
        $('#result').text($this.val());
    })

    $('#file').click(function(){
        fileInput.click();
    }).show();

}) ;

