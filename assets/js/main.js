document.addEventListener("DOMContentLoaded", e => {
    
    document.addEventListener("change", e => {
        if(e.target.matches(".board__column input"))
            e.target.closest('form').submit();
    })
})