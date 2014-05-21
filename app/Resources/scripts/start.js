var toast_timer;
var scrolled = $(document).scrollTop();
var browser = check_browser();
var transition_time = 200;
var username_max_size = 19;
var username_min_size = 2;
var password_max_size = 30;
var password_min_size = 5;
var transition_time = 200;
var scroll_animation_time = 600;
var toast_show_time = 3000;
var minimum_recipe_size = 90;
var recipe_size = minimum_recipe_size;
var mobile_state = false;
var mobile_width_size = 400;
var steps_amount = 2;
var current_step = 0;
var filter_level = 0;
var recipe_box_margin_size = 10;
var content_right_margin = 30;
var scrollbar_width = 5;
var scroll_content;
var scroll_filters;
var scroll_sidebar_right;
var scroll_sidebar_left;
var scroll_map_buttons;
var scroll_steps_others_like_box;
var scroll_step_comment_answers_box;
var clickable = true;
var user_login_status = false;

document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);

function toast(text, status, type){
    clearTimeout(toast_timer);
    $("#toast_inside").html(text);

    $("#toast_inside").removeClass().addClass('toast_inside_' + type);
    if(status == "good")
        $("#toast_wrapper").css('background-color','rgba(43, 190, 43, 0.95)');
    else if(status == "bad")
        $("#toast_wrapper").css('background-color','rgba(175, 25, 25, 0.95)');

    $("#toast_wrapper").fadeIn(transition_time, function(){
        var width = 550;
        if(mobile_state){
            width = parseInt(($("#content_wrapper").css('width')).replace("px", "")) - content_right_margin - 2;
        }
        $("#toast_wrapper").animate({width: width}, transition_time);
    });

    toast_timer = setTimeout(function(){
        $("#toast_wrapper").animate({width: 50}, transition_time, function(){
            $("#toast_wrapper").fadeOut(transition_time);
        });
    },toast_show_time);
}

function profile_recipes(type){
    $(".profile_line_box").removeClass().addClass('profile_line_box');
    $("#profile_line_box_" + type).addClass('profile_line_box_' + type + '_active');
    recipe_size = calculate_recipe_size();

    var formData = new FormData();
    formData.append('type',type);
    $.ajax({
        type: 'POST',
        url: '/ajax/profile_recipes',
        data: formData,
        dataType: 'json',
        beforeSend: function () {
        },
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status == "good") {
                var recipes = data.recipes;

                $('#profile_recipes').fadeOut(transition_time,function(){
                    $('#profile_recipes').html('');

                    if(type == "created"){
                        var appendable_data = "<div class='recipe_box' style=\"background-color:white;background-size:70% 70%;background-image: url('/images/new_recipe.png');width:" + recipe_size + "px;height:" + recipe_size +  "px;\" onclick='go_to_new_recipe()'><div class='recipe_box_info'>Sukurti naują receptą</div></div>";
                        $("#profile_recipes").append(appendable_data);
                    }

                    for(i = 0; i < recipes.length; i++){
                        var data = recipes[i];
                        var id = data[0];
                        var image = data[1];
                        var title = data[2];
                        var appendable_data = "<div class='recipe_box' id='recipe_" + id + "' style=\"background-image: url('" + image + "');width:" + recipe_size + "px;height:" + recipe_size +  "px;\" onclick=\"show_recipe('" + id + "')\"><div class='recipe_box_info'>" + title + "</div></div>";
                        $("#profile_recipes").append(appendable_data);
                    }

                    $('#profile_recipes').fadeIn(transition_time);
                    setTimeout(function(){scroll_content.refresh();},0);
                });

            }
        }
    });
}

function load_recipes(reset, callback){
    callback = callback || function(){};
    var formData = new FormData();
    formData.append('reset', reset);
    $.ajax({
        type: 'POST',
        url: '/ajax/load_recipes',
        data: formData,
        dataType: 'json',
        beforeSend: function () {
        },
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status == "good") {
                if(reset == "true"){
                    $("#scroller_content").html('');
                    load_more_end = false;
                    setTimeout(function(){scroll_content.scrollTo(0, 0)},0);
                }
                var recipes = data.recipes;
                for(i = 0; i < recipes.length; i++){
                    append_recipe(recipes[i]);
                }
                setTimeout(function(){scroll_content.refresh()},0);
                callback();
            }
        }
    });
}


function loading(id, display) {
    if(display == "show"){
        $("#" + id).append("<div class='loader'></div>");
        $("#" + id + " .loader").fadeIn(transition_time * 2);
    }else if (display == "hide") {
        $("#" + id + " .loader").fadeOut(transition_time * 2, function(){
            $("#" + id + " .loader").remove();
        });
    }
}

function loading_icons(id, display){
    if(display == "show"){
        $("#" + id).append("<div class='loader'></div>");
        $("#" + id + " .loader").fadeIn(transition_time * 2);
    }else if (display == "hide") {
        $("#" + id + " .loader").fadeOut(transition_time * 2, function(){
            $("#" + id + " .loader").remove();
        });
    }
}

function append_recipe(data){
    var id = data[0];
    var image = data[1];
    var title = data[2];

    var appendable_data = "<div class='recipe_box' id='recipe_" + id + "' style=\"background-image: url('" + image + "');width:" + recipe_size + "px;height:" + recipe_size +  "px;\" onclick=\"show_recipe('" + id + "')\"><div class='recipe_box_info'>" + title + "</div></div>";
    $("#scroller_content").append(appendable_data);
}

function load_products(reset){
    if(reset == "true"){
        $("#scroller_content").html('');
        setTimeout(function(){scroll_content.refresh()},0);
        setTimeout(function(){scroll_content.scrollTo(0, 0)},0);
    }


    var formData = new FormData();
    formData.append('load_products','true');
    $.ajax({
        type: 'POST',
        url: '/ajax/load_products',
        data: formData,
        dataType: 'json',
        beforeSend: function () {
        },
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status == "good") {
                var products = data.products;
                for(i = 0; i < products.length; i++){
                    append_product(products[i]);
                }
                setTimeout(function(){scroll_content.refresh()},0);
            }
        }
    });
}



function append_product(data){
    var id = data[0];
    var image = data[1];
    var title = data[2];
    var appendable_data = "<div class='recipe_box' id='product_" + id + "' style=\"background-image: url('" + image + "');width:" + recipe_size + "px;height:" + recipe_size +  "px;\"><div class='recipe_box_info'>" + title + "</div><div class='recipe_box_button' id='recipe_box_button_add_to_shoppinglist' onclick=\"add_product('" + id + "')\"></div></div>";

    $("#scroller_content").append(appendable_data);
}

