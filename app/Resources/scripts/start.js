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
    //ajax to get recipes
    var recipes = [];
    recipes[0] = ["0","/images/food (0).jpg", "title0"];
    recipes[1] = ["1","/images/food (1).png", "title0"];
    recipes[2] = ["2","/images/food (2).jpg", "title0"];
    recipes[3] = ["3","/images/food (3).jpg", "title0"];
    recipes[4] = ["4","/images/food (4).jpg", "title0"];
    recipes[5] = ["5","/images/food (5).jpg", "title0"];
    recipes[6] = ["6","/images/food (6).jpg", "title0"];
    recipes[7] = ["7","/images/food (7).jpg", "title0"];
    recipes[8] = ["8","/images/food (8).jpg", "title0"];
    recipes[9] = ["9","/images/food (9).jpg", "title0"];
    recipes[10] = ["10","/images/food (10).jpg", "title0"];
    recipes[11] = ["11","/images/food (11).jpg", "title0"];
    recipes[12] = ["12","/images/food (12).jpg", "title0"];
    recipes[13] = ["13","/images/food (13).jpg", "title0"];
    recipes[14] = ["14","/images/food (14).jpg", "title0"];
    recipes[15] = ["15","/images/food (15).jpg", "title0"];
    recipes[16] = ["16","/images/food (16).jpg", "title0"];
    recipes[17] = ["17","/images/food (17).jpg", "title0"];
    recipes[18] = ["18","/images/food (18).jpg", "title0"];
    recipes[19] = ["19","/images/food (19).jpg", "title0"];
    recipes[20] = ["20","/images/food (20).jpg", "title0"];


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

function append_recipes(){
    $("#scroller_content").html('');
    //later need from ajax with filters
    var recipes = [];
    recipes[0] = ["0","/images/food (0).jpg", "title0"];
    recipes[1] = ["1","/images/food (1).png", "title0"];
    recipes[2] = ["2","/images/food (2).jpg", "title0"];
    recipes[3] = ["3","/images/food (3).jpg", "title0"];
    recipes[4] = ["4","/images/food (4).jpg", "title0"];
    recipes[5] = ["5","/images/food (5).jpg", "title0"];
    recipes[6] = ["6","/images/food (6).jpg", "title0"];
    recipes[7] = ["7","/images/food (7).jpg", "title0"];
    recipes[8] = ["8","/images/food (8).jpg", "title0"];
    recipes[9] = ["9","/images/food (9).jpg", "title0"];
    recipes[10] = ["10","/images/food (10).jpg", "title0"];
    recipes[11] = ["11","/images/food (11).jpg", "title0"];
    recipes[12] = ["12","/images/food (12).jpg", "title0"];
    recipes[13] = ["13","/images/food (13).jpg", "title0"];
    recipes[14] = ["14","/images/food (14).jpg", "title0"];
    recipes[15] = ["15","/images/food (15).jpg", "title0"];
    recipes[16] = ["16","/images/food (16).jpg", "title0"];
    recipes[17] = ["17","/images/food (17).jpg", "title0"];

    for(i = 0; i < recipes.length; i++){
        append_recipe(recipes[i]);
    }

    /*
    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        data: { append_files: 'true' },
        dataType: 'json',
        success:function(data){
            var recipes = data.recipes;
            for(i = 0; i < recipes.length; i++){
                append_recipe(recipes[i]);
            }
        }
    });
    */
}

function append_recipe(data){
    var id = data[0];
    var image = data[1];
    var title = data[2];

    var appendable_data = "<div class='recipe_box' id='recipe_" + id + "' style=\"background-image: url('" + image + "');width:" + recipe_size + "px;height:" + recipe_size +  "px;\" onclick=\"show_recipe('" + id + "')\"><div class='recipe_box_info'>" + title + "</div></div>";
    $("#scroller_content").append(appendable_data);
}

function append_products(){
    $("#scroller_shoppinglist").append('Prekes random, pagal asemninius filtrus, akcijos, pasiulymai');
}

function append_shoppinglist(){
    //ajax to get all shoppinglist from user and show it
}

function show_loading_more(){
    var loading_more_box = "<div class='recipe_box' id='loading_more_box' style=\"width:" + recipe_size + "px;height:" + recipe_size +  "px;\"></div>";
    $("#content_wrapper").append(loading_more_box);
}

