// Form Validate and Submit
document.getElementById('config-submit').addEventListener('click', () => {
    // validate all visible fields

    // submit form
});

// Form Reset
document.getElementById('config-reset').addEventListener('click', () => {
    // reset the form
});

// Change form based on certificate selection
const certSelection = document.querySelector('select[name="pdf-template"]');
certSelection.addEventListener('change', async () => {
    console.log('cert selection changed');
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
    console.log("Updating form fields.");
    // hide all fields
    const optionalFields = document.querySelectorAll('label.optional');
    optionalFields.forEach((opt) => {
        opt.classList.add('hidden');
    })

    // show required fields
    let fields = null;
    for (let key in data) {
        if (key === "fields") {
            fields = key;
        }
    }

    if (fields) {
        console.log('Fields: ', fields);
        console.log(typeof fields);
    } else {
        alert("Could not load required fields.");
    }
}

function showOptionalField(field) {
    console.log(field);
    let {key, value} = field;

    console.log("key: ", key)
    console.log("value: ", value)
}