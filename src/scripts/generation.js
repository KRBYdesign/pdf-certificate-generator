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
document.querySelector('select[name="pdf-template"]').addEventListener('change', async () => {
    console.log('cert selection changed');
    const selectedCertificate = document.querySelector('select[name="pdf-template"]').value();
    // get the instructions for the selected template
    const url = `./storage/data/${selectedCertificate}.json`;

    console.log('Fetching data...', url);
    fetch(url)
        .then(res => res.json())
        .then(data => updateFormFields(data))
        .catch(error => console.error(`Error fetching instructions: ${error}`));
});

function updateFormFields(data) {
    console.log("Updating form fields.");
    // show required fields
    console.table(data);
    // clear and hide non-required fields
}