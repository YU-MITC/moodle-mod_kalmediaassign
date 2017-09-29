// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Scripts for mod_kalmediaassign
 *
 * @package    mod_kalmediaassign
 * @copyright  (C) 2016-2017 Yamaguchi University (info-cc@ml.cc.yamaguchi-u.ac.jp)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

var modalX = 0;
var modalY = 0;

/**
 * callback when window loaed.
 * @param none
 * @return nithing
 */
window.onload = function() {
    var images = document.getElementsByClassName('media_thumbnail_cl');
    var n = images.length;
    for (var i = 0; i < n; i++) {
        var entry_id = images[i].getAttribute('id').substr(6);
        if (entry_id != null && entry_id != '') {
            ev(images[i], 'click', createPreviewPanel, false);
            images[i].entryId = entry_id;
        }
    }
};

/**
 * Entry a uload event callback
 * @param none
 * @return nothing
 */
window.unload = function() {
};

    /*
     * if window is resize, call modal window centerize function.
     */
    window.onresize = centeringModalSyncer;

/**
 * This function centerize modal window.
 * @param none
 * @return nothing
 */
function centeringModalSyncer(){

    // Get width and height of window.
    var w = $(window).width();
    var h = $(window).height();

    var modal_width = parseInt(document.getElementById("modalwidth").value);
    var modal_height = parseInt(document.getElementById("modalheight").value);

    modal_height = modal_height + 40;

    $("#modal_content").css({"width": modal_width + "px","height": modal_height + "px"});

    // Get width and height of content area.
    var cw = $("#modal_content").outerWidth();
    var ch = $("#modal_content").outerHeight();

    // Execute centering.
    $("#modal_content").css({"left": ((w - cw) / 2) + "px","top": ((h - ch) / 2) + "px"});
}


/**
 * This function print modal window.
 * @param none
 * @return nothing
 */
function fadeInModalWindow() {
    // All contents in web page release focus.
    $(this).blur();
    // Precent dupulicate execute of modal window.
    if ($("#modal_window")[0]) {
        return false;
    }

    var modal_width = document.getElementById("modalwidth").value;
    var modal_height = document.getElementById("modalheight").value;

    document.getElementById("modal_content").style.width = modal_width;
    document.getElementById("modal_content").style.width = modal_height;

    // Record current scroll position.
    var dElm = document.documentElement , dBody = document.body;
    modalX = dElm.scrollLeft || dBody.scrollLeft;   // Get x value of current position.
    modalY = dElm.scrollTop || dBody.scrollTop;     // Get y valueion of current position.
    // Create modal window and a content area.
    $("body").append("<div id=\"modal_window\"></div>");
    $("#modal_window").fadeIn("normal");

    // Centering content area.
    centeringModalSyncer();
    // Fade-in content area.
    $("#modal_content").fadeIn("normal");
}


/**
 * This function delete content area and modal window.
 * @param none
 * @return nothing
 */
function fadeOutModalWindow() {
    // Rescore scroll position to web brawser.
    window.scrollTo( modalX , modalY );

    // Fade-put content area and modal window.
    $("#modal_content,#modal_window").fadeOut("normal",function(){
        $("#modal_window").remove();
        document.getElementById("modal_content").innerHTML = '';
    });
}

/**
 * This function wrap add event listener.
 * @param {object} - target element object
 * @param {object} - target event object
 * @param {bool} - use of capture.
 * @return nothing.
 */
function ev(elem, event, func, useCapture){
    if (elem.addEventListener) {
        elem.addEventListener(event, func, useCapture);
    } else if(elem.attachEvent) {
        elem.attachEvent('on' + event, func);
    }
}


/**
 * This function create preview panel
 * @param {object} - Event object
 * @return nothing
 */
function createPreviewPanel(event) {
    // View modal window.
    fadeInModalWindow();

    var entry_id = event.target.entryId;
    var kaltura_host = document.getElementById("kalturahost").value;
    var partner_id = document.getElementById("partnerid").value;
    var uiconf_id = document.getElementById("uiconfid").value;
    var modal_width = document.getElementById("modalwidth").value;
    var modal_height = document.getElementById("modalheight").value;

    var element = document.getElementById("hidden_markup_" + entry_id);

    var str = '';

    str += "<center>";

    if (element != null) {
        str += element.innerHTML;
    }
    else {
        str += "Sorry! Media not found.";
    }

    str += "</center>";
    str += "<center>";
    str += "<input type=\"button\" id=\"close_button\" value=\"Close\" onClick=\"fadeOutModalWindow()\">";
    str += "</center>";

    $("#modal_content").append(str);
    }

/**
 * This function add back buttion to modal window.
 * @param {string} - url of target page.
 * @return nothing
 */
function addBackButton(url) {
    var content_html = "<input type=button id=\"backToMymedia\" name=\"backToMymedia\" ";
    content_html += "value=Back onclick=\"handleCancelClick(" + url + ")\" />";
    $("#modal_content").append(content_html);
}

/**
 * This is callback function when calcel buttion is clicked.
 * @param {string} - url of target page.
 * @return nothing
 */
function handleCancelClick(url) {
}
