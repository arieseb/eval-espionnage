const lists = document.querySelectorAll('.list')

lists.forEach(list => {
    let string = list.innerText
    list.innerText = string.substring(0, string.length-1)
})