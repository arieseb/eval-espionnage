const contactSelect = document.querySelector('#existing-contact-select')
const codenameInput = document.querySelector('#contact-codename-input')
const firstnameInput = document.querySelector('#contact-firstname-input')
const lastnameInput = document.querySelector('#contact-lastname-input')
const birthdateInput = document.querySelector('#contact-birthdate-input')
const countrySelect = document.querySelector('#contact-country_id-select')
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
                if (id === parseInt(contactSelect.value)) {
                    codenameInput.value = codename
                    firstnameInput.value = firstname
                    lastnameInput.value = lastname
                    birthdateInput.value = birthdate
                    countrySelect.value = country_id
                }
            })
        }
    }
    xhr.open('GET', 'contact_data', true)
    xhr.send()
}

window.addEventListener('DOMContentLoaded', dataHandler)
contactSelect.addEventListener('change',dataHandler)