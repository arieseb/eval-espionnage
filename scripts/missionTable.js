const rows = document.querySelectorAll('tr[data-id]')

rows.forEach(row => {
    row.addEventListener('click', () => {
        const id = row.getAttribute('data-id')
        window.location.href = 'mission-detail?id=' + id
    })
})