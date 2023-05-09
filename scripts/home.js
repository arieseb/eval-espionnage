const dashboardLink = document.querySelector('#dashboard-link')
const adminHeader = document.querySelector('#admin-header')
const missionList = document.querySelector('#mission-list')
const listTitle = '-- Liste des missions --'

if (adminHeader) {
    dashboardLink.remove()
    let h2 = document.createElement('h2')
    h2.innerText = listTitle
    h2.setAttribute('class', 'text-center')
    missionList.append(h2)
} else {
    let h1 = document.createElement('h1')
    h1.innerText = listTitle
    h1.setAttribute('class', 'text-center')
    missionList.append(h1)
}