function add_product(ID){
    var formData = new FormData();
    formData.append('product_id',ID);
    $.ajax({
        type: 'POST',
        url: '/ajax/shoppinglist_product_add',
        data: formData,
        dataType: 'json',
        beforeSend: function () {
        },
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status == "good") {
                $('#product_' + ID).fadeOut(transition_time);
                setTimeout(function(){scroll_content.refresh();}, transition_time);
            }
        }
    });
}

function load_shoppinglist(){
    var formData = new FormData();
    formData.append('load_shoppinglist','true');
    $.ajax({
        type: 'POST',
        url: '/ajax/load_shoppinglist',
        data: formData,
        dataType: 'json',
        beforeSend: function () {
        },
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status == "good") {

            }
        }
    });
}

function show_loading_recipe(){
    var loading_more_box = "<div class='recipe_box' id='loading_more_box' style=\"width:" + recipe_size + "px;height:" + recipe_size +  "px;\"></div>";
    $("#scroller_content").append(loading_more_box);
    setTimeout(function(){scroll_content.refresh();},0);
}

function hide_loading_recipe(){
    $('#loading_more_box').remove();
}

function refresh(){
    location.href = location.href;
}


function input_click(type){
    $('#input_' + type).trigger('click');
}

function IsNumeric(input){
    return (input - 0) == input && (input + '').replace(/^\s+|\s+$/g, "").length > 0;
}

function check_browser(){
    var isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
    var isFirefox = typeof InstallTrigger !== 'undefined';
    var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
    var isChrome = !!window.chrome && !isOpera;
    var isIE = /*@cc_on!@*/false || !!document.documentMode;
    var agent = 'undefined';
    if(isOpera){
        agent = 'opera';
    }
    if(isFirefox){
        agent = 'firefox';
    }
    if(isSafari){
        agent = 'safari';
    }
    if(isChrome){
        agent = 'chrome';
    }
    if(isIE){
        agent = 'ie';
    }

    return agent;
}



function check(type, amount){
    switch(type){
        case "email":
            var etaposition = amount.indexOf("@");
            var dotposition = amount.lastIndexOf(".")
            var lastEtaPosition = amount.lastIndexOf("@");
            var etaCount = amount.replace(/[^@]/gi, "").length;
            if (etaposition < 1 || dotposition <= etaposition + 2 || dotposition + 2 >= amount.length || etaCount != 1 ){
                return false;
            }else{
                return true;
            }
            break;

        case "password":
            var password_length = amount.length;
            if (password_length > password_max_size || password_length < password_min_size){
                return false;
            }else{
                return true;
            }
            break;

        case "username":
            var username_length = amount.length;
            if (username_length > username_max_size || username_length < username_min_size){
                return false;
            }else{
                return true;
            }
            break;
        case "not_empty":
            amount = amount.trim();
            if(amount == ""){
                return false;
            }else{
                return true;
            }
            break;
    }
}
var current_filters_scroll;
function show_filters(array_of_filters, index){
    $("#scroller_filters").append('<div style="display:block;margin-left:210px;" id="container_appender">' + array_of_filters[index] + '</div>');
    $("#container_appender").animate({marginLeft: 0}, transition_time);
    $("#container_appender").fadeIn(transition_time);
    $("#container_appender").attr('id','container_appender_out');
    index++;
    if(index <= array_of_filters.length - 1){
        setTimeout(function(){
            show_filters(array_of_filters, index);
        },transition_time / 100);
    }else{
        setTimeout(function(){
            current_filters_scroll = scroll_filters.y;
            scroll_filters.refresh();
            scroll_filters.scrollTo(0, 0);
        },0)
    }
}

function filters_show(type, category, callback){
    callback = callback || function(){};
    full_sidebar();

    var formData = new FormData();
    formData.append('type', type);
    formData.append('category', category);
    $.ajax({
        type: 'POST',
        url: '/ajax/filters_show',
        data: formData,
        dataType: 'json',
        beforeSend: function () {
        },
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status == "good") {
                if (type == 'selected' || type == 'selected_personal'){
                    filter_level = 0;
                    show_config_zone(0);
                }else if(type == 'categories'){
                    filter_level = 1;
                    show_config_zone(1);
                }else if(type == 'inside_category'){
                    filter_level = 2;
                }else if(type == 'ingredients'){
                    filter_level = 3;
                }

                var filters = data.filters;
                if(filters.length != 0){
                    $("#scroller_filters").fadeOut(transition_time, function(){
                        $("#scroller_filters").html('');
                        $("#scroller_filters").fadeIn(1);
                        show_filters(filters, 0);
                    });
                }else{
                    $("#scroller_filters").fadeOut(transition_time, function(){
                        $("#scroller_filters").html('');
                        $("#scroller_filters").fadeIn(1);
                    });
                }
                callback();
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            toast('Įvyko klaida. Perkraukite puslapį','bad','logo');
            console.log(xhr.responseText);
        }
    });
}

function check_if_user_is_loged(){
    FB.getLoginStatus(function(response) {
        if (response.status == 'connected') {
            user_login_status = true;
        } else if (response.status == 'not_authorized') {
            user_login_status = false;
        } else {
            user_login_status = false;
        }
    });
    return user_login_status;
}

function content_navigation(type){
    switch(type){
        case "home":
            show_loading_screen();
            location.href = "/";
            break;
        case "profile":
            if(check_if_user_is_loged()){
                show_loading_screen();
                location.href = "/profile";
            }else{
                show_top_layer('account');
            }

            break;

        case "shoppinglist":
            if(check_if_user_is_loged()){
                show_loading_screen();
                location.href = "/shoppinglist";
            }else{
                show_top_layer('account');
            }
            break;

        case "places":
            show_loading_screen();
            location.href = "/places";
            break;

        default:
            show_loading_screen();
            location.href = "/";
            break;
    }
}

