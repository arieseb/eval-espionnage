const hideoutSelect = document.querySelector('#existing-hideout-select')
const codeInput = document.querySelector('#hideout-code-input')
const typeInput = document.querySelector('#hideout-type-input')
const addressInput = document.querySelector('#hideout-address-input')
const countrySelect = document.querySelector('#hideout-country_id-select')
const xhr = new XMLHttpRequest()

function dataHandler() {
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let results = JSON.parse(xhr.response)
            results.data.forEach(data => {
                let id = data.id
                let code = data.code
                let type = data.type
                let address = data.address
                let country_id = data.country_id
                if (id === parseInt(hideoutSelect.value)) {
                    codeInput.setAttribute('placeholder', code)
                    typeInput.setAttribute('placeholder', type)
                    addressInput.setAttribute('placeholder', address)
                    countrySelect.value = country_id
                }
            })
        }
    }
    xhr.open('GET', 'hideout_data', true)
    xhr.send()
}

window.addEventListener('DOMContentLoaded', dataHandler)
hideoutSelect.addEventListener('change',dataHandler)