function hide_loading_more(){
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

function filter_start(){
    full_sidebar();
    filter_level = 1;
    var filters = [];
    filters[0] = "<div class='filter_element untouchable' id='types' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/types.png');\"></div><div class='filter_element_text'>Tipai</div></div>";
    filters[1] = "<div class='filter_element untouchable' id='characteristics' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/characteristics.png');\"></div><div class='filter_element_text'>Ypatybės</div></div>";
    filters[2] = "<div class='filter_element untouchable' id='times' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/times.png');\"></div><div class='filter_element_text'>Laikai</div></div>";
    filters[3] = "<div class='filter_element untouchable' id='countries' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/countries.png');\"></div><div class='filter_element_text'>Šalys</div></div>";
    filters[4] = "<div class='filter_element untouchable' id='ingredients_categories' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/ingredients_categories.png');\"></div><div class='filter_element_text'>Ingredientai</div></div>";
    filters[5] = "<div class='filter_element untouchable' id='celebrations' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/celebrations.png');\"></div><div class='filter_element_text'>Šventės</div></div>";
    filters[6] = "<div class='filter_element untouchable' id='cooking_methods' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/cooking_methods.png');\"></div><div class='filter_element_text'>Gaminimo būdai</div></div>";

    $("#scroller_filters").fadeOut(transition_time, function(){
        $("#scroller_filters").html('');
        $("#scroller_filters").fadeIn(1);
        show_filters(filters, 0);
    });

    /*
     $.ajax({
     type: 'POST',
     url: 'ajax.php',
     data: { filter_start: 'true' },
     dataType: 'json',
     beforeSend:function(){
     },
     success:function(data){
     $("#filters_zone").fadeOut(transition_time, function(){
     $("#filters_zone").html(data.filters);
     $("#filters_zone").fadeIn(transition_time);
     });
     $("#config_zone").fadeOut(transition_time, function(){
     $("#config_zone").html(data.config_zone);
     $("#config_zone").fadeIn(transition_time);
     });
     }
     });
     */
}

function filter_category(category){
    full_sidebar();
    filter_level = 2;
    var filters = [];
    switch(category){
        case "types":
            filters[0] = "<div class='filter_element untouchable' id='types_1' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/drinks.png');\"></div><div class='filter_element_text'>Gėrimai</div><div class='filter_element_indicator' id='indicator_types_1'></div></div>";
            filters[1] = "<div class='filter_element untouchable' id='types_2' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/pastries.png');\"></div><div class='filter_element_text'>Kepiniai</div><div class='filter_element_indicator' id='indicator_types_2'></div></div>";
            filters[2] = "<div class='filter_element untouchable' id='types_3' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/desserts.png');\"></div><div class='filter_element_text'>Desertai</div><div class='filter_element_indicator' id='indicator_types_3'></div></div>";
            filters[3] = "<div class='filter_element untouchable' id='types_4' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/second_dishes.png');\"></div><div class='filter_element_text'>Antrieji patiekalai</div><div class='filter_element_indicator' id='indicator_types_4'></div></div>";
            filters[4] = "<div class='filter_element untouchable' id='types_5' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/canned_meals.png');\"></div><div class='filter_element_text'>Konservuoti patiekalai</div><div class='filter_element_indicator' id='indicator_types_5'></div></div>";
            filters[5] = "<div class='filter_element untouchable' id='types_6' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/porridges.png');\"></div><div class='filter_element_text'>Košės</div><div class='filter_element_indicator' id='indicator_types_6'></div></div>";
            filters[6] = "<div class='filter_element untouchable' id='types_7' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('images/salads.png');\"></div><div class='filter_element_text'>Salotos</div><div class='filter_element_indicator' id='indicator_types_7'></div></div>";
            filters[7] = "<div class='filter_element untouchable' id='types_8' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/soups.png');\"></div><div class='filter_element_text'>Sriubos</div><div class='filter_element_indicator' id='indicator_types_8'></div></div>";
            filters[8] = "<div class='filter_element untouchable' id='types_9' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/sandwitches.png');\"></div><div class='filter_element_text'>Sumuštiniai</div><div class='filter_element_indicator' id='indicator_types_9'></div></div>";
            filters[9] = "<div class='filter_element untouchable' id='types_10' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/stews.png');\"></div><div class='filter_element_text'>Troškiniai</div><div class='filter_element_indicator' id='indicator_types_10'></div></div>";
            filters[10] = "<div class='filter_element untouchable' id='types_11' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/jams.png');\"></div><div class='filter_element_text'>Uogienės</div><div class='filter_element_indicator' id='indicator_types_11'></div></div>";
            filters[11] = "<div class='filter_element untouchable' id='types_12' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/snacks.png');\"></div><div class='filter_element_text'>Užkandžiai</div><div class='filter_element_indicator' id='indicator_types_12'></div></div>";
            filters[12] = "<div class='filter_element untouchable' id='types_13' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/sauces.png');\"></div><div class='filter_element_text'>Padažai</div><div class='filter_element_indicator' id='indicator_types_13'></div></div>";
            break;
        case "times":
            filters[0] = "<div class='filter_element untouchable' id='times_1' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 5min</div><div class='filter_element_indicator' id='indicator_times_1'></div></div>";
            filters[1] = "<div class='filter_element untouchable' id='times_2' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 10min</div><div class='filter_element_indicator' id='indicator_times_2'></div></div>";
            filters[2] = "<div class='filter_element untouchable' id='times_3' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 15min</div><div class='filter_element_indicator' id='indicator_times_3'></div></div>";
            filters[3] = "<div class='filter_element untouchable' id='times_4' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 20min</div><div class='filter_element_indicator' id='indicator_times_4'></div></div>";
            filters[4] = "<div class='filter_element untouchable' id='times_5' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 25min</div><div class='filter_element_indicator' id='indicator_times_5'></div></div>";
            filters[5] = "<div class='filter_element untouchable' id='times_6' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 30min</div><div class='filter_element_indicator' id='indicator_times_6'></div></div>";
            filters[6] = "<div class='filter_element untouchable' id='times_7' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 45min</div><div class='filter_element_indicator' id='indicator_times_7'></div></div>";
            filters[7] = "<div class='filter_element untouchable' id='times_8' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 1h</div><div class='filter_element_indicator' id='indicator_times_8'></div></div>";
            filters[8] = "<div class='filter_element untouchable' id='times_9' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 1h 30min</div><div class='filter_element_indicator' id='indicator_times_9'></div></div>";
            filters[9] = "<div class='filter_element untouchable' id='times_10' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 2h</div><div class='filter_element_indicator' id='indicator_times_10'></div></div>";
            filters[10] = "<div class='filter_element untouchable' id='times_11' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 3h</div><div class='filter_element_indicator' id='indicator_times_11'></div></div>";
            break;
        case "characteristics":
            filters[0] = "<div class='filter_element untouchable' id='characteristics_1' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Aštru</div><div class='filter_element_indicator' id='indicator_characteristics_1'></div></div>";
            filters[1] = "<div class='filter_element untouchable' id='characteristics_2' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Rūgštu</div><div class='filter_element_indicator' id='indicator_characteristics_2'></div></div>";
            filters[2] = "<div class='filter_element untouchable' id='characteristics_3' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Sūru</div><div class='filter_element_indicator' id='indicator_characteristics_3'></div></div>";
            filters[3] = "<div class='filter_element untouchable' id='characteristics_4' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Egzotiška</div><div class='filter_element_indicator' id='indicator_characteristics_4'></div></div>";
            filters[4] = "<div class='filter_element untouchable' id='characteristics_5' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Pigu</div><div class='filter_element_indicator' id='indicator_characteristics_5'></div></div>";
            filters[5] = "<div class='filter_element untouchable' id='characteristics_6' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Greita</div><div class='filter_element_indicator' id='indicator_characteristics_6'></div></div>";
            filters[6] = "<div class='filter_element untouchable' id='characteristics_7' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Pikantiška</div><div class='filter_element_indicator' id='indicator_characteristics_7'></div></div>";
            filters[7] = "<div class='filter_element untouchable' id='characteristics_8' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Pusryčiams</div><div class='filter_element_indicator' id='indicator_characteristics_8'></div></div>";
            filters[8] = "<div class='filter_element untouchable' id='characteristics_9' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Skalsu</div><div class='filter_element_indicator' id='indicator_characteristics_9'></div></div>";
            filters[9] = "<div class='filter_element untouchable' id='characteristics_10' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Pietums</div><div class='filter_element_indicator' id='indicator_characteristics_10'></div></div>";
            filters[10] = "<div class='filter_element untouchable' id='characteristics_11' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Vakarienei</div><div class='filter_element_indicator' id='indicator_characteristics_11'></div></div>";
            filters[11] = "<div class='filter_element untouchable' id='characteristics_12' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Švediškam stalui</div><div class='filter_element_indicator' id='indicator_characteristics_12'></div></div>";
            filters[12] = "<div class='filter_element untouchable' id='characteristics_13' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Užkanda prie alaus</div><div class='filter_element_indicator' id='indicator_characteristics_13'></div></div>";
            filters[13] = "<div class='filter_element untouchable' id='characteristics_14' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Vegetariška</div><div class='filter_element_indicator' id='indicator_characteristics_14'></div></div>";
            filters[14] = "<div class='filter_element untouchable' id='characteristics_15' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Veganiška</div><div class='filter_element_indicator' id='indicator_characteristics_15'></div></div>";
            filters[15] = "<div class='filter_element untouchable' id='characteristics_16' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Vaikams</div><div class='filter_element_indicator' id='indicator_characteristics_16'></div></div>";
            filters[16] = "<div class='filter_element untouchable' id='characteristics_17' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Dietinis</div><div class='filter_element_indicator' id='indicator_characteristics_17'></div></div>";
            filters[17] = "<div class='filter_element untouchable' id='characteristics_18' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Gydomasis</div><div class='filter_element_indicator' id='indicator_characteristics_18'></div></div>";
            break;

        case "countries":
            filters[0] = "<div class='filter_element untouchable' id='countries_1' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Lietuva</div><div class='filter_element_indicator' id='indicator_countries_1'></div></div>";
            filters[1] = "<div class='filter_element untouchable' id='countries_2' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Švedija</div><div class='filter_element_indicator' id='indicator_countries_2'></div></div>";
            filters[2] = "<div class='filter_element untouchable' id='countries_3' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>JAV</div><div class='filter_element_indicator' id='indicator_countries_3'></div></div>";
            filters[3] = "<div class='filter_element untouchable' id='countries_4' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Kinija</div><div class='filter_element_indicator' id='indicator_countries_4'></div></div>";
            filters[4] = "<div class='filter_element untouchable' id='countries_5' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Turkija</div><div class='filter_element_indicator' id='indicator_countries_5'></div></div>";
            break;

        case "celebrations":
            filters[0] = "<div class='filter_element untouchable' id='celebrations_1' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Gimtadienis</div><div class='filter_element_indicator' id='indicator_celebrations_1'></div></div>";
            filters[1] = "<div class='filter_element untouchable' id='celebrations_2' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Helauvynas</div><div class='filter_element_indicator' id='indicator_celebrations_2'></div></div>";
            filters[2] = "<div class='filter_element untouchable' id='celebrations_3' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Kalėdos</div><div class='filter_element_indicator' id='indicator_celebrations_3'></div></div>";
            filters[3] = "<div class='filter_element untouchable' id='celebrations_4' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Kūčios</div><div class='filter_element_indicator' id='indicator_celebrations_4'></div></div>";
            filters[4] = "<div class='filter_element untouchable' id='celebrations_5' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Užgavėnės</div><div class='filter_element_indicator' id='indicator_celebrations_5'></div></div>";
            filters[5] = "<div class='filter_element untouchable' id='celebrations_6' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Velykos</div><div class='filter_element_indicator' id='indicator_celebrations_6'></div></div>";
            filters[6] = "<div class='filter_element untouchable' id='celebrations_7' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Vestuvės</div><div class='filter_element_indicator' id='indicator_celebrations_7'></div></div>";
            break;

        case "cooking_methods":
            filters[0] = "<div class='filter_element untouchable' id='cooking_methods_1' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Grilyje</div><div class='filter_element_indicator' id='indicator_cooking_methods_1'></div></div>";
            filters[1] = "<div class='filter_element untouchable' id='cooking_methods_2' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Džiovinti</div><div class='filter_element_indicator' id='indicator_cooking_methods_2'></div></div>";
            filters[2] = "<div class='filter_element untouchable' id='cooking_methods_3' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Garuose</div><div class='filter_element_indicator' id='indicator_cooking_methods_3'></div></div>";
            filters[3] = "<div class='filter_element untouchable' id='cooking_methods_4' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Kepti</div><div class='filter_element_indicator' id='indicator_cooking_methods_4'></div></div>";
            filters[4] = "<div class='filter_element untouchable' id='cooking_methods_5' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Išmaišyti</div><div class='filter_element_indicator' id='indicator_cooking_methods_5'></div></div>";
            filters[5] = "<div class='filter_element untouchable' id='cooking_methods_6' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Marinuoti</div><div class='filter_element_indicator' id='indicator_cooking_methods_6'></div></div>";
            filters[6] = "<div class='filter_element untouchable' id='cooking_methods_7' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Mikrobangėje</div><div class='filter_element_indicator' id='indicator_cooking_methods_7'></div></div>";
            filters[7] = "<div class='filter_element untouchable' id='cooking_methods_8' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Orkaitėje</div><div class='filter_element_indicator' id='indicator_cooking_methods_8'></div></div>";
            filters[8] = "<div class='filter_element untouchable' id='cooking_methods_9' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Rauginti</div><div class='filter_element_indicator' id='indicator_cooking_methods_9'></div></div>";
            filters[9] = "<div class='filter_element untouchable' id='cooking_methods_10' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Išrūkyti</div><div class='filter_element_indicator' id='indicator_cooking_methods_10'></div></div>";
            filters[10] = "<div class='filter_element untouchable' id='cooking_methods_11' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Plakti</div><div class='filter_element_indicator' id='indicator_cooking_methods_11'></div></div>";
            filters[11] = "<div class='filter_element untouchable' id='cooking_methods_12' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Sušaldyti</div><div class='filter_element_indicator' id='indicator_cooking_methods_12'></div></div>";
            filters[12] = "<div class='filter_element untouchable' id='cooking_methods_13' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Ištroškinti</div><div class='filter_element_indicator' id='indicator_cooking_methods_13'></div></div>";
            filters[13] = "<div class='filter_element untouchable' id='cooking_methods_14' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Išvirti</div><div class='filter_element_indicator' id='indicator_cooking_methods_14'></div></div>";
            break;

        case "ingredients_categories":
            filters[0] = "<div class='filter_element untouchable' id='ingredients_category_1' onclick='filter_ingredients_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Žuvis</div></div>";
            filters[1] = "<div class='filter_element untouchable' id='ingredients_category_2' onclick='filter_ingredients_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Mėsa</div></div>";
            filters[2] = "<div class='filter_element untouchable' id='ingredients_category_3' onclick='filter_ingredients_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Pieno produktai</div></div>";
            filters[3] = "<div class='filter_element untouchable' id='ingredients_category_4' onclick='filter_ingredients_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Grūdinė kultūra</div></div>";
            filters[4] = "<div class='filter_element untouchable' id='ingredients_category_5' onclick='filter_ingredients_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Riešutai</div></div>";
            break;
    }

    $("#scroller_filters").fadeOut(transition_time, function(){
        $("#scroller_filters").html('');
        $("#scroller_filters").fadeIn(1);
        show_filters(filters, 0);
    });

    /*
    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        data: { filter_category: category },
        dataType: 'json',
        success:function(data){
            $("#filters_zone").fadeOut(transition_time, function(){
                $("#filters_zone").html(data.filters);
                $("#filters_zone").fadeIn(transition_time);
            });
            $("#config_zone").fadeOut(transition_time, function(){
                $("#config_zone").html(data.config_zone);
                $("#config_zone").fadeIn(transition_time);
            });
        }
    });

    */
}

function filter_ingredients_category(ingredients_category){
    full_sidebar();
    filter_level = 3;
    var filters = [];
    switch(ingredients_category) {
        case "ingredients_category_1":
            filters[0] = "<div class='filter_element untouchable' id='ingredients_1' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/drinks.png');\"></div><div class='filter_element_text'>Lašiša</div><div class='filter_element_indicator' id='indicator_ingredients_1'></div></div>";
            filters[1] = "<div class='filter_element untouchable' id='ingredients_2' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/pastries.png');\"></div><div class='filter_element_text'>Karpis</div><div class='filter_element_indicator' id='indicator_ingredients_2'></div></div>";
            filters[2] = "<div class='filter_element untouchable' id='ingredients_3' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/deserts.png');\"></div><div class='filter_element_text'>Upėtakis</div><div class='filter_element_indicator' id='indicator_ingredients_3'></div></div>";
            filters[3] = "<div class='filter_element untouchable' id='ingredients_4' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/second_dishes.png');\"></div><div class='filter_element_text'>Kardžuvė</div><div class='filter_element_indicator' id='indicator_ingredients_4'></div></div>";
            filters[4] = "<div class='filter_element untouchable' id='ingredients_5' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/canned_meals.png');\"></div><div class='filter_element_text'>Ungurys</div><div class='filter_element_indicator' id='indicator_ingredients_5'></div></div>";
        break;
    }

    $("#scroller_filters").fadeOut(transition_time, function(){
        $("#scroller_filters").html('');
        $("#scroller_filters").fadeIn(1);
        show_filters(filters, 0);
    });
}


function check_if_user_is_loged(){
    FB.getLoginStatus(function(response) {
        if (response.status == 'connected') {
            // the user is logged in and has authenticated your
            // app, and response.authResponse supplies
            // the user's ID, a valid access token, a signed
            // request, and the time the access token
            // and signed request each expire
            //var uid = response.authResponse.userID;
            //var accessToken = response.authResponse.accessToken;
            user_login_status = true;
        } else if (response.status == 'not_authorized') {
            // the user is logged in to Facebook,
            // but has not authenticated your app
            user_login_status = false;
        } else {
            // the user isn't logged in to Facebook.
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
}

function show_loading_screen(){
    $("#loading_screen").fadeIn(transition_time * 2);
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
            filter_show_selected();
            show_config_zone(0);
            break;
        case 1:
            filter_start();
            break;
        case 2:
            filter_category('ingredients_categories');
            break;
    }
}

function show_config_zone(state){
    if(state == 0){
        var config_zone =
            "<div class='filter_element untouchable' onclick=\"filter_start();show_config_zone(1)\">" +
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

function filter_show_selected(){
    //show selected filters
    filter_level = 0;
    var filters = [];

    filters[0] = "<div class='filter_element untouchable filter_element_indicator_not_want' id='universities-1' onclick='filter_selected(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/types.png');\"></div><div class='filter_element_text'>Selected 1</div><div class='filter_element_delete' id='delete_universities-1' onclick='filter_delete(this.id)'></div><div class='filter_element_indicator_change' id='indicator_change_universities-1' onclick='filter_indicator_change(this.id)'></div><div class='filter_element_indicator_small'></div></div>";
    filters[1] = "<div class='filter_element untouchable filter_element_indicator_want' id='universities-2' onclick='filter_selected(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/times.png');\"></div><div class='filter_element_text'>Selected want</div><div class='filter_element_delete' id='delete_universities-2' onclick='filter_delete(this.id)'></div><div class='filter_element_indicator_change' id='indicator_change_universities-2' onclick='filter_indicator_change(this.id)'></div><div class='filter_element_indicator_small'></div></div>";
    filters[2] = "<div class='filter_element untouchable filter_element_indicator_not_want' id='universities-3' onclick='filter_selected(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/celebrations.png');\"></div><div class='filter_element_text'>Selected 3</div><div class='filter_element_delete' id='delete_universities-3' onclick='filter_delete(this.id)'></div><div class='filter_element_indicator_change' id='indicator_change_universities-3' onclick='filter_indicator_change(this.id)'></div><div class='filter_element_indicator_small'></div></div>";

    $("#scroller_filters").fadeOut(transition_time, function(){
        $("#scroller_filters").html('');
        $("#scroller_filters").fadeIn(1);
        show_filters(filters, 0);
    });
}

function filter_indicator_change(ID){
    var ID = ID.replace('indicator_change_','');

    if($("#" + ID).hasClass('filter_element_indicator_not_want')){
        $('#' + ID).removeClass('filter_element_indicator_not_want').addClass('filter_element_indicator_want');
    }else if($("#" + ID).hasClass('filter_element_indicator_want')){
        $('#' + ID).removeClass('filter_element_indicator_want').addClass('filter_element_indicator_not_want');
    }
}

function manipulate_filter(ID){
    full_sidebar();
    var new_indicator_status;
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

    //send new_indicator_status and filter_ID
    /*
    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        dataType: 'json',
        data: { filter_manipulate: ID },
        success:function(data){
            if(data.status == "removed"){
                $("#indicator_" + ID).removeClass('added');
            }else if(data.status == "added"){
                $("#indicator_" + ID).addClass('added');
            }
            append_recipes();
        }
    });
    */
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

    //ajax to add to shoopinglist
}

var shoppinglist_items_ids = 1;
function shoppinglist_add_enter(){
    var id = shoppinglist_items_ids++;
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
    //ajax to add to shoopinglist
}


function shoppinglist_delete(ID){
    ID = ID.replace('delete_','');
    $('#' + ID).remove();
    setTimeout(function(){
        scroll_filters.refresh();
    }, 100);

    /*
     $.ajax({
     type: 'POST',
     url: 'ajax.php',
     data: { filter_delete: ID },
     beforeSend:function(){
     },
     success:function(data){
     $('#' + ID).remove();
     append_recipes();
     }
     });
     */
}

function filter_search_add(ID, type){
    var id = ID.replace('search-','');
    var image = $('#' + ID + " .search_item_image").css('background-image');
    image = image.replace('"', "'");
    var title = $('#' + ID + " .search_item_title").html();
    $("#search_input").val('');
    input_blur();
    input_focus('search');

    //send with ajax to filters
    //see which filters level, if = 0, add to panel
    if(filter_level == 0){
        var filters = [];
        var data = "<div class='filter_element untouchable filter_element_indicator_" + type + "' id='" + id + "' onclick='filter_selected(this.id)'><div class='filter_element_image' style=\"background-image:" + image + ";\"></div><div class='filter_element_text'>" + title + "</div><div class='filter_element_delete' id='delete_" + id + "' onclick='filter_delete(this.id)'></div><div class='filter_element_indicator_change' id='indicator_change_" + id + "' onclick='filter_indicator_change(this.id)'></div><div class='filter_element_indicator_small'></div></div>";
        filters[0] = data;
        show_filters(filters, 0);

        setTimeout(function(){scroll_filters.refresh()}, 0);
    }

    /*
    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        dataType: 'json',
        data: { filter_search_add: ID },
        success:function(data){
            append_recipes();
            $("#search_input").val('');
            $("#search_container").html('');
            $("#search_container").css('display','none');
            if(data.filter_level == 0)
                $("#scroller_filters").append(data.filter);
        }
    });

    */
}



function filter_delete(ID){
    ID = ID.replace('delete_','');
    $('#' + ID).remove();
    setTimeout(function(){
        scroll_filters.refresh();
    }, 100);
    /*
    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        data: { filter_delete: ID },
        beforeSend:function(){
        },
        success:function(data){
            $('#' + ID).remove();
            append_recipes();
        }
    });
    */
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
        var data = [];

        /*
         $.ajax({
         type: 'POST',
         url: 'ajax.php',
         dataType: 'json',
         data: { search: value },
         success:function(data){
         $("#search_container").html('');
         if(data.search_results.length > 0){
         $("#search_container").css('display','block');
         }else{
         $("#search_container").css('display','none');
         }

         for(i = 0; i < data.search_results.length; i++){
         $("#search_container").append(data.search_results[i]);
         }
         }
         });

         */

        switch(type){
            case "search":
                //get data with ajax from search_value
                for(i = 0; i < 7; i++){
                    data[i] =
                    "<div class='s_e search_item untouchable' id='search-ingredient-95'>" +
                        "<div class='s_e search_item_image' style=\"background-image:url('images/food (2).jpg')\"></div>" +
                        "<div class='s_e search_item_title'>Ananasas</div>" +
                        "<div class='s_e search_item_bottom_info'>Ingredientas</div>" +
                        "<div class='s_e filter_element_indicator indicator_search want' style='right: 25px;' onclick=\"filter_search_add('search-ingredient-95','want')\"></div>" +
                        "<div class='s_e filter_element_indicator indicator_search not_want' style='right: 3px;' onclick=\"filter_search_add('search-ingredient-95','not_want')\"></div>" +
                    "</div>";
                }
                break;

            case "shoppinglist":
                //get data with ajax from search_value
                for(i = 0; i < 7; i++){
                    data[i] =
                    "<div class='s_e search_item untouchable' id='shoppinglist-ingredient-95' onclick='shoppinglist_add(this.id)'>"+
                        "<div class='s_e search_item_image' style=\"background-image:url('images/food (2).jpg')\"></div>"+
                        "<div class='s_e search_item_title'>Ananasas</div>"+
                        "<div class='s_e search_item_bottom_info'>Ingredientas</div>"+
                    "</div>";
                }
                break;

            case "places":
                //get data with ajax from search_value
                for(i = 0; i < 7; i++){
                    data[i] =
                        "<div class='s_e search_item untouchable' id='search-ingredient-95'>" +
                        "<div class='s_e search_item_image' style=\"background-image:url('images/food (2).jpg')\"></div>" +
                        "<div class='s_e search_item_title'>Ananasasadasdasdasdasdasd asdasds</div>" +
                        "<div class='s_e search_item_bottom_info'>Ingredientas</div>" +
                        "<div class='s_e filter_element_indicator indicator_search want' style='right: 25px;' onclick=\"filter_search_add('search-ingredient-95','want')\"></div>" +
                        "<div class='s_e filter_element_indicator indicator_search not_want' style='right: 3px;' onclick=\"filter_search_add('search-ingredient-95','not_want')\"></div>" +
                        "</div>";
                }
                break;
        }

        for(i = 0; i < data.length; i++){
            $("#search_container_inside").append(data[i]);
        }
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
            $("#sidebar_right").removeClass('right_squeeze').addClass('right_full');
            $('.recipe_box').removeClass('recipe_active');
            $("#recipe_" + recipe_ID).addClass('recipe_active');
            scroll_sidebar_right.refresh();
            scroll_sidebar_right.scrollTo(0,0);

            //from ajax with recipe ID get
            var image;
            var title;
            var country;
            var time;
            var rating;
            var main_cooking_method;
            var type;
            var characteristics; //array of them
            var celebration; //array of them or empty
            var ingredients; //array of them

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
    location.href = "/cook/" + recipe_ID;

    //send ajax can keep track of time spent on cooking. starting time
}



//tracks down mouse click
$(document).mousedown(function(event){
    if($(event.target).attr("id") == "search_container" || ( typeof $(event.target).attr("class") !== "undefined" && $(event.target).hasClass('s_e'))){
        //alert($(event.target).attr("id"));
        //$('#search_input').focus();
        //event.stopImmediatePropagation();
        //&& $("#search_input").is(":focus")
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
    $("#search_zone").addClass('unactive_search_zone');
    $('#search_container_inside').html('');
    $('#search_container').css('display','none');
}

function ingredient_selected(ingredient_ID){
    if(check_if_user_is_loged()){
        var classes = ($("#ingredient_indicator-" + ingredient_ID).attr('class')).split(" ");
        var indicator = classes[1];
        if(indicator == "ingredient_indicator_undefined"){
            $("#ingredient_indicator-" + ingredient_ID).removeClass('ingredient_indicator_undefined').addClass('ingredient_indicator_shoppinglist');
            //ajax to add to shoping list
        }else if(indicator == "ingredient_indicator_shoppinglist"){
            $("#ingredient_indicator-" + ingredient_ID).removeClass('ingredient_indicator_shoppinglist').addClass('ingredient_indicator_have');
            //ajax to remove from shoping list
        }else if(indicator == "ingredient_indicator_have"){
            $("#ingredient_indicator-" + ingredient_ID).removeClass('ingredient_indicator_have').addClass('ingredient_indicator_undefined');
        }
    }else{
        show_top_layer('account');
    }
}

function add_to_shopping_list(recipe_ID){
    if(check_if_user_is_loged()){
        $('.ingredient_indicator').removeClass('ingredient_indicator_have').removeClass('ingredient_indicator_undefined').removeClass('ingredient_indicator_shoppinglist').addClass('ingredient_indicator_shoppinglist');
        //ajax add all products of recipe to shopping list
        toast('Produktai sudėti į pirkinių krepšį','good', 'shoppinglist');
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
        $("#header_map_buttons_zone_locker").css('display','block');
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
        $("#header_map_buttons_zone_locker").css('display','none');
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
    //var height_from_top = $(".middle_divider").offset().top;
    //$("#filters_zone").css('top', height_from_top + 'px');
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
    FB.login(function(response) {
        if (response.authResponse) {
            show_loading_screen();
            location.href = location.href;
        } else {
            toast('Įvyko klaida. Bandykite dar kartą','bad', 'login');
        }
    }, {scope: 'publish_actions, email, public_profile, user_friends'});
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

//likinti = patinka ir ysiminti
function recipe_like(recipe_ID, box_ID){

    if(check_if_user_is_loged()){
        //ajax to change status and get new status
        var like_status = true;

        if(like_status){
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
            //ajax to add comment
            squzee_comment_box();
            toast('Atsiliepimas įrašytas','good','write');
        }else{
            toast('Įrašykite ką nors','bad','write');
        }

    }else{
        show_top_layer('account');
    }
}

function squzee_comment_box(){
    $('.step_comment_box_comments').animate({bottom: "50%", top: "50%"}, transition_time * 2,function(){
        $(".step_comment_box_comments").html("<div id='step_comment_title'>Ačiū</div>");
        $('.step_comment_box_comments').animate({height: "52px", marginTop: "-26px"}, transition_time);
    });
}

function logout(){
    FB.logout(function(response) {
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