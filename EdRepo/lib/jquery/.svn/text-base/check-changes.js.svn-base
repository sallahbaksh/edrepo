// jQuery code to check if a form has unsaved changes before leaving the form page
// Credit: cfsilence <http://cfsilence.com/blog/client/index.cfm/2009/10/12/jQuery-Method-To-Prompt-A-User-To-Save-Changes-Before-Leaving-Page>


var isDirty = false;
var msg = 'You haven\'t saved your changes.';

$(document).ready(function(){    
    $(':input').change(function(){
        if(!isDirty){
            isDirty = true;
        }
    });
    
    // the following are allowed to happen without prompting
    $('form').submit(function(){isDirty = false;});
    $('#materialsList .button').click(function(){isDirty = false;});
    
    window.onbeforeunload = function(){
        if(isDirty){
            return msg;
        }
    };
    
});