function show_top_layer(type, ID){
    ID = ID || '0';
    var data;
    switch(type){
        case "account":
            data =
                "<div id='top_box_up'>" +
                    "<div id='top_box_title' class='untouchable'>Prisijungti</div>" +
                    "<div class='top_box_social_box untouchable' id='top_box_social_facebook' onclick='facebook_login()'></div>" +
                "</div>" +
                //"<div id='top_box_content' class='untouchale'>Prisijunkite prie Foodex bendruomenės</div>";
                "<div id='top_box_content' class='untouchable'>" +
                    "<div id='facebook_login_button' onclick='facebook_login()'>" +
                    "</div>" +
                "</div>";
                $("#top_box").html(data);
                FB.XFBML.parse(document.getElementById('top_box_content_centered_box'));
            break;
        case "options":
            data =
                "<div id='top_box_up'>" +
                    "<div id='top_box_title' class='untouchable'>Nustatymai</div>" +
                    "<div class='top_box_social_box untouchable' id='top_box_social_delete_account' onclick='show_top_layer_new_content(\"delete_account\")''></div>" +
                    "<div class='top_box_social_box untouchable' id='top_box_social_change_pass' onclick='show_top_layer_new_content(\"change_pass\")'></div>" +
                "</div>" +
                "<div id='top_box_content' class='untouchable'>Profilio nustatymai</div>";
                $("#top_box").html(data);
            break;
        case "coop":
            data =
                "<div id='top_box_up'>" +
                    "<div id='top_box_title' class='untouchable'>Gaminti kartu su draugais</div>" +
                    "<div class='top_box_social_box untouchable' id='top_box_coop_icon'></div>" +
                "</div>" +
                    "<div id='top_box_content' class='untouchable'>" +
                        "<div id='top_box_info_text'>Foodex paskelbs išsamų kvietimą gaminti Jūsų Facebook profilyje</div>" +
                        "<div id='top_box_button_zone'>" +
                            "<div class='top_box_button' onclick=\"coop(" + ID + ");hide_top_layer()\">OK</div>" +
                            "<div class='top_box_button' onclick='hide_top_layer()'>Atšaukti</div>" +
                        "</div>" +
                "</div>";
            $("#top_box").html(data);
            break;
        case "share":
            data =
                "<div id='top_box_up'>" +
                "<div id='top_box_title' class='untouchable'>Pasidalink su draugais</div>" +
                    "<div class='top_box_social_box untouchable' id='top_box_social_facebook'></div>" +
                "</div>" +
                "<div id='top_box_content' class='untouchable'>" +
                    "<div id='top_box_info_text'>Foodex paskelbs informaciją apie patiekalą Jūsų Facebook profilyje</div>" +
                    "<div id='top_box_button_zone'>" +
                    "<div class='top_box_button' onclick=\"share_food(" + ID + ");hide_top_layer()\">OK</div>" +
                    "<div class='top_box_button' onclick='hide_top_layer()'>Atšaukti</div>" +
                "</div>" +
                "</div>";
            $("#top_box").html(data);
            break;
    }

    if(type == "options"){
        show_top_layer_new_content('change_pass');
    }

    $("#top_layer").fadeIn(transition_time * 2);
    $(function(){
        $('.top_layer_item').click(function(event){
            if(event.target.id == 'top_layer'){
                hide_top_layer();
            }
        });
    });
}

function show_top_layer_new_content(type){
    var data;
    switch(type){
        case "change_pass":
            data =
                "Change passs";
            break;
        case "delete_account":
            data =
                "Delete";
            break;
    }

    $("#top_box_content").html(data);
    $(".top_box_social_box ").removeClass('active_top_box');
    $("#top_box_social_" + type).addClass('active_top_box');
}

function hide_top_layer(){
    $("#top_layer").fadeOut(transition_time * 2);
}

function hide_loading_screen(){
    //var left = screen.width;
    //var left = $(window).width();
    //$("#loading_screen_title").animate({left: -left},transition_time * 2);
    //$("#loading_screen_info").css('width',left - 40 + "px");
    //$("#loading_screen_info").animate({left: left},transition_time * 2,function(){
        $("#loading_screen").fadeOut(transition_time * 2);
   // });

    var formData = new FormData();
    formData.append('status', 'end');
    $.ajax({
        type: 'POST',
        url: '/ajax/loading_screen',
        data: formData,
        dataType: 'json',
        beforeSend: function () {
        },
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status == "good") {
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            toast('Įvyko klaida. Perkraukite puslapį','bad','logo');
        }
    });

}

function show_loading_screen(){
    $("#loading_screen").fadeIn(transition_time * 2);

    var formData = new FormData();
    formData.append('status', 'start');
    $.ajax({
        type: 'POST',
        url: '/ajax/loading_screen',
        data: formData,
        dataType: 'json',
        beforeSend: function () {
        },
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status == "good") {
                $("#loading_screen_info").html(data.fact);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            toast('Įvyko klaida. Perkraukite puslapį','bad','logo');
        }
    });

    //$("#loading_screen_title").css('left','50%');
    //$("#loading_screen_info").css('left','0px');
    //$("#loading_screen_info").css('width','auto');
}

function go_to_new_recipe(){
    location.href= "/new";
}


function filter_go_back(type){
    //level 0 = selected filters
    //level 1 = all categories
    //level 2 = specific category
    //level 3 = ingredients specific category

    full_sidebar();
    if(type == "one"){
        filter_level--;
    }else{
        filter_level = 0;
    }

    switch(filter_level) {
        case 0:
            filters_show('selected','');
            break;
        case 1:
            filters_show('categories','');
            break;
        case 2:
            filters_show('inside_category','Category');
            break;
    }
}

function show_config_zone(state){
    if(state == 0){
        var config_zone =
            "<div class='filter_element untouchable' onclick=\"filters_show('categories','');\">" +
                "<div class='filter_element_image' id='add'></div>" +
                "<div class='filter_element_text'>Pridėti filtrą</div>" +
            "</div>";

        $("#config_zone").fadeOut(transition_time, function(){
            $("#config_zone").html(config_zone);
            $("#config_zone").fadeIn(transition_time);
        });

    }else{
        var config_zone = "<div class='filter_element_go_back untouchable'><div class='go_back untouchable' onclick=\"filter_go_back('all')\"><<</div><div class='go_back untouchable' onclick=\"filter_go_back('one')\"><</div></div>";
        $("#config_zone").fadeOut(transition_time, function(){
            $("#config_zone").html(config_zone);
            $("#config_zone").fadeIn(transition_time);
        });
    }
}


function filter_send_indicator_changes(filter_type, filter_id, indicator_status){
    loading('content_wrapper', 'show');
    var formData = new FormData();
    formData.append('type', filter_type);
    formData.append('id', filter_id);
    formData.append('indicator', indicator_status);
    $.ajax({
        type: 'POST',
        url: '/ajax/filter_indicator_change',
        data: formData,
        dataType: 'json',
        beforeSend: function () {
        },
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status == "good") {
                load_recipes('true', function(){
                    loading('content_wrapper', 'hide');
                });
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            toast('Įvyko klaida. Perkraukite puslapį','bad','logo');
            console.log(xhr.responseText);
        }
    });
}

