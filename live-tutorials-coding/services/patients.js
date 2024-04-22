var PatientService = {
  reload_patients_datatable: function () {
    Utils.get_datatable(
      "tbl_patients",
      Constants.API_BASE_URL + "patients", // get_patients.php
      [
        { data: "action" },
        { data: "first_name" },
        { data: "last_name" },
        { data: "created_at" },
        { data: "email" },
      ]
    );
  },
  open_edit_patient_modal: function (patient_id) {
    RestClient.get("patients/" + patient_id, function (data) {
      $("#add-patient-modal").modal("toggle");
      $("#add-patient-form input[name='id']").val(data.id);
      $("#add-patient-form input[name='first_name']").val(data.first_name);
      $("#add-patient-form input[name='last_name']").val(data.last_name);
      $("#add-patient-form input[name='email']").val(data.email);
      $("#add-patient-form input[name='created_at']").val(data.created_at);
    });
  },
  delete_patient: function (patient_id) {
    if (
      confirm(
        "Do you want to delete patient with the id " + patient_id + "?"
      ) == true
    ) {
      RestClient.delete(
        "patients/delete/" + patient_id,
        {},
        function (data) {
          PatientService.reload_patients_datatable();
        }
      );
    }
  },
};
