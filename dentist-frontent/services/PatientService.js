var PatientService = {
  open_edit_patient_modal: function (patient_id) {
    RestClient.get("get_patient.php?id=" + patient_id, function (data) {
      console.log("DATA IS ", data);
      $("#add-patient-modal").modal("toggle");
      $("#add-patient-form input[name='id']").val(data.id);
      $("#add-patient-form input[name='first_name']").val(data.first_name);
      $("#add-patient-form input[name='last_name']").val(data.last_name);
      $("#add-patient-form input[name='email']").val(data.email);
      $("#add-patient-form input[name='created_at']").val(data.created_at);
    });
  },
  delete_patient: function (patient_id) {
    if (confirm("Are you sure you want to delete this patient?") == true) {
      RestClient.delete(
        "patients/delete/" + patient_id,
        { },
        function (data) {
          PatientService.reload_patients_table();
        }
      );
    } else {
      console("Dismissed!");
    }
  },
  reload_patients_table: function() {
    Utils.get_datatable(
      "tbl_patients",
      // Constants.API_BASE_URL + "get_patients_paginated.php",
      Constants.get_api_base_url() + "patients",
      [
        { data: "action" },
        { data: "first_name" },
        { data: "last_name" },
        { data: "email" },
        { data: "created_at" },
      ]
    );
  }
};