function filter_indicator_change(ID){
    var ID = ID.replace('indicator_change_','');
    var filter_data = ID.split('-');
    var filter_type = filter_data[0];
    var filter_id = filter_data[1];
    var new_indicator_status;
    if($("#" + ID).hasClass('filter_element_indicator_not_want')){
        $('#' + ID).removeClass('filter_element_indicator_not_want').addClass('filter_element_indicator_want');
        new_indicator_status = 'want';
    }else if($("#" + ID).hasClass('filter_element_indicator_want')){
        $('#' + ID).removeClass('filter_element_indicator_want').addClass('filter_element_indicator_not_want');
        new_indicator_status = 'not_want';
    }

    filter_send_indicator_changes(filter_type, filter_id, new_indicator_status);
}

function manipulate_filter(ID){
    full_sidebar();
    var new_indicator_status;
    var filter_data = ID.split('-');
    var filter_type = filter_data[0];
    var filter_id = filter_data[1];
    var symbols_amount = $("#" + ID + " .filter_element_text").html();
    var symbols_amount = symbols_amount.length;

    if($("#indicator_" + ID).hasClass('want')){
        $("#indicator_" + ID).removeClass('want').addClass('not_want');
        if (symbols_amount > 19) {
            $("#" + ID + " .filter_element_text").css('line-height', '21px');
        }
        new_indicator_status = "not_want";
    }else if($("#indicator_" + ID).hasClass('not_want')){
        $("#" + ID).removeClass('selected');
        $("#indicator_" + ID).removeClass('not_want');
        $("#" + ID + " .filter_element_text").css('line-height','43px');
        new_indicator_status = "none";
    }else{
        $("#" + ID).addClass('selected');
        $("#indicator_" + ID).addClass('want');
        if(symbols_amount > 19){
            $("#" + ID + " .filter_element_text").css('line-height','21px');
        }
        new_indicator_status = "want";
    }

    filter_send_indicator_changes(filter_type, filter_id, new_indicator_status);
}

function shoppinglist_add(ID){
    var id = ID.replace('shoppinglist-','');
    var image = $('#' + ID + " .search_item_image").css('background-image');
    var title = $('#' + ID + " .search_item_title").html();
    $("#search_input").val('');
    input_blur();
    input_focus('shoppinglist');
    var shopping_items = [];
    var data = "<div class='filter_element untouchable' id='" + id + "' onclick='shoppinglist_item_selected(this.id)'><div class='filter_element_image' style=\"background-image:" + image + ";\"></div><div class='filter_element_text'>" + title + "</div><div class='filter_element_delete' id='delete_" + id + "' onclick='shoppinglist_delete(this.id)'></div></div>";
    shopping_items[0] = data;
    show_filters(shopping_items, 0);
    setTimeout(function(){
        scroll_filters.refresh();
        //scroll_filters.scrollTo(0, current_filters_scroll);
        //var scroll_amount =  scroll_filters.maxScrollY - current_filters_scroll;
        scroll_filters.scrollBy(0, scroll_filters.maxScrollY, 600, IScroll.utils.ease.bounce);
    },100)

    var formData = new FormData();
    formData.append('shoppinglist_add_id', id);
    formData.append('shoppinglist_add_title', title);
    $.ajax({
        type: 'POST',
        url: '/ajax/shoppinglist_add',
        data: formData,
        dataType: 'json',
        beforeSend: function () {
        },
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status == "good") {

            }
        }
    });
}

var shoppinglist_items_ids = 0;
function shoppinglist_add_enter(){
    var id = "entered-" + shoppinglist_items_ids++;
    var image = "url('/images/shoppinglist_item.png')";
    var title = $("#search_input").val();
    $("#search_input").val('');
    input_blur();
    input_focus('shoppinglist');
    var shopping_items = [];
    var data = "<div class='filter_element untouchable' id='" + id + "' onclick='shoppinglist_item_selected(this.id)'><div class='filter_element_image' style=\"background-image:" + image + ";\"></div><div class='filter_element_text'>" + title + "</div><div class='filter_element_delete' id='delete_" + id + "' onclick='shoppinglist_delete(this.id)'></div></div>";
    shopping_items[0] = data;
    show_filters(shopping_items, 0);
    setTimeout(function(){
        scroll_filters.refresh();
        //var scroll_amount =  scroll_filters.maxScrollY - scroll_filters.y;
        scroll_filters.scrollBy(0, scroll_filters.maxScrollY, 600, IScroll.utils.ease.bounce);
    },100)

    var formData = new FormData();
    formData.append('shoppinglist_add_id', id);
    formData.append('shoppinglist_add_title', title);
    $.ajax({
        type: 'POST',
        url: '/ajax/shoppinglist_add',
        data: formData,
        dataType: 'json',
        beforeSend: function () {
        },
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status == "good") {

            }
        }
    });
}


function shoppinglist_delete(ID){
    ID = ID.replace('delete_','');
    var shoppinglist_data = ID.split('-');
    var shoppinglist_type = shoppinglist_data[0];
    var shoppinglist_id = shoppinglist_data[1];

    var formData = new FormData();
    formData.append('shoppinglist_type', shoppinglist_type);
    formData.append('shoppinglist_id', shoppinglist_id);
    $.ajax({
        type: 'POST',
        url: '/ajax/shoppinglist_delete',
        data: formData,
        dataType: 'json',
        beforeSend: function () {
        },
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status == "good") {
                $('#' + ID).remove();
                setTimeout(function(){
                    scroll_filters.refresh();
                }, 100);
            }
        }
    });
}

function filter_search_add(ID, indicator){
    var id = ID.replace('search-', '');
    var filter_data = id.split('-');
    var filter_type = filter_data[0];
    var filter_id = filter_data[1];
    var image = $('#' + ID + " .search_item_image").css('background-image');
    image = image.replace('"', "'");
    var title = $('#' + ID + " .search_item_title").html();
    $("#search_input").val('');
    input_blur();
    input_focus('search');

    if(filter_level == 0){
        var filters = [];
        var data = "<div class='filter_element untouchable filter_element_indicator_" + indicator + "' id='" + id + "' onclick='filter_selected(this.id)'><div class='filter_element_image' style=\"background-image:" + image + ";\"></div><div class='filter_element_text'>" + title + "</div><div class='filter_element_delete' id='delete_" + id + "' onclick='filter_delete(this.id)'></div><div class='filter_element_indicator_change' id='indicator_change_" + id + "' onclick='filter_indicator_change(this.id)'></div><div class='filter_element_indicator_small'></div></div>";
        filters[0] = data;
        show_filters(filters, 0);

        setTimeout(function(){scroll_filters.refresh()}, 100);
    }

    filter_send_indicator_changes(filter_type, filter_id, indicator);
}



function filter_delete(ID){
    ID = ID.replace('delete_','');
    var filter_data = ID.split('-');
    var filter_type = filter_data[0];
    var filter_id = filter_data[1];
    $('#' + ID).remove();
    setTimeout(function(){
        scroll_filters.refresh();
    }, 100);

    filter_send_indicator_changes(filter_type, filter_id, 'none');
}

