/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
// import './bootstrap';
const $ = require('jquery');
global.$ = global.jQuery = $;

require('bootstrap');


$(function(){
    $("[type='file']").on("change", function(){
        var formulaire = $(this).closest("form")[0];
        var identifiant = $(this).prop("id") ? $(this).prop("id") : $(this).prop("name");
        var fichier = formulaire[identifiant].files[0];
        var fileName = fichier.name;
        $(this).next('.custom-file-label').html(fileName);
        
    });
});