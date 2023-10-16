const changeSelectColor = (selectClass) => {
    const selectEls = document.querySelectorAll(selectClass);
    selectEls.forEach((select) => {
        select.addEventListener('change', () => {
            select.classList.add('select_active')
        })
    })
}

const init = () => {
    changeSelectColor('select');
}

document.addEventListener('DOMContentLoaded', init)