function filter_selected(ID){
    full_sidebar();

    var symbols_amount = $("#" + ID + " .filter_element_text").html();
    var symbols_amount = symbols_amount.length;

    if($("#" + ID).hasClass('selected')){
        $("#" + ID).removeClass('selected');
        $("#" + ID + " .filter_element_text").css('line-height','43px');
    }else{
        $("#" + ID).addClass('selected');
        if(symbols_amount > 19){
            $("#" + ID + " .filter_element_text").css('line-height','21px');
        }
    }
}

function shoppinglist_item_selected(ID) {
    full_sidebar();
    var classes = ($("#" + ID).attr('class')).split(" ");
    var selected = classes[2];

    var title = $("#" + ID + " .filter_element_text").html();
    var symbols_amount = title.length;

    if(selected != "selected"){
        $(".filter_element").removeClass('selected');
        $("#" + ID).addClass('selected');
        if(symbols_amount > 19){
            $("#" + ID + " .filter_element_text").css('line-height','21px');
        }
        //show_prices(ID);
    }else{
        $("#" + ID).removeClass('selected');
        $("#" + ID + " .filter_element_text").css('line-height','43px');
        //close_prices();
    }
}

function show_prices(ID){
    //pagal id parodo kainas kur kokios parduotuveje ir artmiausias vietas
    //pagal pavadnima title bando atspeti produkta  parodo kainas kur kokios parduotuveje ir artmiausias vietas

    var product_name = $("#" + ID + " .filter_element_text").html();
    $("#sidebar_right").removeClass('right_squeeze').addClass('right_full');
    var height_from_top = $(".ingredients_divider").offset().top + 10;
    $("#sidebar_right_ingredients_zone").css('top', height_from_top + 'px');

    if(mobile_state){
        empty_sidebar();
    }
}

function close_prices(){
    $("#sidebar_right").removeClass('right_full').addClass('right_squeeze');
}

function search(type){
    var value = ($('#search_input').val()).trim();
    value = value.replace(/[-\/\\^$*+?.,()|[\]{}]/g, ' ');
    if(value == ""){
        $('#search_container_inside').html('');
        $('#search_container').css('display','none');
    }else{
        $('#search_container_inside').html('');
        $('#search_container').css('display','block');

        switch(type) {
            case "search":
                var ajax_url = "/ajax/search";
                break;
            case "shoppinglist":
                var ajax_url = "/ajax/search_shoppinglist";
                break;
            case "places":
                var ajax_url = "/ajax/search_places";
                break;
        }

        var formData = new FormData();
        formData.append("search", value);
        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: formData,
            dataType: 'json',
            beforeSend: function () {
                loading('search_container_inside','show');
            },
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status == "good") {
                    var search_data = data.search_data;
                    loading('search_container_inside','hide');
                    if(search_data.length != 0){
                        for(i = 0; i < search_data.length; i++){
                            $("#search_container_inside").append(search_data[i]);
                        }
                    }else{
                        $("#search_container_inside").append('Neranda');
                    }
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                toast('Įvyko klaida. Perkraukite puslapį','bad','logo');
                console.log(xhr.responseText);
            }
        });
    }
}

function focus_input(ID){
    full_sidebar();
    if(!$('#' + ID).is(':focus')){
        $('#' + ID).focus();
    }
}

function last_index(){
    path = $(location).attr('href');
    path = path.substring(path.lastIndexOf("/")+ 1);
    return (path.match(/[^.]+(\.[^?#]+)?/) || [])[0];
}

function show_recipe(recipe_ID){
    if(!clickable) return;
    if(mobile_state){
        empty_sidebar();
    }

    if($("#recipe_" + recipe_ID).hasClass('recipe_active')){
        hide_recipe();
    }else{
        if($('.recipe_active').length == 0){
            var formData = new FormData();
            formData.append('recipe_ID', recipe_ID);
            $.ajax({
                type: 'POST',
                url: '/ajax/recipe_right_sidebar',
                data: formData,
                dataType: 'json',
                beforeSend: function () {
                    loading("recipe_" + recipe_ID, 'show');
                },
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == "good") {
                        $("#scroll_sidebar_right").html(data.recipe_data)
                        $("#sidebar_right_cook_button").click(function(){
                            cook(recipe_ID);
                        });
                        $("#sidebar_right").removeClass('right_squeeze').addClass('right_full');
                        $('.recipe_box').removeClass('recipe_active');
                        $("#recipe_" + recipe_ID).addClass('recipe_active');
                        scroll_sidebar_right.refresh();
                        scroll_sidebar_right.scrollTo(0,0);
                    }else{
                        hide_recipe();
                        toast('Tokio recepto nėra','bad','logo');
                    }
                    loading("recipe_" + recipe_ID, 'hide');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    toast('Įvyko klaida. Perkraukite puslapį','bad','logo');
                    loading("recipe_" + recipe_ID, 'hide');
                    hide_recipe();
                    console.log(xhr.responseText);
                }
            });
        }else{
            hide_recipe();
            setTimeout(function(){
                show_recipe(recipe_ID);
            },transition_time)
        }
    }
}

function hide_recipe(){
    $("#sidebar_right").removeClass('right_full').addClass('right_squeeze');
    $('.recipe_box').removeClass('recipe_active');
}

function cook(recipe_ID){
    show_loading_screen();
    var formData = new FormData();
    formData.append('recipe_ID', recipe_ID);
    $.ajax({
        type: 'POST',
        url: '/ajax/user_cooking',
        data: formData,
        dataType: 'json',
        beforeSend: function () {
        },
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status == "good") {
                location.href = "/cook/" + recipe_ID;
            }
        }
    });
}



//tracks down mouse click
$(document).mousedown(function(event){
    if($(event.target).attr("id") == "search_container" || ( typeof $(event.target).attr("class") !== "undefined" && $(event.target).hasClass('s_e'))){
        event.preventDefault();
    }
});

function input_focus(type){
    $("#search_zone").removeClass('unactive_search_zone');
    $("#search_zone").addClass('active_search_zone');
    full_sidebar();
    //manipulate max-height search_container
    var max_height = parseInt(($('#filters_zone').css('height')).replace('px',''));
    $("#search_container").css('max-height', max_height + "px");
    $("#search_container_inside").css('max-height', max_height + "px");
    search(type);
}

function input_blur(){
    $("#search_zone").removeClass('active_search_zone');
    $("#search_zone").addClass('unactive_search_zone//');
    $('#search_container_inside').html('');
    $('#search_container').css('display','none');
}

