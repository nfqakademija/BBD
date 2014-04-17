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
var user_is_loged = false;

function toast(text, status){
    clearTimeout(toast_timer);
    $("#toast").html(text);
    $("#toast_wrapper").css('height','50px');

    if(status == "good")
        $("#toast_wrapper").css('background-color','rgba(43, 190, 43, 0.95)');
    else if(status == "bad")
        $("#toast_wrapper").css('background-color','rgba(175, 25, 25, 0.95)');

    toast_timer = setTimeout(function(){
        $("#toast_wrapper").css('height','0px');
    },toast_show_time);
}
function append_recipes_to_profile(){
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


    //info about profile recipes
    $("#profile_recipes").append("<div class='recipe_box untouchable' id='profile_box' style=\"line-height:" + recipe_size + "px;width:" + recipe_size + "px;height:" + recipe_size + "px;\">Vėliau</div>");
    for(i = 0; i < 4; i++){
        var data = recipes[i];
        var id = data[0];
        var image = data[1];
        var title = data[2];
        var appendable_data = "<div class='recipe_box' id='recipe_" + id + "' style=\"background-image: url('" + image + "');width:" + recipe_size + "px;height:" + recipe_size +  "px;\" onclick=\"show_recipe('" + id + "')\"></div>";
        $("#profile_recipes").append(appendable_data);
    }

    $("#profile_recipes").append("<div class='recipe_box untouchable' id='profile_box' style=\"line-height:" + recipe_size + "px;width:" + recipe_size + "px;height:" + recipe_size + "px;\">Gaminta</div>");
    for(i = 5; i < 9; i++){
        var data = recipes[i];
        var id = data[0];
        var image = data[1];
        var title = data[2];
        var appendable_data = "<div class='recipe_box' id='recipe_" + id + "' style=\"background-image: url('" + image + "');width:" + recipe_size + "px;height:" + recipe_size +  "px;\" onclick=\"show_recipe('" + id + "')\"></div>";
        $("#profile_recipes").append(appendable_data);
    }

    $("#profile_recipes").append("<div class='recipe_box untouchable' id='profile_box' style=\"line-height:" + recipe_size + "px;width:" + recipe_size + "px;height:" + recipe_size + "px;\">Patinka</div>");
    for(i = 9; i < 13; i++){
        var data = recipes[i];
        var id = data[0];
        var image = data[1];
        var title = data[2];
        var appendable_data = "<div class='recipe_box' id='recipe_" + id + "' style=\"background-image: url('" + image + "');width:" + recipe_size + "px;height:" + recipe_size +  "px;\" onclick=\"show_recipe('" + id + "')\"></div>";
        $("#profile_recipes").append(appendable_data);
    }

    $("#profile_recipes").append("<div class='recipe_box untouchable' id='profile_box' style=\"line-height:" + recipe_size + "px;width:" + recipe_size + "px;height:" + recipe_size + "px;\">Peržiūrėta</div>");
    for(i = 14; i < 17; i++){
        var data = recipes[i];
        var id = data[0];
        var image = data[1];
        var title = data[2];
        var appendable_data = "<div class='recipe_box' id='recipe_" + id + "' style=\"background-image: url('" + image + "');width:" + recipe_size + "px;height:" + recipe_size +  "px;\" onclick=\"show_recipe('" + id + "')\"></div>";
        $("#profile_recipes").append(appendable_data);
    }

    $("#profile_recipes").append("<div class='recipe_box untouchable' id='profile_box' style=\"line-height:" + recipe_size + "px;width:" + recipe_size + "px;height:" + recipe_size + "px;\">Tavo sukurti</div>");
    for(i = 17; i < 20; i++){
        var data = recipes[i];
        var id = data[0];
        var image = data[1];
        var title = data[2];
        var appendable_data = "<div class='recipe_box' id='recipe_" + id + "' style=\"background-image: url('" + image + "');width:" + recipe_size + "px;height:" + recipe_size +  "px;\" onclick=\"show_recipe('" + id + "')\"></div>";
        $("#profile_recipes").append(appendable_data);
    }
}


function append_recipes(){
    $("#content_wrapper").html('');

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

    var appendable_data = "<div class='recipe_box' id='recipe_" + id + "' style=\"background-image: url('" + image + "');width:" + recipe_size + "px;height:" + recipe_size +  "px;\" onclick=\"show_recipe('" + id + "')\"></div>";

    $("#content_wrapper").append(appendable_data);
}

function to_very_top(){
    $("html, body").animate({scrollTop: 0}, scroll_animation_time);
}

