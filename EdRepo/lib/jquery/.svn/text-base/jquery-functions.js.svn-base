/*
    File: jquery-functions.js
    Purpose: JavaScript functions (using jQuery library) to increase interactivity of EdRepo.
    Author: Jon Thompson
    Created: 4/14/2011
*/

$(document).ready(function() {

    // Remove login/my account link if JavaScript is enabled and drop-down will work
    $("#account-btn").attr('href', '#');

    //////////////////////////////////////////////////////////////////////////////////////////////////
    //     The following code is adapted for EdRepo's login drop-down from Lam Nguyen's 'Twitter jQuery Login'
    //            <http://aext.net/2009/08/perfect-sign-in-dropdown-box-likes-twitter-with-jquery/>
                
    $("#account-btn").click(function(e) {
        e.preventDefault();
        $("#account").toggle();
        //$("#account-btn").toggleClass("menu-open");
    });

    $("#account").mouseup(function() {
        return false
    });
    $(document).mouseup(function(e) {
        if($(e.target).parent("a#account-btn").length==0) {
            //$("#account-btn").removeClass("menu-open");
            $("#account").hide();
        }
    });
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    
    // make side panel "collapsible" by clicking the border (which is really an a)
    $('a#collapse').click(function() {
      $('div#panel').toggle();
    });
    
    
    // expand/collapse all link for hierarchy tree
    var open = false;
    $('#ecAll').click(function() {
      if (open) {
        $("#hierarchy").jstree("close_all", -1);
        open = false;
      } else {
        $("#hierarchy").jstree("open_all", -1);
        open = true;
      }
    });
    $('#hierarch ins').click(function() {
      if (!open) {
        open = true;
      }
    });

});
