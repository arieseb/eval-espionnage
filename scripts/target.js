const targetSelect = document.querySelector('#existing-target-select')
const codenameInput = document.querySelector('#target-codename-input')
const firstnameInput = document.querySelector('#target-firstname-input')
const lastnameInput = document.querySelector('#target-lastname-input')
const birthdateInput = document.querySelector('#target-birthdate-input')
const countrySelect = document.querySelector('#target-country_id-select')
const xhr = new XMLHttpRequest()

function dataHandler() {
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let results = JSON.parse(xhr.response)
            results.data.forEach(data => {
                let id = data.id
                let codename = data.codename
                let firstname = data.firstname
                let lastname = data.lastname
                let birthdate = data.birthdate
                let country_id = data.country_id
                if (id === parseInt(targetSelect.value)) {
                    codenameInput.value = codename
                    firstnameInput.value = firstname
                    lastnameInput.value = lastname
                    birthdateInput.value = birthdate
                    countrySelect.value = country_id
                }
            })
        }
    }
    xhr.open('GET', 'target_data', true)
    xhr.send()
}

window.addEventListener('DOMContentLoaded', dataHandler)
targetSelect.addEventListener('change',dataHandler)