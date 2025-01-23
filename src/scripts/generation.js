const optionalFields = document.querySelectorAll('label.optional');
const certSelection = document.querySelector('select[name="pdf-template"]');

// Form Validate and Submit
document.getElementById('config-submit').addEventListener('click', () => {
    // validate all visible fields

    // submit form
});

// Form Reset
document.getElementById('config-reset').addEventListener('click', () => {
    // reset the textareas and inputs to default values
    let inputs = document.querySelectorAll('input');
    let textAreas = document.querySelectorAll('textarea');

    inputs.forEach((el) => {
        el.value = "";
    });
    textAreas.forEach((el) => {
        el.value = "";
    });

    // reset the cert selection to the default
    certSelection.selectedIndex = 0;

    // hide all optional fields
    optionalFields.forEach((el) => {
       el.classList.add('hidden');
    });
});

// Change form based on certificate selection
certSelection.addEventListener('change', async () => {
    // console.log('cert selection changed');
    const selectedCertificate = certSelection.value;

    // get the instructions for the selected template
    const url = `./storage/data/${selectedCertificate}.json`;

    // console.log('Fetching data...', url);
    fetch(url)
        .then(res => res.json())
        .then(data => updateFormFields(data))
        .catch(error => console.error(`Error fetching instructions: ${error}`));
});

function updateFormFields(data) {
    // console.log("Updating form fields.");
    // hide all fields
    optionalFields.forEach((opt) => {
        opt.classList.add('hidden');
    })

    // get the required fields from the data
    let fields = null;
    for (let key in data) {
        if (key === "fields") {
            fields = data[key];
        }
    }

    if (fields) {
        for (let field in fields) {
            showOptionalField(field);
        }
    } else {
        alert("Could not load required fields.");
    }
}

function showOptionalField(field) {
    // console.log("Showing ", field);
    // match the required field to the "for" tag and un-hide it
    document.querySelector(`label[for="${field}"]`).classList.remove('hidden');
}