function ingredient_selected(ingredient_ID){
    if(check_if_user_is_loged()){
        var classes = ($("#ingredient_indicator-" + ingredient_ID).attr('class')).split(" ");
        var indicator = classes[1];
        if(indicator == "ingredient_indicator_undefined"){
            $("#ingredient_indicator-" + ingredient_ID).removeClass('ingredient_indicator_undefined').addClass('ingredient_indicator_shoppinglist');

            var formData = new FormData();
            formData.append('ingredient_ID', ingredient_ID);
            $.ajax({
                type: 'POST',
                url: '/ajax/ingredient_add',
                data: formData,
                dataType: 'json',
                beforeSend: function () {
                },
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == "good") {

                    }
                }
            });

        }else if(indicator == "ingredient_indicator_shoppinglist"){
            $("#ingredient_indicator-" + ingredient_ID).removeClass('ingredient_indicator_shoppinglist').addClass('ingredient_indicator_have');

            var formData = new FormData();
            formData.append('ingredient_delete', ingredient_ID);
            $.ajax({
                type: 'POST',
                url: '/ajax/ingredient_delete',
                data: formData,
                dataType: 'json',
                beforeSend: function () {
                },
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == "good") {

                    }
                }
            });
        }else if(indicator == "ingredient_indicator_have"){
            $("#ingredient_indicator-" + ingredient_ID).removeClass('ingredient_indicator_have').addClass('ingredient_indicator_undefined');
        }
    }else{
        show_top_layer('account');
    }
}

function add_to_shopping_list(recipe_ID){
    if(check_if_user_is_loged()){
        var formData = new FormData();
        formData.append('recipe_ID', recipe_ID);
        $.ajax({
            type: 'POST',
            url: '/ajax/ingredient_add_all',
            data: formData,
            dataType: 'json',
            beforeSend: function () {
            },
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status == "good") {
                    $('.ingredient_indicator').removeClass('ingredient_indicator_have').removeClass('ingredient_indicator_undefined').removeClass('ingredient_indicator_shoppinglist').addClass('ingredient_indicator_shoppinglist');
                    toast('Produktai sudėti į pirkinių krepšį','good', 'shoppinglist');
                }
            }
        });


    }else{
        show_top_layer('account');
    }
}





function coop(recipe_ID){
    if(check_if_user_is_loged()){
        var have = [];
        var need = [];

        //get title, foto, cook link
        var title = "Šiškebabas";
        var image = "http://www.foodex.lt/images/food (5).jpg";
        var link = "http://www.foodex.lt/cook/1/";

        var formData = new FormData();
        formData.append('recipe_ID', recipe_ID);
        $.ajax({
            type: 'POST',
            url: '/ajax/coop_info',
            data: formData,
            dataType: 'json',
            beforeSend: function () {
            },
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status == "good") {
                }
            }
        });


        //use facebook API to share on wall to cook together with missing ingredients
        $(".ingredient").each(function(){
            var id = "#" + this.id;
            var classes = $(id + " .ingredient_indicator").attr('class').split(" ");
            var indicator = classes[1];
            var title = $(id + " .ingredient_text").html();
            var size = $(id + " .ingredient_size").html();
            var element = [title, size];

            if(indicator == "ingredient_indicator_have"){
                have.push(element);
            }else{
                need.push(element);
            }
        });

        var message = "Kas norit kartu pasigaminti '" + title + "'\n";
        message += "\n";
        message += "Turiu:\n";
        for(i = 0; i < have.length; i++){
            message += "+ " + have[i][0] + " " + have[i][1] + "\n";
        }
        message += "\n";
        message += "Trūksta:\n";
        for(i = 0; i < need.length; i++) {
            message += "- " + need[i][0] + " " + need[i][1] + "\n";
        }


        FB.api('/me/feed', 'post', {
            message: message,
            name: 'Foodex',
            caption: 'Gaminkite kartu su Foodex',
            description: 'Maistas svarbiausia',
            link: link,
            picture: image
        }, function(response) {
            if (!response || response.error) {
                toast('Jūs nesuteikėte privilegijos rašyti ant jūsų laiko juostos','bad', 'coop');
            } else {
                toast('Žinutė Jūsų draugams pasiųsta sėkmingai','good', 'coop');
            }
        });

    }else{
        show_top_layer('account');
    }

}

function steps_manipulation(){
    var step_height = parseInt(($("#content_wrapper").css('height')).replace("px", "")) - 1;
    var step_width = parseInt(($("#content_wrapper").css('width')).replace("px", "")) - content_right_margin * 2;
    if(mobile_state){
        //$("#content_wrapper").css('height', step_height - 41 + "px");
        //step_height = step_height - 41;
        $('.step').addClass('squeezed_step');
    }else{
        $('.step').removeClass('squeezed_step');
    }

    $(".step").css('height', step_height + "px");
    $(".step").css('width', step_width + "px");
}

function calculate_recipe_size(){
    //$(window).height();   // returns height of browser viewport
    //$(document).height(); // returns height of HTML document
    //$(window).width();   // returns width of browser viewport
    //$(document).width(); // returns width of HTML document
    //screen.height;
    //screen.width;
    var content_width = parseInt(($("#content_wrapper").css('width')).replace("px", "")) - recipe_box_margin_size - content_right_margin;
    var size_per_item = content_width / 4 - recipe_box_margin_size;
    if(size_per_item < minimum_recipe_size){
        size_per_item = content_width - recipe_box_margin_size;
    }
    return size_per_item;

}

function recalculate_width(){
    var content_width = parseInt(($("#content_wrapper").css('width')).replace("px", "")) - recipe_box_margin_size - content_right_margin;
    var size_per_item = content_width / 4 - recipe_box_margin_size;
    if(size_per_item < minimum_recipe_size){
        size_per_item = content_width - recipe_box_margin_size;
        $(".recipe_box").css("font-size","30px");
    }else{
        $(".recipe_box").css("font-size","");
    }

    $(".recipe_box").css('width', size_per_item + "px");
    $(".recipe_box").css('height', size_per_item + "px");
    $(".recipe_box").css('line-height', size_per_item + "px");
}





function sidebar_manipulation(){
    var screen_width = $(window).width();
    if(screen_width <= mobile_width_size){
        mobile_state = true;
        $('#header').css('display','block');
        $('#content_wrapper').css('top','41px');
        $("#steps_sidebar").css('top','41px');
        empty_sidebar();
    }else{
        mobile_state = false;
        $('#header').css('display','none');
        $('#content_wrapper').css('top','0px');
        $("#steps_sidebar").css('top','0px');
        if(get_sidebar_state() == "squeeze")
            squeeze_sidebar();
        else
            full_sidebar();
    }
}

