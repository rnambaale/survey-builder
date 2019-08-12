/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

$(".remote-modal").on("show.bs.modal", function(e) {
    $(this)
        .find(".modal-content")
        .load(e.relatedTarget.href);
});

$(document).on("change", ".question select.question_type", function(e) {
    //console.log($(this).parent());
    //console.log($(this).val());
    const question_type = $(this).val();

    const question = $(this).data("question");

    console.log(question);

    $(`#choices_container_${question}`).hide();

    switch (question_type) {
        case "checkbox":
            $(`#choices_container_${question}`).show();
            break;

        case "radio":
            $(`#choices_container_${question}`).show();
            break;

        default:
            break;
    }
});

$(document).on("click", ".delete-question", function(e) {
    e.preventDefault();

    const survey = $(this).data("survey");
    const question = $(this).data("question");
    const indicator = $(this).data("indicator");

    $.ajax({
        url: "/api/deleteQuestion",
        type: "POST",
        data: {
            survey,
            question,
            indicator
        },
        datatype: "json",
        success: function(data) {
            console.log(data);
            $(`.questions-container #question_${data.question_ID}`).remove();
        },
        error: function(data) {
            console.log(data);
        }
    });
});

$(document).on("click", ".add-question", function(e) {
    e.preventDefault();
    $(this).attr("disabled", "disabled");

    const survey = $(this).data("survey");
    const indicator = $(this).data("indicator");

    $.ajax({
        url: "/api/addQuestion",
        type: "POST",
        data: {
            survey,
            indicator
        },
        datatype: "json",
        success: function(data) {
            console.log(data);
            $(".add-question").removeAttr("disabled");
            if (data.status == 1) {
                $(".questions-container").append(`\
                <div class="question" id="question_${
                    data.question_ID
                }" data-question="${data.question_ID}">\
                    <input
                        type="hidden"\
                        name="questions[${data.question_ID}][ID]"\
                        value="${data.question_ID}" />\

                    <h4 class="clear">
                        <span class="pull-left">Question ${
                            data.question_order
                        }</span>\
                        <span class="pull-right">\
                            <a\
                                href="#"\
                                data-question="${data.question_ID}"\
                                data-survey="${survey}"\
                                data-indicator="${indicator}"\
                                class="btn btn-default btn-sm delete-question"\
                            >Delete Question</a>\
                        </span>\
                    </h4>\
                    <div class="row">\
                        <div class="form-group form-group-sm">\
                            <label class="col-md-2 control-label">Question Type</label>\
                            <div class="col-md-4">\
                                <select\
                                    name="questions[${
                                        data.question_ID
                                    }][question_type]"\
                                    class="form-control question_type"\
                                    data-question="${data.question_ID}"\
                                >\
                                    <option value="input">Open Text</option>\
                                    <option value="radio">Select One</option>\
                                    <option value="checkbox">Select Many</option>\
                                    <option value="textarea">Multi-line Open Text</option>\
                                </select>\
                            </div>\
                            <div class="col-md-6">\
                                <div class="checkbox">\
                                    <label>\
                                        <input type="checkbox" name="questions[${
                                            data.question_ID
                                        }][is_required]" value="1"> Required question\
                                    </label>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\

                    <div class="row">\
                        <div class="form-group form-group-sm">\
                            <label class="col-md-2 control-label">Question Text</label>\
                            <div class="col-md-10">\
                                <input type="" name="questions[${
                                    data.question_ID
                                }][question_text]" class="form-control" />\
                            </div>\
                        </div>\
                    </div>\
                    <div class="choices_container" id="choices_container_${
                        data.question_ID
                    }" style="display: none;">\
                        <h4>Choices</h4>\
                        <div id="choices_inner_${data.question_ID}">\
                            
                        </div>\
                        <a\
                            href="#"\
                            id="add-choice_${data.question_ID}"\
                            class="btn btn-default btn-sm add-choice"\
                            data-question="${data.question_ID}"\
                            data-survey="${survey}"\
                            ><i class="fa fa-plus"></i> Add Choice</a>\
                    </div>\
                </div>\
                `);
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
});

$(document).on("click", ".add-choice", function(e) {
    e.preventDefault();
    $(this).attr("disabled", "disabled");
    const survey = $(this).data("survey");
    const question = $(this).data("question");

    $.ajax({
        url: "/api/addQuestionChoice",
        type: "POST",
        data: {
            survey,
            question
        },
        datatype: "json",
        success: function(data) {
            console.log(data);
            $(`#add-choice_${question}`).removeAttr("disabled");

            $(`#choices_inner_${question}`).append(`
                <div class="choice" id="choice_${data.choice_ID}">\
                <input\
                    type="hidden"\
                    name="choices[${data.choice_ID}][ID]"\
                    value="${data.choice_ID}" />\

                <input\
                    type="hidden"\
                    name="choices[${data.choice_ID}][question_ID]"\
                    value="${question}" />\

                    <div class="row">\
                        <div class="form-group form-group-sm">\
                            <label class="col-md-2 control-label">Choice ${
                                data.choice_order
                            }</label>\
                            <div class="col-md-8">\
                                <input type="" name="choices[${
                                    data.choice_ID
                                }][choice_text]" class="form-control">\
                            </div>\
                            <div class="col-md-2">\
                                <a \
                                    href="#"\
                                    class="btn btn-default btn-sm delete-choice"\
                                    data-choice="${data.choice_ID}"\
                                    data-question="${question}"\
                                >Delete Choice</a>\
                            </div>\
                        </div>\
                    </div>\
                </div>\
            `);
        }
    });
});

$(document).on("click", ".delete-choice", function(e) {
    e.preventDefault();

    const choice = $(this).data("choice");
    const question = $(this).data("question");
    $(this).attr("disabled", "disabled");

    $.ajax({
        url: "/api/deleteQuestionChoice",
        type: "POST",
        data: {
            choice,
            question
        },
        datatype: "json",
        success: function(data) {
            console.log(data);
            $(`#question_${data.question_ID} #choice_${choice}`).remove();
        },
        error: function(data) {
            console.log(data);
        }
    });
});
