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

    $.ajax({
        url: `/api/surveys/${survey}/questions/${question}`,
        type: "DELETE",
        data: {},
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

    $.ajax({
        url: `/api/surveys/${survey}/questions`,
        type: "POST",
        data: {
            survey,
            question_text: ""
        },
        datatype: "json",
        success: function(data) {
            console.log(data);
            $(".add-question").removeAttr("disabled");

            $(".questions-container").append(`\
                <div class="question" id="question_${data.id}" data-question="${
                data.id
            }">\
                    <input
                        type="hidden"\
                        name="questions[${data.id}][ID]"\
                        value="${data.id}" />\

                    <h4 class="clearfix">
                        <span class="float-left">Question ${
                            data.question_order
                        }</span>\
                        <span class="float-right">\
                            <a\
                                href="#"\
                                data-question="${data.id}"\
                                data-survey="${survey}"\
                                data-indicator=""\
                                class="btn btn-danger btn-sm delete-question"\
                            >Delete Question</a>\
                        </span>\
                    </h4>\

                    <div class="form-group row">\
                        <label class="col-md-2 control-label">Question Type</label>\
                        <div class="col-md-4">\
                            <select\
                                name="questions[${data.id}][question_type]"\
                                class="form-control form-control-sm question_type"\
                                data-question="${data.id}"\
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
                                        data.id
                                    }][is_required]" value="1"> Required question\
                                </label>\
                            </div>\
                        </div>\
                    </div>\

                    <div class="form-group row">\
                        <label class="col-md-2 control-label">Question Text</label>\
                        <div class="col-md-10">\
                            <input type="" name="questions[${
                                data.id
                            }][question_text]" class="form-control form-control-sm" placeholder="Please Specify Question" required/>\
                        </div>\
                    </div>\

                    <div class="choices_container" id="choices_container_${
                        data.id
                    }" style="display: none;">\
                        <h4>Choices</h4>\
                        <div id="choices_inner_${data.id}">\
                            
                        </div>\
                        <a\
                            href="#"\
                            id="add-choice_${data.id}"\
                            class="btn btn-success btn-sm add-choice"\
                            data-question="${data.id}"\
                            data-survey="${survey}"\
                            ><i class="fa fa-plus"></i> Add Choice</a>\
                    </div>\
                </div>\
                `);
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
        url: `/api/questions/${question}/choices`,
        type: "POST",
        data: {
            choice_text: ""
        },
        datatype: "json",
        success: function(data) {
            console.log(data);
            $(`#add-choice_${data.question_id}`).removeAttr("disabled");

            $(`#choices_inner_${data.question_id}`).append(`
                <div class="choice" id="choice_${data.id}">\
                <input\
                    type="hidden"\
                    name="choices[${data.id}][ID]"\
                    value="${data.id}" />\

                <input\
                    type="hidden"\
                    name="choices[${data.id}][question_ID]"\
                    value="${data.question_id}" />\

                    <div class="form-group row">\
                        <label class="col-md-2 control-label">Choice ${
                            data.choice_order
                        }</label>\
                        <div class="col-md-8">\
                            <input type="" placeholder="Please Specify Choice" name="choices[${
                                data.id
                            }][choice_text]" class="form-control form-control-sm" required>\
                        </div>\
                        <div class="col-md-2">\
                            <a \
                                href="#"\
                                class="btn btn-danger btn-sm delete-choice"\
                                data-choice="${data.id}"\
                                data-question="${data.question_id}"\
                            ><i class="fa fa-trash"></i></a>\
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
        url: `/api/questions/${question}/choices/${choice}`,
        type: "DELETE",
        data: {},
        datatype: "json",
        success: function(data) {
            console.log(data);
            $(
                `#question_${data.question_ID} #choice_${data.choice_ID}`
            ).remove();
        },
        error: function(data) {
            console.log(data);
        }
    });
});
