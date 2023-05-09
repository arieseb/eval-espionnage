const countrySelect = document.querySelector('#existing-country-select')
const nameInput = document.querySelector('#country-name-input')
const nationalityInput = document.querySelector('#country-nationality-input')
const xhr = new XMLHttpRequest()

function dataHandler() {
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let results = JSON.parse(xhr.response)
            results.data.forEach(function(data) {
                let id = data.id
                let name = data.name
                let nationality = data.nationality
                if (id === parseInt(countrySelect.value)) {
                    nameInput.setAttribute('placeholder', name)
                    nationalityInput.setAttribute('placeholder', nationality)
                }
            })
        }
    }
    xhr.open('GET', 'country_data', true)
    xhr.send()
}

window.addEventListener('DOMContentLoaded', dataHandler)
countrySelect.addEventListener('change',dataHandler)
