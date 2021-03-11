/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/style.scss';

import $ from 'jquery';
import 'mdi-component';

$("button").click(function (){
    let dest = $(this).data('href');
    if (dest){
        window.location.href = dest;
    }
});
$("#flash .close").click(function (){
    console.log(this);
    $(this).parent().hide(500,function (){
        $(this).remove();
    });
});