function manipulate_map_buttons_zone(){
    if(mobile_state){
        $('#map_buttons_zone_locker').css('display','block');
        $('#map_buttons_zone').css('top','41px');
        $('#map_buttons_zone_bottom').css('top','171px');
        $('#map_buttons_zone').addClass('squeezed_buttons');
        $('#content_wrapper').css('right','0px');
    }else{
        $('#map_buttons_zone_locker').css('display','none');
        $('#map_buttons_zone').css('top','0px');
        $('#map_buttons_zone_bottom').css('top','131px');
        $('#map_buttons_zone').removeClass('squeezed_buttons');
        $('#content_wrapper').css('right','66px');
        setTimeout(function(){scroll_map_buttons.refresh()},0);
    }
}

function show_hide_map_buttons_zone(){
    if($('#map_buttons_zone').hasClass('squeezed_buttons')){
        $('#map_buttons_zone').removeClass('squeezed_buttons');
        setTimeout(function(){scroll_map_buttons.refresh()},0);
        $('#content_wrapper').css('right','66px');
    }else{
        $('#map_buttons_zone').addClass('squeezed_buttons');
        $('#content_wrapper').css('right','0px');
    }
}

function empty_sidebar_slide(){
    if($("#sidebar").hasClass('full')){
        $("#sidebar").removeClass('full').removeClass('empty').removeClass('squeeze').addClass('empty');
        $("#content_wrapper").css('left','0px');
        $("#header").css('left','0px');
        $("#sidebar_slider").css('display','block');
        $("#header_logo").css('display','block');
        //$("#header_map_buttons_zone_locker").css('display','block');
        $("#header_options").css('display','block');
        $("#config_zone").css('display','none');
        $("#cook_ingredients").css('display','none');
        $(".next_step").html(">>");
        //var height_from_top = $(".middle_divider").offset().top;
        //$("#filters_zone").css('top', height_from_top + 'px');

    }else if($("#sidebar").hasClass('empty')){
        $("#sidebar").removeClass('full').removeClass('empty').removeClass('squeeze').addClass('full');
        $("#content_wrapper").css('left','231px');
        $("#header").css('left','231px');
        $("#sidebar_slider").css('display','none');
        $("#header_logo").css('display','none');
        //$("#header_map_buttons_zone_locker").css('display','none');
        $("#header_options").css('display','none');
        $("#config_zone").css('display','block');
        $("#cook_ingredients").css('display','block');
        $(".next_step").html("Sekantis");
        //var height_from_top = $(".middle_divider").offset().top;
        //$("#filters_zone").css('top', height_from_top + 'px');
    }
    hide_recipe();
}


function sidebar_slide(){
    var sidebar_class = ($("#sidebar").attr('class'));
    if(sidebar_class == "full"){
        squeeze_sidebar();
    }else{
        full_sidebar();
    }
}

function full_sidebar(){
    $("#sidebar").removeClass('full').removeClass('empty').removeClass('squeeze').addClass('full');
    $("#content_wrapper").css('left','231px');
    $("#header").css('left','231px');
    $("#config_zone").css('display','block');
    $("#cook_ingredients").css('display','block');
    $(".next_step").html("Sekantis");
    //calculate top px for filters zone
    var height_from_top = $(".middle_divider").offset().top;
    $("#filters_zone").css('top', height_from_top + 'px');
    if(!mobile_state){
        $("#sidebar_slider").css('display','block');
        recalculate_width();
        steps_manipulation();
    }

    set_sidebar_state('full');
    hide_recipe();
}

function squeeze_sidebar(){
    $("#sidebar").removeClass('full').removeClass('empty').addClass('squeeze');
    $("#content_wrapper").css('left','66px');
    $("#header").css('left','66px');
    $("#sidebar_slider").css('display','none');
    $("#config_zone").css('display','block');
    $("#cook_ingredients").css('display','none');
    $(".next_step").html(">>");
    //calculate top px for filters zone
    //var height_from_top = $(".middle_divider").offset().top;
    //$("#filters_zone").css('top', height_from_top + 'px');
    if(!mobile_state){
        recalculate_width();
    }
    steps_manipulation();
    set_sidebar_state('squeeze');
}

function empty_sidebar(){
    $("#sidebar").removeClass('full').removeClass('squeeze').addClass('empty');
    $("#content_wrapper").css('left','0px');
    $("#header").css('left','0px');
    $("#header_logo").css('display','block');
    $("#header_map_buttons_zone_locker").css('display','block');
    $("#sidebar_slider").css('display','none');
    $("#config_zone").css('display','none');
    recalculate_width();
    steps_manipulation();
}

function get_sidebar_state(){
    return localStorage["sidebar_state"];
}

function set_sidebar_state(state){
    localStorage.setItem('sidebar_state', state);
    return true;
}



function steps_sidebar_initialize(){
    var screen_height = $("#steps_sidebar").height();
    var real_steps_amount = steps_amount + 2;
    var step_height = screen_height / real_steps_amount - 1;
    var step;

    var content_height = parseInt(($("#content_wrapper").css('height').replace('px', '')));
    var all = $("#content_wrapper")[0].scrollHeight;
    var current = 0;

    var percentage = (current + content_height) / all ;
    var pointer_height = parseInt(content_height * percentage) ;
    $("#steps_sidebar_pointer").css('height', pointer_height + 'px');

    //pradinis
    step = "<div class='step_indicator' style=\"height:" + step_height + "px;line-height:" + step_height + "px;\" onclick=\"step_go('0')\">0</div>";
    $("#steps_sidebar").append(step);

    for(i = 1; i <= steps_amount; i++){
        step = "<div class='step_indicator' style=\"height:" + step_height + "px;line-height:" + step_height + "px;\" onclick=\"step_go('" + i + "')\">" + i + "</div>";
        $("#steps_sidebar").append(step);
    }

    //paskutinis
    step = "<div class='step_indicator' style=\"height:" + step_height + "px;line-height:" + step_height + "px;\" onclick=\"step_go('last')\">*</div>";
    $("#steps_sidebar").append(step);

    steps_manipulation();
}

function steps_sidebar_manipulation(){
    var screen_height = $("#steps_sidebar").height();
    var real_steps_amount = steps_amount + 2;
    var step_height = screen_height / real_steps_amount - 1;
    $(".step_indicator").css('height', step_height + 'px').css('line-height', step_height + 'px');
    steps_manipulation();
}

function facebook_login(){
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            // connected
            toast('Jūs jau prisijungęs','bad','login');
            show_loading_screen();
            document.location = "http://bbd.dev/login/facebook";
        } else {
            // not_authorized
            FB.login(function(response) {
                if (response.authResponse) {
                    show_loading_screen();
                    document.location = "http://bbd.dev/login/facebook";
                } else {
                    toast('Prisijungimas nepavyko','bad','login');
                }
            }, {scope: 'publish_actions, email, public_profile, user_friends'});
        }
    });
}

