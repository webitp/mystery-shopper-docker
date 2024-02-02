function deleteItem(id) {
    const form = document.querySelector('form')
    const input = form.querySelector('input[name="id"]')
    input.value = id
    form.submit()
}