function to_very_bottom(){
    $("html, body").animate({scrollTop: $(document).height()}, scroll_animation_time);
}


$(window).scroll(function(){
    scrolled = $(document).scrollTop();
    if(scrolled > 800)
        toast_top('show');
    else
        toast_top('hide');
});

function getDocHeight(){
    return Math.max(
        Math.max(document.body.scrollHeight, document.documentElement.scrollHeight),
        Math.max(document.body.offsetHeight, document.documentElement.offsetHeight),
        Math.max(document.body.clientHeight, document.documentElement.clientHeight)
    );
}

function toast_top(display){
    if(display == "show")
        $("#toast_top").fadeIn(transition_time * 2);
    else if(display == "hide")
        $("#toast_top").fadeOut(transition_time * 2);
}

function show_loading(){
    $("#toast_loading").fadeIn(transition_time * 2);
}

function hide_loading(){
    $("#toast_loading").fadeOut(transition_time * 2);
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
        agent = 'IE';
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
    }
}

function show_filters(array_of_filters, index){
    $("#filters_zone").append('<div style="display:block;margin-left:210px;" id="container_appender">' + array_of_filters[index] + '</div>');
    $("#container_appender").animate({marginLeft: 0}, transition_time);
    $("#container_appender").fadeIn(transition_time);
    $("#container_appender").attr('id','container_appender_out');
    index++;
    if(index <= array_of_filters.length - 1){
        setTimeout(function(){
            show_filters(array_of_filters, index);
        },transition_time / 100);
    }
}

