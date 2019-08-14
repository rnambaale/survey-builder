(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/app"],{

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
__webpack_require__(/*! ./bootstrap */ "./resources/js/bootstrap.js");

$(".remote-modal").on("show.bs.modal", function (e) {
  $(this).find(".modal-content").load(e.relatedTarget.href);
});
$(document).on("change", ".question select.question_type", function (e) {
  //console.log($(this).parent());
  //console.log($(this).val());
  var question_type = $(this).val();
  var question = $(this).data("question");
  console.log(question);
  $("#choices_container_".concat(question)).hide();

  switch (question_type) {
    case "checkbox":
      $("#choices_container_".concat(question)).show();
      break;

    case "radio":
      $("#choices_container_".concat(question)).show();
      break;

    default:
      break;
  }
});
$(document).on("click", ".delete-question", function (e) {
  e.preventDefault();
  var survey = $(this).data("survey");
  var question = $(this).data("question");
  $.ajax({
    url: "/api/surveys/".concat(survey, "/questions/").concat(question),
    type: "DELETE",
    data: {},
    datatype: "json",
    success: function success(data) {
      console.log(data);
      $(".questions-container #question_".concat(data.question_ID)).remove();
    },
    error: function error(data) {
      console.log(data);
    }
  });
});
$(document).on("click", ".add-question", function (e) {
  e.preventDefault();
  $(this).attr("disabled", "disabled");
  var survey = $(this).data("survey");
  $.ajax({
    url: "/api/surveys/".concat(survey, "/questions"),
    type: "POST",
    data: {
      survey: survey,
      question_text: ""
    },
    datatype: "json",
    success: function success(data) {
      console.log(data);
      $(".add-question").removeAttr("disabled");
      $(".questions-container").append("                <div class=\"question\" id=\"question_".concat(data.id, "\" data-question=\"").concat(data.id, "\">                    <input\n                        type=\"hidden\"                        name=\"questions[").concat(data.id, "][ID]\"                        value=\"").concat(data.id, "\" />\n                    <h4 class=\"clearfix\">\n                        <span class=\"float-left\">Question ").concat(data.question_order, "</span>                        <span class=\"float-right\">                            <a                                href=\"#\"                                data-question=\"").concat(data.id, "\"                                data-survey=\"").concat(survey, "\"                                data-indicator=\"\"                                class=\"btn btn-danger btn-sm delete-question\"                            >Delete Question</a>                        </span>                    </h4>\n                    <div class=\"form-group row\">                        <label class=\"col-md-2 control-label\">Question Type</label>                        <div class=\"col-md-4\">                            <select                                name=\"questions[").concat(data.id, "][question_type]\"                                class=\"form-control form-control-sm question_type\"                                data-question=\"").concat(data.id, "\"                            >                                <option value=\"input\">Open Text</option>                                <option value=\"radio\">Select One</option>                                <option value=\"checkbox\">Select Many</option>                                <option value=\"textarea\">Multi-line Open Text</option>                            </select>                        </div>                        <div class=\"col-md-6\">                            <div class=\"checkbox\">                                <label>                                    <input type=\"checkbox\" name=\"questions[").concat(data.id, "][is_required]\" value=\"1\"> Required question                                </label>                            </div>                        </div>                    </div>\n                    <div class=\"form-group row\">                        <label class=\"col-md-2 control-label\">Question Text</label>                        <div class=\"col-md-10\">                            <input type=\"\" name=\"questions[").concat(data.id, "][question_text]\" class=\"form-control form-control-sm\" placeholder=\"Please Specify Question\" />                        </div>                    </div>\n                    <div class=\"choices_container\" id=\"choices_container_").concat(data.id, "\" style=\"display: none;\">                        <h4>Choices</h4>                        <div id=\"choices_inner_").concat(data.id, "\">                            \n                        </div>                        <a                            href=\"#\"                            id=\"add-choice_").concat(data.id, "\"                            class=\"btn btn-success btn-sm add-choice\"                            data-question=\"").concat(data.id, "\"                            data-survey=\"").concat(survey, "\"                            ><i class=\"fa fa-plus\"></i> Add Choice</a>                    </div>                </div>                "));
    },
    error: function error(data) {
      console.log(data);
    }
  });
});
$(document).on("click", ".add-choice", function (e) {
  e.preventDefault();
  $(this).attr("disabled", "disabled");
  var survey = $(this).data("survey");
  var question = $(this).data("question");
  $.ajax({
    url: "/api/questions/".concat(question, "/choices"),
    type: "POST",
    data: {
      choice_text: ""
    },
    datatype: "json",
    success: function success(data) {
      console.log(data);
      $("#add-choice_".concat(data.question_id)).removeAttr("disabled");
      $("#choices_inner_".concat(data.question_id)).append("\n                <div class=\"choice\" id=\"choice_".concat(data.id, "\">                <input                    type=\"hidden\"                    name=\"choices[").concat(data.id, "][ID]\"                    value=\"").concat(data.id, "\" />\n                <input                    type=\"hidden\"                    name=\"choices[").concat(data.id, "][question_ID]\"                    value=\"").concat(data.question_id, "\" />\n                    <div class=\"form-group row\">                        <label class=\"col-md-2 control-label\">Choice ").concat(data.choice_order, "</label>                        <div class=\"col-md-8\">                            <input type=\"\" placeholder=\"Please Specify Choice\" name=\"choices[").concat(data.id, "][choice_text]\" class=\"form-control form-control-sm\">                        </div>                        <div class=\"col-md-2\">                            <a                                 href=\"#\"                                class=\"btn btn-danger btn-sm delete-choice\"                                data-choice=\"").concat(data.id, "\"                                data-question=\"").concat(data.question_id, "\"                            ><i class=\"fa fa-trash\"></i> Delete</a>                        </div>                    </div>                </div>            "));
    }
  });
});
$(document).on("click", ".delete-choice", function (e) {
  e.preventDefault();
  var choice = $(this).data("choice");
  var question = $(this).data("question");
  $(this).attr("disabled", "disabled");
  $.ajax({
    url: "/api/questions/".concat(question, "/choices/").concat(choice),
    type: "DELETE",
    data: {},
    datatype: "json",
    success: function success(data) {
      console.log(data);
      $("#question_".concat(data.question_ID, " #choice_").concat(data.choice_ID)).remove();
    },
    error: function error(data) {
      console.log(data);
    }
  });
});

/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

window._ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
  window.Popper = __webpack_require__(/*! popper.js */ "./node_modules/popper.js/dist/esm/popper.js")["default"];
  window.$ = window.jQuery = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

  __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.js");
} catch (e) {}
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */


window.axios = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

var token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
// import Echo from 'laravel-echo';
// window.Pusher = require('pusher-js');
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });

/***/ }),

/***/ 0:
/*!***********************************************************!*\
  !*** multi ./resources/js/app.js ./resources/css/app.css ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /home/rnambaale/Projects/playground/php/laravel/survey-builder/resources/js/app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! /home/rnambaale/Projects/playground/php/laravel/survey-builder/resources/css/app.css */"./resources/css/app.css");


/***/ })

},[[0,"/js/manifest","/js/vendor"]]]);