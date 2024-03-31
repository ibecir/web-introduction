var FormValidation = {
  serialize_form(form) {
    let result = {};
    $.each(form.serializeArray(), function () {
      result[this.name] = this.value;
    });
    return result;
  },

  validate: function (form_selector, form_rules, form_submit_handler) {
    var form_object = $(form_selector);
    var error = $(".alert-danger", form_object);
    var success = $(".alert-success", form_object);

    form_object.validate({
      rules: form_rules,
      submitHandler: function (form, event) {
        event.preventDefault();
        success.show();
        error.hide();
        if (form_submit_handler)
          form_submit_handler(FormValidation.serialize_form(form_object));
      },
    });
  },
};