function filter_start(){
    full_sidebar()
    var filters = [];
    filters[0] = "<div class='filter_element untouchable' id='types' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/types.png');\"></div><div class='filter_element_text'>Tipai</div></div>";
    filters[1] = "<div class='filter_element untouchable' id='characteristics' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/characteristics.png');\"></div><div class='filter_element_text'>Ypatybės</div></div>";
    filters[2] = "<div class='filter_element untouchable' id='times' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/times.png');\"></div><div class='filter_element_text'>Laikai</div></div>";
    filters[3] = "<div class='filter_element untouchable' id='countries' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/countries.png');\"></div><div class='filter_element_text'>Šalys</div></div>";
    filters[4] = "<div class='filter_element untouchable' id='ingredients' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/ingredients.png');\"></div><div class='filter_element_text'>Ingredientai</div></div>";
    filters[5] = "<div class='filter_element untouchable' id='celebrations' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/celebrations.png');\"></div><div class='filter_element_text'>Šventės</div></div>";
    filters[6] = "<div class='filter_element untouchable' id='cooking_methods' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/cooking_methods.png');\"></div><div class='filter_element_text'>Gaminimo būdai</div></div>";

    var config_zone = "<div class='filter_element_go_back untouchable'><div class='go_back untouchable' onclick=\"filter_go_back('all')\"><<</div><div class='go_back untouchable' onclick=\"filter_go_back('one')\"><</div></div>";

    $("#filters_zone").fadeOut(transition_time, function(){
        $("#filters_zone").html('');
        $("#filters_zone").fadeIn(1);
        show_filters(filters, 0);
    });

    $("#config_zone").fadeOut(transition_time, function(){
        $("#config_zone").html(config_zone);
        $("#config_zone").fadeIn(transition_time);
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
    full_sidebar()
    switch(category){
        case "types":
            var filters = [];
            filters[0] = "<div class='filter_element untouchable' id='drinks' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/drinks.png');\"></div><div class='filter_element_text'>Gėrimai</div></div>";
            filters[1] = "<div class='filter_element untouchable' id='pastries' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/pastries.png');\"></div><div class='filter_element_text'>Kepiniai</div></div>";
            filters[2] = "<div class='filter_element untouchable' id='deserts' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/deserts.png');\"></div><div class='filter_element_text'>Desertai</div></div>";
            filters[3] = "<div class='filter_element untouchable' id='second_dishes' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/second_dishes.png');\"></div><div class='filter_element_text'>Antrieji patiekalai</div></div>";
            filters[4] = "<div class='filter_element untouchable' id='canned_meals' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/canned_meals.png');\"></div><div class='filter_element_text'>Konservuoti patiekalai</div></div>";
            filters[5] = "<div class='filter_element untouchable' id='porridges' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/porridges.png');\"></div><div class='filter_element_text'>Košės</div></div>";
            filters[6] = "<div class='filter_element untouchable' id='salads' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('images/salads.png');\"></div><div class='filter_element_text'>Salotos</div></div>";
            filters[7] = "<div class='filter_element untouchable' id='soups' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/soups.png');\"></div><div class='filter_element_text'>Sriubos</div></div>";
            filters[8] = "<div class='filter_element untouchable' id='sandwitches' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/sandwitches.png');\"></div><div class='filter_element_text'>Sumuštiniai</div></div>";
            filters[9] = "<div class='filter_element untouchable' id='stews' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/stews.png');\"></div><div class='filter_element_text'>Troškiniai</div></div>";
            filters[10] = "<div class='filter_element untouchable' id='jams' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/jams.png');\"></div><div class='filter_element_text'>Uogienės</div></div>";
            filters[11] = "<div class='filter_element untouchable' id='snacks' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/snacks.png');\"></div><div class='filter_element_text'>Užkandžiai</div></div>";
            filters[12] = "<div class='filter_element untouchable' id='sauces' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/sauces.png');\"></div><div class='filter_element_text'>Padažai</div></div>";
            break;
        case "times":

            var filters = [];
            filters[0] = "<div class='filter_element untouchable' id='time_5' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 5min</div><div class='filter_element_indicator' id='indicator_time_5'></div></div>";
            filters[1] = "<div class='filter_element untouchable' id='time_10' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 10min</div><div class='filter_element_indicator' id='indicator_time_10'></div></div>";
            filters[2] = "<div class='filter_element untouchable' id='time_15' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 15min</div><div class='filter_element_indicator' id='indicator_time_15'></div></div>";
            filters[3] = "<div class='filter_element untouchable' id='time_20' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 20min</div><div class='filter_element_indicator' id='indicator_time_20'></div></div>";
            filters[4] = "<div class='filter_element untouchable' id='time_25' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 25min</div><div class='filter_element_indicator' id='indicator_time_25'></div></div>";
            filters[5] = "<div class='filter_element untouchable' id='time_30' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 30min</div><div class='filter_element_indicator' id='indicator_time_30'></div></div>";
            filters[6] = "<div class='filter_element untouchable' id='time_45' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 45min</div><div class='filter_element_indicator' id='indicator_time_45'></div></div>";
            filters[7] = "<div class='filter_element untouchable' id='time_60' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 1h</div><div class='filter_element_indicator' id='indicator_time_60'></div></div>";
            filters[8] = "<div class='filter_element untouchable' id='time_90' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 1h 30min</div><div class='filter_element_indicator' id='indicator_time_90'></div></div>";
            filters[9] = "<div class='filter_element untouchable' id='time_120' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 2h</div><div class='filter_element_indicator' id='indicator_time_120'></div></div>";
            filters[10] = "<div class='filter_element untouchable' id='time_180' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Iki 3h</div><div class='filter_element_indicator' id='indicator_time_180'></div></div>";
            break;

    }

    $("#filters_zone").fadeOut(transition_time, function(){
        $("#filters_zone").html('');
        $("#filters_zone").fadeIn(1);
        show_filters(filters, 0);
    });

    var config_zone = "<div class='filter_element_go_back untouchable'><div class='go_back untouchable' onclick=\"filter_go_back('all')\"><<</div><div class='go_back untouchable' onclick=\"filter_go_back('one')\"><</div></div>";
    $("#config_zone").fadeOut(transition_time, function(){
        $("#config_zone").html(config_zone);
        $("#config_zone").fadeIn(transition_time);
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

function content_navigation(type){

    switch(type){
        case "home":
            $('.nav_zone_element').removeClass('nav_element_active');
            $("#" + type).addClass('nav_element_active');
            location.href = "/";
            break;
        case "profile":

            //ajax to check if user is logged in
            user_is_loged = false;

            if(user_is_loged){
                $('.nav_zone_element').removeClass('nav_element_active');
                $("#" + type).addClass('nav_element_active');
                location.href = "/profile";
            }else{
                show_top_layer_account();
            }

            break;

        case "shoppinglist":
            //ajax to check if user is logged in
            user_is_loged = false;

            if(user_is_loged){
                $('.nav_zone_element').removeClass('nav_element_active');
                $("#" + type).addClass('nav_element_active');
                location.href = "/shoppinglist";
            }else{
                show_top_layer_account();
            }
            break;

        case "random":
            $('.nav_zone_element').removeClass('nav_element_active');
            $("#" + type).addClass('nav_element_active');
            location.href = "/random";
            break;

        default:
            $('.nav_zone_element').removeClass('nav_element_active');
            $("#" + type).addClass('nav_element_active');
            location.href = "/";
            break;
    }
}

function show_top_layer_account(){
    $("#top_layer").fadeIn(transition_time * 2);
    $(function(){
        $('.top_layer_item').click(function(event){
            if(event.target.id == 'top_layer'){
                hide_top_layer();
            }
        });
    });
}

function hide_top_layer(){
    $("#top_layer").fadeOut(transition_time * 2);
}








function go_to_new_recipe(){
    location.href= "/new";
}

function filter_go_back(type){
    full_sidebar();
    var config_zone =
        "<div class='filter_element untouchable' onclick='filter_start()'>" +
        "<div class='filter_element_image' id='add'></div>" +
        "<div class='filter_element_text'>Pridėti filtrą</div>" +
        "</div>";

        $("#filters_zone").fadeOut(transition_time, function(){
            $("#filters_zone").html('');
            $("#filters_zone").fadeIn(transition_time);
        });
        $("#config_zone").fadeOut(transition_time, function(){
            $("#config_zone").html(config_zone);
            $("#config_zone").fadeIn(transition_time);
        });

    /*
     $.ajax({
     type: 'POST',
     url: 'ajax.php',
     dataType: 'json',
     data: { filter_back_type: type },
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

function manipulate_filter(ID){
    full_sidebar();
    var classes = ($("#indicator_" + ID).attr('class')).split(" ");
    var selected = classes[1];
    if(selected == "added"){
        $("#indicator_" + ID).removeClass('added');
    }else{
        $("#indicator_" + ID).addClass('added');
    }
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

function filter_search_add(ID){

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
                $("#filters_zone").append(data.filter);
        }
    });

    */
}



function filter_delete(ID){
    ID = ID.replace('delete_','');
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
}

function filter_selected(ID){
    full_sidebar();
    var classes = ($("#" + ID).attr('class')).split(" ");
    var selected = classes[2];
    if(selected == "selected"){
        $("#" + ID).removeClass('selected');
    }else{
        $("#" + ID).addClass('selected');
    }
}


function search(){
    var value = ($('#search_input').val()).trim();
    value = value.replace(/[-\/\\^$*+?.,()|[\]{}]/g, ' ');
    $('#search_container').css('display','block');

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
}

function focus_input(ID){
    full_sidebar();
    $('#' + ID).focus();
}

function last_index(){
    path = $(location).attr('href');
    path = path.substring(path.lastIndexOf("/")+ 1);
    return (path.match(/[^.]+(\.[^?#]+)?/) || [])[0];
}

function show_recipe(recipe_ID){
    var classes = ($("#recipe_" + recipe_ID).attr('class')).split(" ");
    var selected = classes[1];
    if(selected == "recipe_active"){
        hide_recipe();
    }else{
        $("#sidebar_right").removeClass('right_squeeze').addClass('right_full');
        $('.recipe_box').removeClass('recipe_active');
        $("#recipe_" + recipe_ID).addClass('recipe_active');
        //$("#content_wrapper").css('right','231px');


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
    }

    recalculate_width();
    if(mobile_state){
        empty_sidebar();
    }

}

function show_random_recipe_info(recipe_ID){
    var classes = ($("#sidebar_right").attr('class')).split(" ");
    var selected = classes[0];
    if(selected == "right_full"){
        hide_random_recipe_info();
    }else{
        $("#sidebar_right").removeClass('right_squeeze').addClass('right_full');
    }
}

function hide_random_recipe_info(){
    $("#sidebar_right").removeClass('right_full').addClass('right_squeeze');
}

function hide_recipe(){
    $("#sidebar_right").removeClass('right_full').addClass('right_squeeze');
    $('.recipe_box').removeClass('recipe_active');
    //$("#content_wrapper").css('right','0px');
}



function cook(recipe_ID){
    location.href = "/cook/" + recipe_ID + "/1";

    //send ajax can keep track of time spent on cooking. starting time
}

function cook_step(recipe_ID, step_ID){
    location.href = "/cook/" + recipe_ID + "/" + step_ID;

    //send ajax can keep track of time spent on this step cooking.
}

function remember_recipe(recipe_ID){
    var classes = ($("#remember_" + recipe_ID).attr('class')).split(" ");
    var selected = classes[3];
    if(selected == "remembered"){
        $("#remember_" + recipe_ID).removeClass('remembered');
        $("#remember_" + recipe_ID).html('Įsiminti');
    }else{
        $("#remember_" + recipe_ID).addClass('remembered');
        $("#remember_" + recipe_ID).html('Įsiminta');
    }

    //send to server profile that recipe is remebered ajax
}


function search_input_focus(){
    if(!$("#search_input").is(":focus")){
        $("#search_zone").removeClass('unactive_search_zone');
        $("#search_zone").addClass('active_search_zone');
        full_sidebar();
    }
}

function search_input_blur(){
    $("#search_zone").removeClass('active_search_zone');
    $("#search_zone").addClass('unactive_search_zone');
    $('#search_container').html('');
    $('#search_container').css('display','none');
}

function shoppinglist_input_focus(){
    if(!$("#shoppinglist_input").is(":focus")){
        $("#search_zone").removeClass('unactive_search_zone');
        $("#search_zone").addClass('active_search_zone');
        full_sidebar();
    }
}

function shoppinglist_input_blur(){
    $("#search_zone").removeClass('active_search_zone');
    $("#search_zone").addClass('unactive_search_zone');
    $('#search_container').html('');
    $('#search_container').css('display','none');
}


function ingredient_selected(ingredient_ID){
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
}

function add_to_shopping_list(recipe_ID){
    $('.ingredient_indicator').removeClass('ingredient_indicator_have').removeClass('ingredient_indicator_undefined').removeClass('ingredient_indicator_shoppinglist').addClass('ingredient_indicator_shoppinglist');
    //ajax add all products of recipe to shopping list
}



function shoppinglist_search(){
    $('#search_container').css('display','block');
}

function coop(recipe_ID){
    //use facebook API to share on wall to cook together with missing ingredients

}

function random_next(){
    location.href = "/random";
}



//RESPONSIVE JAVASCRIPT

function calculate_recipe_size(){
    //$(window).height();   // returns height of browser viewport
    //$(document).height(); // returns height of HTML document
    //$(window).width();   // returns width of browser viewport
    //$(document).width(); // returns width of HTML document
    //screen.height;
    //screen.width;

    var content_width = parseInt(($("#content_wrapper").css('width')).replace("px", ""));
    var size_per_item = content_width / 4;
    if(size_per_item < minimum_recipe_size){
        size_per_item = content_width;
    }
    return size_per_item;

}

function recalculate_width(){
    var content_width = parseInt(($("#content_wrapper").css('width')).replace("px", ""));
    var size_per_item = content_width / 4;
    if(size_per_item < minimum_recipe_size){
        size_per_item = content_width;
        $(".recipe_box").css("font-size","30px");
        $("#profile_divider").css("font-size","16px");
    }else{
        $(".recipe_box").css("font-size","");
        $("#profile_divider").css("font-size","");
    }

    $(".recipe_box").css('width', size_per_item + "px");
    $(".recipe_box").css('height', size_per_item + "px");
    $(".recipe_box").css('line-height', size_per_item + "px");
}





function sidebar_manipulation(){
    var screen_width = $(window).width();
    if(screen_width <= 360){
        mobile_state = true;
        $('#header').css('display','block');
        $('#content_wrapper').css('top','41px');
        empty_sidebar();
    }else{
        mobile_state = false;
        $('#header').css('display','none');
        $('#content_wrapper').css('top','0px');
        full_sidebar();
    }
}

function empty_sidebar_slide(){
    var sidebar_class = ($("#sidebar").attr('class'));
    if(sidebar_class == "full"){
        $("#sidebar").removeClass('full').removeClass('empty').removeClass('squeeze').addClass('empty');
        $("#content_wrapper").css('left','1px');
        $("#header").css('left','1px');
        $("#sidebar_slider").css('display','block');
        $("#header_logo").css('display','block');
        $("#config_zone").css('display','none');
    }else if(sidebar_class == "empty"){
        $("#sidebar").removeClass('full').removeClass('empty').removeClass('squeeze').addClass('full');
        $("#content_wrapper").css('left','231px');
        $("#header").css('left','231px');
        $("#sidebar_slider").css('display','none');
        $("#header_logo").css('display','none');
        $("#config_zone").css('display','block');
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

    if(!mobile_state){
        $("#sidebar_slider").css('display','block');
        recalculate_width();
    }
}

function squeeze_sidebar(){
    $("#sidebar").removeClass('full').removeClass('empty').addClass('squeeze');
    $("#content_wrapper").css('left','66px');
    $("#header").css('left','66px');
    $("#sidebar_slider").css('display','none');
    $("#config_zone").css('display','block');
    if(!mobile_state){
        recalculate_width();
    }
}

function empty_sidebar(){
    $("#sidebar").removeClass('full').removeClass('squeeze').addClass('empty');
    $("#content_wrapper").css('left','1px');
    $("#header").css('left','1px');
    $("#header_logo").css('display','block');
    $("#sidebar_slider").css('display','none');
    $("#config_zone").css('display','none');
    recalculate_width();
}

function facebook_login(){

}