var step_going = false;
function step_go(id){
    if(!step_going){
        step_going = true;
        var ID = "step_" + id;
        current_step = id;
        var modulation = 0;
        if(mobile_state){
            modulation = 41;
        }
        $("#content_wrapper").animate({scrollTop: $("#" + ID).offset().top + $("#content_wrapper").scrollTop() - modulation}, 600);
        setTimeout(function(){step_going = false;},600);
    }
}

//resize-end event trigger
$(window).resize(function() {
    if(this.resizeTO) clearTimeout(this.resizeTO);
    this.resizeTO = setTimeout(function() {
        $(this).trigger('resizeEnd');
    }, 500);
});

function next_step(){
    if(current_step == "last"){
        return false;
    }else{
        var next = parseInt(current_step) + 1;
        if($("#step_" + next).length != 0){
            step_go(next);
        }else {
            step_go('last');
        }
    }
}

function previous_step(){
    if(current_step == "0"){
        return false;
    }else if(current_step != "last"){
        var previous = parseInt(current_step) - 1;
        step_go(previous);
    }else{
        step_go(steps_amount);
    }
}

function recipe_like(recipe_ID, box_ID){

    if(check_if_user_is_loged()){
        var formData = new FormData();
        formData.append('recipe_ID', recipe_ID);
        $.ajax({
            type: 'POST',
            url: '/ajax/like',
            data: formData,
            dataType: 'json',
            beforeSend: function () {
            },
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status == "good") {
                    if(data.like_status == "liked"){
                        //make liked
                        $("#" + box_ID).removeClass('not_liked').addClass('liked');
                        if(box_ID == "sidebar_right_like"){
                            var current_likes = parseInt($("#sidebar_right_like").html()) + 1
                            $("#sidebar_right_like").html(current_likes);
                        }else if(box_ID == "step_like"){
                            $("#" + box_ID).html("Patinka");
                        }

                        toast('Receptas pridėtas prie mėgstamiausių','good', 'liked');
                    }else{
                        //make not liked
                        $("#" + box_ID).removeClass('liked').addClass('not_liked');
                        if(box_ID == "sidebar_right_like") {
                            var current_likes = parseInt($("#sidebar_right_like").html()) - 1;
                            $("#sidebar_right_like").html(current_likes);
                        }else if(box_ID == "step_like"){
                            $("#" + box_ID).html("Patinka");
                        }
                        toast('Receptas pašalintas iš mėgstamiausių','bad', 'not_liked');
                    }
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                toast('Įvyko klaida. Perkraukite puslapį','bad','logo');
                console.log(xhr.responseText);
            }
        });
    }else{
        show_top_layer('account');
    }
}

function share_food(recipe_ID){
    if(check_if_user_is_loged()){
        //take picture of food and upload to facebook

        var link = location.href;
        var image = "http://bbd.dev/images/food (5).jpg";
        var title = "Šiškebabas";
        var about = "Šiškebabas labai skanus ir geras patiekalas";

        var formData = new FormData();
        formData.append('recipe_ID', recipe_ID);
        $.ajax({
            type: 'POST',
            url: '/ajax/share',
            data: formData,
            dataType: 'json',
            beforeSend: function () {
            },
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status == "good") {

                }
            }
        });


        FB.api('/me/feed', 'post', {
            message: title,
            name: 'Foodex',
            caption: 'Gaminkite kartu su Foodex',
            description: about,
            link: link,
            picture: image
        }, function(response) {
            if (!response || response.error) {
                toast('Jūs nesuteikėte privilegijos rašyti ant jūsų laiko juostos','bad', 'login');
            } else {
                toast('Pasidalinta','good', 'login');
            }
        });
        /*
         FB.ui({
         method: 'share',
         href: 'https://developers.facebook.com/docs/dialogs/',
         }, function(response){});
         */
    }else{
        show_top_layer('account');
    }
}

function add_comment(recipe_ID){
    if(check_if_user_is_loged()){
        var comment = $('#step_comment_box_area').val();
        if(check('not_empty', comment)){
            var formData = new FormData();
            formData.append('recipe_ID', recipe_ID);
            formData.append('comment', comment);
            $.ajax({
                type: 'POST',
                url: '/ajax/comment',
                data: formData,
                dataType: 'json',
                beforeSend: function () {
                },
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == "good") {
                        squeeze_comment_box();
                        toast('Atsiliepimas įrašytas','good','write');
                    }
                }
            });

        }else{
            toast('Įrašykite ką nors','bad','write');
        }

    }else{
        show_top_layer('account');
    }
}

function squeeze_comment_box(){
    $('.step_comment_box_comments').animate({bottom: "50%", top: "50%"}, transition_time * 2,function(){
        $(".step_comment_box_comments").html("<div id='step_comment_title'>Ačiū</div>");
        $('.step_comment_box_comments').animate({height: "52px", marginTop: "-26px"}, transition_time);
    });
}

function logout(){
    FB.logout(function(response) {
        var formData = new FormData();
        formData.append('logout', 'true');
        $.ajax({
            type: 'POST',
            url: '/ajax/logout',
            data: formData,
            dataType: 'json',
            beforeSend: function () {
            },
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status == "good") {
                    squeeze_comment_box();
                    toast('Atsiliepimas įrašytas','good','write');
                }
            }
        });
        location.href = "/";
    });
}

var clock;
var chronometer_time = 0;
function cook_timer(ID){
    var classes = ($("#" + ID).attr('class')).split(" ");
    var selected = classes[2];
    if(selected == "step_timer_running"){
        $("#" + ID).removeClass('step_timer_running');
        $("#" + ID).html('00:00:00');
        chronometer_time = 0;
        clearInterval(clock);
    }else{
        $(".step_timer").removeClass('step_timer_running');
        chronometer_time = 0;
        clearInterval(clock);
        $(".step_timer").html('00:00:00');

        $("#" + ID).addClass('step_timer_running');
        clock = setInterval(function(){timer(ID)},1000);
    }
}

String.prototype.toHHMMSS = function () {
    var sec_num = parseInt(this, 10);
    var hours   = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours   < 10) {hours   = "0" + hours;}
    if (minutes < 10) {minutes = "0" + minutes;}
    if (seconds < 10) {seconds = "0" + seconds;}
    var time = hours + ':' + minutes + ':' + seconds;
    return time;
}

function timer(ID){
    chronometer_time++;
    $("#" + ID).html(chronometer_time.toString().toHHMMSS());
}