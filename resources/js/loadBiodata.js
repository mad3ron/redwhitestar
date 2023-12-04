function loadBiodata() {
    // Get the biodata data from the database.
    var biodataData = getDataFromDatabase();

    // Loop through the biodata data and populate the input fields.
    for (var i = 0; i < biodataData.length; i++) {
      var biodata = biodataData[i];
      var inputField = document.getElementById(biodata.fieldId);
      inputField.value = biodata.value;
    }
  }

  // Load the biodata data when the page loads.
  window.onload = loadBiodata;
